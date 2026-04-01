import os
import time
import cv2
import torch
from PIL import Image
import json
from loguru import logger
from datetime import datetime
import sys
import numpy as np
sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox/data')
sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox/data/datasets')
sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox/exp')
sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox/utils')
sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox')

from data_augment import ValTransform
from datasets import COCO_CLASSES
from exp import get_exp
from utils import fuse_model, get_model_info, postprocess, vis

IMAGE_EXT = [".jpg", ".jpeg", ".webp", ".bmp", ".png"]
class Predictor(object):
    def __init__(
        self,
        model,
        exp,
        cls_names=COCO_CLASSES,
        trt_file=None,
        decoder=None,
        device="cpu",
        fp16=False,
        legacy=False,
    ):
        self.model = model
        self.cls_names = cls_names
        self.decoder = decoder
        self.num_classes = exp.num_classes
        self.confthre = exp.test_conf
        self.nmsthre = exp.nmsthre
        self.test_size = exp.test_size
        self.device = device
        self.fp16 = fp16
        self.preproc = ValTransform(legacy=legacy)
        if trt_file is not None:
            from torch2trt import TRTModule

            model_trt = TRTModule()
            model_trt.load_state_dict(torch.load(trt_file))

            x = torch.ones(1, 3, exp.test_size[0], exp.test_size[1]).cuda()
            self.model(x)
            self.model = model_trt

    def inference(self, img):
        img_info = {"id": 0}


        height, width = img.size[0], img.size[1]
        img_info["height"] = height
        img_info["width"] = width
        # Convert the PIL image to a numpy array
        img_np = np.asarray(img)
        # Convert the numpy array to an OpenCV image
        img = cv2.cvtColor(img_np, cv2.COLOR_RGB2BGR)
        img_info["raw_img"] = img
        ratio = min(self.test_size[0] / img.shape[0], self.test_size[1] / img.shape[1])
        img_info["ratio"] = ratio
        img, _ = self.preproc(img, None, self.test_size)
        img = torch.from_numpy(img).unsqueeze(0)
        img = img.float()
        if self.device == "gpu":
            img = img.cuda()
            if self.fp16:
                img = img.half()  # to FP16

        with torch.no_grad():
            t0 = time.time()
            outputs = self.model(img)
            if self.decoder is not None:
                outputs = self.decoder(outputs, dtype=outputs.type())
            outputs = postprocess(
                outputs, self.num_classes, self.confthre,
                self.nmsthre, class_agnostic=True
            )
            logger.info("Infer time: {:.4f}s".format(time.time() - t0))
        return outputs, img_info

    def visual(self, output, img_info, cls_conf=0.35):
        ratio = img_info["ratio"]
        img = img_info["raw_img"]
        if output is None:
            return img
        output = output.cpu()

        bboxes = output[:, 0:4]

        # preprocessing: resize
        bboxes /= ratio

        cls = output[:, 6]
        scores = output[:, 4] * output[:, 5]

        vis_res = vis(img, bboxes, scores, cls, cls_conf, self.cls_names)
        return vis_res





def image_demo(predictor, vis_folder, img, current_time, save_result):
    outputs, img_info = predictor.inference(img)

    result_image = predictor.visual(outputs[0], img_info, predictor.confthre)
    if save_result:
        save_folder = os.path.join(
            vis_folder, time.strftime("%Y_%m_%d_%H_%M_%S", current_time)
        )
        outputs_folder = os.path.join(
            vis_folder, time.strftime("%Y_%m_%d_%H_%M_%S", current_time)+"_txt"
        )
        os.makedirs(save_folder, exist_ok=True)
        os.makedirs(outputs_folder, exist_ok=True)
        save_file_name = os.path.join(save_folder, "output.jpg")
        save_file_name_txt = os.path.join(outputs_folder, "output.txt")
        logger.info("Saving detection result in {}".format(save_file_name))
        cv2.imwrite(save_file_name, result_image)

        with open(save_file_name_txt, 'w') as file:
            file.write(str(outputs))

    else:
        cv2.imshow("Output", result_image)
        cv2.waitKey(0)


    return result_image, outputs[0]

def txt_to_json(txt_file):
    classes=['pylon',
  'heavy_equipment',  'small_aircraft',
   'medium_vehicle', 'small_vehicle',
   'large_vehicle', 'large_vessel', 'small_vessel',
   'medium_vessel', 'container']
    data = txt_file
    # Remove unwanted characters and split lines
    data = data.replace(',\n         ',',').replace('tensor([[', '').replace(']])', '').replace('[', '').replace(']', '').replace(", '",']').strip()
    data = data.replace(", '']",']').strip()
    lines = data.split('\n')
    json_data = {}
    i = 0
    for line in lines:

        elements = line.split(',')
        print(elements)
        class_id = int(float(elements[6]))
        score = float(elements[4]) * float(elements[5])
        bounding_box = [float(e) for e in elements[:4]]
        class_name = classes[class_id]

        class_data = {
            "class_id": class_id,
            "class": class_name,
            "score": score,
            "bounding_box": bounding_box
        }
        json_data[i] = {}


        json_data[i]=class_data
        i = i + 1
    json_object = json.dumps(json_data, indent=4)
    return json_object
def extract_coords_values(input_text):
    lines = input_text.strip().split("\n")
    left,top  = map(float, lines[1].split(","))
    right,_ = map(float, lines[2].split(","))
    _,bottom= map(float, lines[3].split(","))
    return top, left, right, bottom

def pixel_to_geo(coord, image_bounds, img):
    top, left, bottom, right = image_bounds
    img_width, img_height = img.size[0], img.size[1]
    x, y = coord
    with open('C:\\xampp\htdocs\webmap\python\imagery-detect\\tools\d.txt', 'w') as file:
        file.write(str(img_width))
        file.write(str(img_height))
    lat_ratio = (bottom - top) / img_height
    lon_ratio = (right - left) / img_width
    relative_x = x - left
    relative_y = y - top
    latitude = top + (relative_y * lat_ratio)
    longitude = left + (relative_x * lon_ratio)
    return latitude, longitude

def generate_geojson(top, left, bottom, right, json_file,img, output_file):
    data = json.loads(json_file)
    image_bounds = (top, left, bottom, right)
    geojson_data = {
        "type": "FeatureCollection",
        "features": []
    }

    # Iterate through the bounding boxes in the JSON data and convert coordinates
    for item_id, item in data.items():
        class_id = item["class_id"]
        class_name = item["class"]
        score = item["score"]
        bounding_box = item["bounding_box"]

        # Calculate the center coordinates of the bounding box
        x_center = (bounding_box[0] + bounding_box[2]) / 2
        y_center = (bounding_box[1] + bounding_box[3]) / 2
        # Convert pixel coordinates to geographical coordinates (latitude and longitude)
        latitude, longitude = pixel_to_geo((x_center, y_center), image_bounds,img)
        with open('C:\\xampp\htdocs\webmap\python\imagery-detect\data\\10_yolox_objects_output\ddd.txt', 'w') as file:
            file.write(str(x_center))
            file.write(str(y_center))
            file.write(str(latitude))
            file.write(str(longitude))
        # Create a GeoJSON feature for each bounding box
        feature = {
            "type": "Feature",
            "geometry": {
                "type": "Point",
                "coordinates": [longitude, latitude]
            },
            "properties": {
                "class": class_name,
                "conf": score,
                "time": datetime.now().isoformat()  # Current time in ISO format
            }
        }

        # Append the feature to the GeoJSON data
        geojson_data["features"].append(feature)
    # Write the GeoJSON data to a new file
    with open(output_file, "w") as outfile:
        json.dump(geojson_data, outfile)

    return output_file














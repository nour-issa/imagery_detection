"""
This is a boilerplate pipeline 'yolox_image_objects_detection_sahi'
generated using Kedro 0.18.11
"""
import json
# import yolox
import sys
import numpy as np
import geopandas as gpd
from shapely import wkb
import shutil

import cv2
import torch
sys.path.append('C:\\xampp\htdocs\webmap\python\imagery-detect\\tools')
from sahi_tools import txt_to_json_sahi;
sys.path.append('C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\sub_projects\\sahi-yolox-main')
sys.path.append('C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\sub_projects\\YOLOX\\exps\\default')
from sahi.model import YoloXDetectionModel
from sahi.utils.cv import read_image
from sahi.utils.file import download_from_url
from sahi.predict import get_prediction, get_sliced_prediction, predict
from IPython.display import Image
from PIL import Image as PILImage
sys.path.append('C:\\xampp\htdocs\webmap\python\imagery-detect\\tools')

from imagery_detection_tools import *;
def yolox_image_demo_sahi(img):
    CLASSES = ("pylon",
     "heavy_equipment",  "small_aircraft",
     "medium_vehicle", "small_vehicle",
     "large_vehicle", "large_vessel", "small_vessel",
     "medium_vessel",
)
    chkpt_file = 'C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\data\\06_models\\yoloxs.pth'
    config_path = "yolox_s"

    detection_model = YoloXDetectionModel(
        model_path=chkpt_file,
        config_path=config_path,
        device="cuda:0",
        confidence_threshold=0.3,
        nms_threshold=0.4,
        image_size=(640, 640),
        classes=CLASSES
    )

    # this is for the traditional method /no sahi
    # image_path = "C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\data\\01_raw\\raw_imagery.jpg"
    # img = cv2.imread(image_path)
    #
    # # Get the width and height of the image
    # height, width, channels = img.shape
    # result1 = get_prediction("C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\data\\01_raw\\raw_imagery.jpg", detection_model,image_size=[height,width])

    #with sahi
    img_numpy = np.array(img)
    result = get_sliced_prediction(
        img_numpy,
        detection_model,
        slice_height=512,
        slice_width=512,
        overlap_height_ratio=0.1,
        overlap_width_ratio=0.1
    )
    list= result.export_visuals(export_dir="C:\\xampp\htdocs\webmap\python\imagery-detect\data\\14_sahi\\")
    pil_image = PILImage.open("C:\\xampp\htdocs\webmap\python\imagery-detect\data\\14_sahi\prediction_visual.png")
    source_path = "C:\\xampp\htdocs\webmap\python\imagery-detect\data\\14_sahi\yolox_detected_imagery_sahi.jpg"
    destination_path = "C:/Users/Nour Issa/Desktop/image_with_sahi.jpg"

    shutil.copyfile(source_path, destination_path)
    return pil_image, str(list)


def yolox_all_classes_sahi(yolox_result_sahi):
    yolox_classes=txt_to_json_sahi(yolox_result_sahi)

    yolox_classes_sahi = json.dumps(yolox_classes, indent=4)
    file_path = "C:\\xampp\htdocs\webmap\python\imagery-detect\data\\05_model_input\yolox_classes_sahi.json"

    # Write the data to the JSON file
    with open(file_path, "w") as json_file:
        json.dump(yolox_classes_sahi, json_file, indent=4)
    return yolox_classes_sahi;

def save_result_yolox_sahi(yolox_all_classes_sahi, raw_coords,img):
    top, left, right, bottom  = extract_coords_values(raw_coords);
    output_file = "C:\\xampp\htdocs\webmap\python\imagery-detect\data\\11_map_objects\\user_data_sahi.geojson"
    geojson_output_file = generate_geojson(top, left, bottom, right, yolox_all_classes_sahi,img,output_file)
    gdf = gpd.read_file('C:\\xampp\htdocs\webmap\python\imagery-detect\data\\11_map_objects\\user_data_sahi.geojson')
    gdf['geom'] = gdf['geometry'].apply(lambda geom: wkb.dumps(geom))
    gdf.drop(columns=["geometry"], inplace=True)
    gdf['name'] = gdf["class"]
    gdf.drop(columns=["class"], inplace=True)
    gdf['sahi'] = '1'
    print(gdf)
    return gdf

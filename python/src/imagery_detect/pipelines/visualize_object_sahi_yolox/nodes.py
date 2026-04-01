"""
This is a boilerplate pipeline 'visualize_object_sahi_yolox'
generated using Kedro 0.18.11
"""

import sys;
sys.path.append('C:\\xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox\\utils')
sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox/data')
import json
from visualize import vis
from datasets import COCO_CLASSES
import numpy as np
import cv2
from PIL import Image
def visualize_classes_with_confidence_yolox_sahi(img,yolox_all_classes_sahi,conf):
    boxes = []
    scores = []
    cls_ids = []
    classes_json = json.loads(yolox_all_classes_sahi)

    confidence = float(conf["threshold"]);
    for i in range(len(classes_json)):
        cls_ids.append(classes_json[str(i)]["class_id"]);
        scores.append(classes_json[str(i)]["score"]);
        boxes.append(classes_json[str(i)]["bounding_box"]);
        # Convert the PIL image to a numpy array
    img_np = np.asarray(img)

    # Convert the numpy array to an OpenCV image
    img = cv2.cvtColor(img_np, cv2.COLOR_RGB2BGR)
    imgg1 = vis(img,boxes,scores,cls_ids,confidence,COCO_CLASSES)
    img_conf = Image.fromarray(imgg1)
    return img_conf
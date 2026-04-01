"""
This is a boilerplate pipeline 'imagery_objects_detection'
generated using Kedro 0.18.11
"""
import os
import time
import cv2
import geopandas as gpd
import psycopg2
from shapely import wkb
import shutil
import torch
import json
from PIL import Image
from loguru import logger
import sys
import numpy as np

sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox/data')
sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox/data/datasets')
sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox/exp')
sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox/utils')
sys.path.append('C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\yolox')
sys.path.append('C:\\xampp\htdocs\webmap\python\imagery-detect\\tools')
from imagery_detection_tools import Predictor;
from imagery_detection_tools import *;

from data_augment import ValTransform
from datasets import COCO_CLASSES
from exp import get_exp
from utils import fuse_model, get_model_info, postprocess, vis


def yolox_image_demo(img_path):
    exp_file = "sub_projects/YOLOX/exps/default/yolox_s.py"
    device = "cpu"
    save_result = True
    exp = get_exp(exp_file)
    model = exp.get_model()
    model_path = 'data/06_models/yoloxs.pth'
    model.load_state_dict(torch.load(model_path, map_location=device)['model'])
    if device == "gpu":
        model.cuda()
    model.eval()

    predictor = Predictor(
        model,
        exp,
        cls_names=COCO_CLASSES,
        device=device,
    )
    current_time = time.localtime()
    vis_path = 'C:/xampp\htdocs\webmap\python\imagery-detect\sub_projects\YOLOX\YOLOX_outputs\yolox_s/vis_outputs'
    imgg1, outputs = image_demo(predictor, vis_path, img_path, current_time, save_result)

    imgg2 = Image.fromarray(imgg1)
    print(outputs)
    yolox_res = str(outputs)
    source_path = "C:\\xampp\htdocs\webmap\python\imagery-detect\data\\09_yolox_predicted_output\yolox_raw_detected_imagery.jpg"
    destination_path = "C:\\Users\\Nour Issa\\Desktop\\image_no_sahi.jpg"
    shutil.copyfile(source_path, destination_path)
    # print(yolox_res)
    return imgg2, yolox_res


def yolox_all_classes(yolox_result):
    # txt_to_json
    yolox_classes=txt_to_json(yolox_result)
    file_path = "C:\\xampp\htdocs\webmap\python\imagery-detect\data\\05_model_input\yolox_classes.json"
    # Write the data to the JSON file
    with open(file_path, "w") as json_file:
        json.dump(yolox_classes, json_file, indent=4)
    return yolox_classes;

def save_result(yolox_all_classes, raw_coords,img):
    top, left, right, bottom  = extract_coords_values(raw_coords);
    output_file = "C:\\xampp\htdocs\webmap\python\imagery-detect\data\\11_map_objects\\user_data.geojson"
    geojson_output_file = generate_geojson(top, left, bottom, right, yolox_all_classes,img,output_file)
    gdf = gpd.read_file('C:\\xampp\htdocs\webmap\python\imagery-detect\data\\11_map_objects\\user_data.geojson')
    gdf['geom'] = gdf['geometry'].apply(lambda geom: wkb.dumps(geom))
    gdf.drop(columns=["geometry"], inplace=True)
    gdf['name'] = gdf["class"]
    gdf.drop(columns=["class"], inplace=True)
    gdf['sahi'] = '0'
    gdf['model'] = 'yolox'

    # Source and destination paths
    source_path = "C:\\xampp\htdocs\webmap\python\imagery-detect\data\\09_yolox_predicted_output\yolox_raw_detected_imagery.jpg"
    image_name = "image_re"  # Replace with your desired image name prefix

    # Generate a unique image name using current time and coordinates
    current_time = datetime.now().strftime("%Y%m%d%H%M%S")
    image_extension = os.path.splitext(source_path)[1]  # Get the file extension
    destination_path = f"C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\data\\07_model_output\\{image_name}_{current_time}_{top}_{left}_{bottom}_{right}{image_extension}"

    # Copy the image file
    shutil.copyfile(source_path, destination_path)
    print(gdf)
    return gdf;

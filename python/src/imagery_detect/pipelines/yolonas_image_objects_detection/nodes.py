"""
This is a boilerplate pipeline 'yolonas_image_objects_detection'
generated using Kedro 0.18.11
"""
import sys

import cv2

sys.path.append('C:\\xampp\htdocs\webmap\python\imagery-detect\\tools')
from yolonas_tools import *;
import supervision as sv


def yolonas_image_demo(img):
    model = inference_yolonas()
    CONFIDENCE_TRESHOLD = 0.0
    predictions = {}
    img = cv2.imread("C:\\xampp\htdocs\webmap\python\imagery-detect\data\\01_raw\\raw_imagery.jpg")
    result = list(model.predict(img))
    detections = sv.Detections(
        xyxy=result[0].prediction.bboxes_xyxy,
        confidence=result[0].prediction.confidence,
        class_id=result[0].prediction.labels.astype(int)
    )
    return  str(result)


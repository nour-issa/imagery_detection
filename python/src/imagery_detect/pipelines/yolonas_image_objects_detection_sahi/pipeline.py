"""
This is a boilerplate pipeline 'yolonas_image_objects_detection_sahi'
generated using Kedro 0.18.11
"""

from kedro.pipeline import Pipeline, node, pipeline
from .nodes import yolox_image_demo_sahi,yolox_all_classes_sahi,save_result_yolox_sahi;


def create_pipeline(**kwargs) -> Pipeline:
    return pipeline([

        node(
            func=yolonas_image_demo_sahi,
            inputs="raw_imagery",
            outputs=["yolonas_detected_imagery_sahi", "yolonas_result_sahi"],
            name="detect_objects_yolonas_sahi",
        ),
        node(
            func=yolonas_all_classes_sahi,
            inputs="yolox_result_sahi",
            outputs="yolox_all_classes_sahi",
            name="get_all_classes_yolox_with_sahi",
        ),
        node(
            func=save_result_yolonas_sahi,
            inputs=["yolox_all_classes_sahi", "raw_coords", "raw_imagery"],
            outputs="yolox_all_map_objects_sahi",
            name="save_yolox_results_to_postgreSQL_sahi",
        ),
    ])

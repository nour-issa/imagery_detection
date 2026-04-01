"""
This is a boilerplate pipeline 'yolox_image_objects_detection_sahi'
generated using Kedro 0.18.11
"""

from kedro.pipeline import Pipeline, node, pipeline
from .nodes import yolox_image_demo_sahi,yolox_all_classes_sahi,save_result_yolox_sahi;

def create_pipeline(**kwargs) -> Pipeline:
    return pipeline([
        node(
            func=yolox_image_demo_sahi,
            inputs="raw_imagery",
            outputs=["yolox_detected_imagery_sahi", "yolox_result_sahi"],
            name="detect_objects_sahi",
        ),
        node(
            func=yolox_all_classes_sahi,
            inputs="yolox_result_sahi",
            outputs="yolox_all_classes_sahi",
            name="get_all_classes_with_sahi",
        ),
        node(
            func=save_result_yolox_sahi,
            inputs=["yolox_all_classes_sahi", "raw_coords", "raw_imagery"],
            outputs="yolox_all_map_objects_sahi",
            name="save_results_to_postgreSQL_sahi",
        ),
    ])

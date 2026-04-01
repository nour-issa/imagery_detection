"""
This is a boilerplate pipeline 'imagery_objects_detection'
generated using Kedro 0.18.11
"""

from kedro.pipeline import Pipeline, node, pipeline
from .nodes import yolox_image_demo,yolox_all_classes,save_result;


def create_pipeline(**kwargs) -> Pipeline:
    return pipeline([

        node(
            func=yolox_image_demo,
            inputs="raw_imagery",
            outputs=["yolox_raw_detected_imagery", "yolox_result"],
            name="detect_objects",
        ),
        node(
            func=yolox_all_classes,
            inputs="yolox_result",
            outputs="yolox_all_classes",
            name="get_all_classes",
        ),
        node(
            func=save_result,
            inputs=["yolox_all_classes","raw_coords","raw_imagery"],
            outputs="yolox_all_map_objects",
            name="save_results_to_postgreSQL",
        ),

    ])

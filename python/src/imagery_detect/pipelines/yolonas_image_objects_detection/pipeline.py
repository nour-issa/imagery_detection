"""
This is a boilerplate pipeline 'yolonas_image_objects_detection'
generated using Kedro 0.18.11
"""

from kedro.pipeline import Pipeline, node, pipeline
from .nodes import yolonas_image_demo

def create_pipeline(**kwargs) -> Pipeline:
    return pipeline([

        node(
            func=yolonas_image_demo,
            inputs="raw_imagery",
            outputs="yolonas_result",
            name="detect_objects_yolonas",
        ),

    ])
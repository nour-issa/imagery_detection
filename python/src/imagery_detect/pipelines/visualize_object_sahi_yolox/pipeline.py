"""
This is a boilerplate pipeline 'visualize_object_sahi_yolox'
generated using Kedro 0.18.11
"""

from kedro.pipeline import Pipeline, node, pipeline
from .nodes import visualize_classes_with_confidence_yolox_sahi;

def create_pipeline(**kwargs) -> Pipeline:
    return pipeline([

        node(
            func=visualize_classes_with_confidence_yolox_sahi,
            inputs=["raw_imagery", "yolox_classes_sahi", "confidence"],
            outputs="yolox_confidence_detected_imagery_sahi",
            name="visualize_classes_with_confidence_sahi",
        ),

    ])

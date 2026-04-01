"""
This is a boilerplate pipeline 'visualize_objects'
generated using Kedro 0.18.11
"""

from kedro.pipeline import Pipeline, node, pipeline
from .nodes import visualize_classes_with_confidence;

def create_pipeline(**kwargs) -> Pipeline:
    return pipeline([
        node(
            func=visualize_classes_with_confidence,
            inputs=["raw_imagery","yolox_classes","confidence"],
            outputs="yolox_confidence_raw_detected_imagery",
            name="visualize_classes_with_confidence",
        ),

    ])

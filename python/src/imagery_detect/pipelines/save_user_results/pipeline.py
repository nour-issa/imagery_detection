"""
This is a boilerplate pipeline 'save_user_results'
generated using Kedro 0.18.11
"""

from kedro.pipeline import Pipeline, node, pipeline
from .nodes import save_user_result;

def create_pipeline(**kwargs) -> Pipeline:
    return pipeline([

        node(
            func= save_user_result,
            inputs="user_result",
            outputs="user_map_objects",
            name="save_user_result",
        ),
    ])

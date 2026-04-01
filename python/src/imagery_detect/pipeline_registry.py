"""Project pipelines."""
from __future__ import annotations

from kedro.framework.project import find_pipelines
from kedro.pipeline import Pipeline


from .pipelines import (
imagery_objects_detection,
visualize_objects,
# yolonas_image_objects_detection,
save_user_results,
yolox_image_objects_detection_sahi,
# yolonas_image_objects_detection_sahi,
visualize_object_sahi_yolox
)
def register_pipelines() -> dict[str, Pipeline]:
    """Register the project's pipelines.

    Returns:
        A mapping from pipeline names to ``Pipeline`` objects.
    """
    pipelines = find_pipelines()
    pipelines["__default__"] = sum(pipelines.values())
    return {
            "imagery-objects-prediction": imagery_objects_detection.create_pipeline(),
        "visualize-objects":  visualize_objects.create_pipeline(),
        # "yolonas-imagery-objects-prediction":  yolonas_image_objects_detection.create_pipeline(),
        "save-user-results": save_user_results.create_pipeline(),
        "yolox-image-objects-detection-sahi":yolox_image_objects_detection_sahi.create_pipeline(),
        # "yolonas-image-objects-detection-sahi":yolonas_image_objects_detection_sahi.create_pipeline(),
        "visualize-object-sahi-yolox":visualize_object_sahi_yolox.create_pipeline(),
        "__default__": Pipeline(
                [
                    imagery_objects_detection.create_pipeline(),
                    visualize_objects.create_pipeline(),
                    # yolonas_image_objects_detection.create_pipeline(),
                    save_user_results.create_pipeline(),
                    yolox_image_objects_detection_sahi.create_pipeline(),
                    visualize_object_sahi_yolox.create_pipeline(),
                    # yolonas_image_objects_detection_sahi.create_pipeline(),
                ]
            ),
        }


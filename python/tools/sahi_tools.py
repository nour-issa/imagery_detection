import re
import json

def txt_to_json_sahi(txt):
    object_predictions = re.findall(r'ObjectPrediction<\s*bbox: BoundingBox:\s*<\((\d+), (\d+), (\d+), (\d+)\),\s*w: (\d+),\s*h: (\d+)>,\s*mask: None,\s*score: PredictionScore:\s*<value: ([\d.]+)>,\s*category: Category:\s*<id: (\d+),\s*name: ([a-zA-Z_]+)>', txt)

    data = {}
    for idx, prediction in enumerate(object_predictions):
        class_id, class_name = int(prediction[7]), prediction[8]
        score = float(prediction[6])
        x_min, y_min, x_max, y_max = int(prediction[0]), int(prediction[1]), int(prediction[2]), int(prediction[3])

        data[str(idx)] = {
            "class_id": class_id,
            "class": class_name,
            "score": score,
            "bounding_box": [y_min,x_min,y_max,x_max]
        }

    return data
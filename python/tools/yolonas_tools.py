import sys
sys.path.append('C:\\xampp\htdocs\webmap\python\imagery-detect\sub_projects\super-gradients\src\super_gradients\\training')
sys.path.append('C:\\xampp\htdocs\webmap\python\imagery-detect\sub_projects\super-gradients\src\super_gradients')
sys.path.append('C:\\xampp\htdocs\webmap\python\imagery-detect\sub_projects\super-gradients\src\super_gradients\\training\\models')
from training import models
def inference_yolonas():
    DEVICE = "cuda:0"
    MODEL_ARCH ="yolo_nas_l"
    best_model = models.get(
        MODEL_ARCH,
        num_classes=9,
        checkpoint_path="C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\data\\06_models\\ckpt_best.pth"
    ).to(DEVICE)

    return best_model




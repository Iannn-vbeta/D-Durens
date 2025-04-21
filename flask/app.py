from flask import Flask, request, send_file
from ultralytics import YOLO
from PIL import Image
import os
from PIL import ImageFont
import uuid

app = Flask(__name__)

model = YOLO("flask\model\Yolov8-Deteksi-Penyakit-Durian.pt")

label_map = {
    0: "algaleafspot",
    1: "leafblight",
    2: "leafspot",
    3: "no disease"
}

@app.route("/predict", methods=["POST"])
def predict():
    if 'image' not in request.files:
        return {"error": "No image uploaded"}, 400

    img_file = request.files['image']
    filename = f"{uuid.uuid4().hex}.jpg"
    save_path = os.path.join("uploads", filename)
    img_file.save(save_path)

    results = model(save_path)[0]

    img = Image.open(save_path).convert("RGB")
    boxes = results.boxes
    names = results.names

    from PIL import ImageDraw, ImageFont

    draw = ImageDraw.Draw(img)
    font_size = 32 
    font = ImageFont.truetype("arial.ttf", font_size) 

    for box in boxes:
        xyxy = box.xyxy[0].tolist()
        class_id = int(box.cls[0].item())
        label = label_map.get(class_id, f"kelas-{class_id}")

        draw.rectangle(xyxy, outline="red", width=10)
        draw.text((xyxy[0] + 15, xyxy[1] + 10), label, fill="red", font=font)

    result_path = os.path.join("./flask/uploads", f"result_{filename}")
    img.save(result_path)

    return send_file(f"uploads\\result_{filename}", mimetype='image/jpeg')

if __name__ == "__main__":
    os.makedirs("uploads", exist_ok=True)
    app.run(debug=True)
 
from flask import Flask, request, jsonify, send_file
from ultralytics import YOLO
from PIL import Image, ImageDraw, ImageFont
import os
import uuid

app = Flask(__name__)

# Load model
model_penyakit = YOLO("flask/model/Yolov8-Deteksi-Penyakit-Durian.pt")
model_jenis = YOLO("flask/model/Yolov8-Deteksi-Jenis-Durian.pt")

# Label maps
label_map_penyakit = {
    0: "Alga Leaf Spot",
    1: "Leaf Blight",
    2: "Leaf Spot",
    3: "Tidak Punya Penyakit"
}

label_map_jenis = {
    0: "Durian Bawor",
    1: "Durian Duri Hitam",
    2: "Durian Kanyao",
    3: "Durian Monthong",
    4: "Durian Musang King",
    5: "Bukan Durian"
}

@app.route("/predict/penyakit", methods=["POST"])
def predict_penyakit():
    if 'image' not in request.files:
        return {"error": "No image uploaded"}, 400

    # Simpan gambar
    img_file = request.files['image']
    filename = f"{uuid.uuid4().hex}.jpg"
    save_path = os.path.join("flask/uploads", filename)
    img_file.save(save_path)

    # Proses deteksi
    img = Image.open(save_path).convert("RGB")
    draw = ImageDraw.Draw(img)
    try:
        font = ImageFont.truetype("arial.ttf", size=32)
    except:
        font = ImageFont.load_default()

    results = model_penyakit(save_path)[0]
    detected = []

    for box in results.boxes:
        xyxy = box.xyxy[0].tolist()
        class_id = int(box.cls[0].item())
        label = label_map_penyakit.get(class_id, f"kelas-{class_id}")
        detected.append(label)
        draw.rectangle(xyxy, outline="red", width=5)
        draw.text((xyxy[0] + 10, xyxy[1] + 10), f"Penyakit: {label}", fill="red", font=font)

    result_path = os.path.join("flask\\uploads", f"result_penyakit_{filename}")
    img.save(result_path)

    # Saran pengobatan
    perawatan = []
    if detected:
        if "Alga Leaf Spot" in detected:
            perawatan.append("Perawatan bercak daun alga...")
        if "Leaf Blight" in detected:
            perawatan.append("Perawatan Leaf Blight...")
        if "Leaf Spot" in detected:
            perawatan.append("Perawatan Leaf Spot...")
        if "Tidak Punya Penyakit" in detected:
            perawatan.append("Tidak perlu perawatan")
    else:
        perawatan.append("Tidak terdeteksi penyakit")

    return jsonify({
        "filename": f"result_penyakit_{filename}",
        "penyakit": list(set(detected)) or ["Tidak terdeteksi"],
        "pengobatan": list(set(perawatan))
    })


@app.route("/predict/jenis", methods=["POST"])
def predict_jenis():
    if 'image' not in request.files:
        return {"error": "No image uploaded"}, 400

    # Simpan gambar
    img_file = request.files['image']
    filename = f"{uuid.uuid4().hex}.jpg"
    save_path = os.path.join("flask/uploads", filename)
    img_file.save(save_path)

    # Proses deteksi
    img = Image.open(save_path).convert("RGB")
    draw = ImageDraw.Draw(img)
    try:
        font = ImageFont.truetype("arial.ttf", size=32)
    except:
        font = ImageFont.load_default()

    results = model_jenis(save_path)[0]
    detected = []

    for box in results.boxes:
        xyxy = box.xyxy[0].tolist()
        class_id = int(box.cls[0].item())
        label = label_map_jenis.get(class_id, f"kelas-{class_id}")
        detected.append(label)
        draw.rectangle(xyxy, outline="blue", width=5)
        draw.text((xyxy[0] + 10, xyxy[1] + 50), f"{label}", fill="blue", font=font)

    result_path = os.path.join("flask\\uploads", f"result_jenis_{filename}")
    img.save(result_path)

    return jsonify({
        "filename": f"result_jenis_{filename}",
        "jenis": list(set(detected)) or ["Tidak terdeteksi"]
    })


@app.route('/uploads/<filename>')
def uploaded_file(filename):
    return send_file(os.path.join("uploads", filename), mimetype='image/jpeg')

if __name__ == "__main__":
    os.makedirs("flask/uploads", exist_ok=True)
    app.run(debug=True)

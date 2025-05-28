from flask import Flask, request, jsonify, send_file
from ultralytics import YOLO
from PIL import Image, ImageDraw, ImageFont
import os
import uuid

app = Flask(__name__)

# Load kedua model
model_penyakit = YOLO("flask/model/Yolov8-Deteksi-Penyakit-Durian.pt")
model_jenis = YOLO("flask/model/Yolov8-Deteksi-Jenis-Durian.pt")  # Pastikan pathnya benar

# Peta label untuk model penyakit
label_map_penyakit = {
    0: "Alga Leaf Spot",
    1: "Leaf Blight",
    2: "Leaf Spot",
    3: "Tidak Punya Penyakit"
}

# Peta label untuk model jenis
label_map_jenis = {
    0: "Durian Bawor",
    1: "Durian Duri Hitam",
    2: "Durian Kanyao",
    3: "Durian Monthong",
    4: "Durian Musang King",
    5: "Bukan Durian"
}

@app.route("/predict", methods=["POST"])
def predict():
    if 'image' not in request.files:
        return {"error": "No image uploaded"}, 400

    img_file = request.files['image']
    filename = f"{uuid.uuid4().hex}.jpg"
    save_path = os.path.join("flask\\uploads", filename)
    img_file.save(save_path)

    # Load gambar
    img = Image.open(save_path).convert("RGB")
    draw = ImageDraw.Draw(img)
    font = ImageFont.truetype("arial.ttf", size=32)

    detected_penyakit = []
    detected_jenis = []

    # Deteksi penyakit
    results_penyakit = model_penyakit(save_path)[0]
    for box in results_penyakit.boxes:
        xyxy = box.xyxy[0].tolist()
        class_id = int(box.cls[0].item())
        label = label_map_penyakit.get(class_id, f"kelas-{class_id}")
        detected_penyakit.append(label)
        draw.rectangle(xyxy, outline="red", width=5)
        draw.text((xyxy[0] + 10, xyxy[1] + 10), f"Penyakit: {label}", fill="red", font=font)

    # Deteksi jenis
    results_jenis = model_jenis(save_path)[0]
    for box in results_jenis.boxes:
        xyxy = box.xyxy[0].tolist()
        class_id = int(box.cls[0].item())
        label = label_map_jenis.get(class_id, f"kelas-{class_id}")
        detected_jenis.append(label)
        draw.rectangle(xyxy, outline="blue", width=5)
        draw.text((xyxy[0] + 10, xyxy[1] + 50), f"{label}", fill="blue", font=font)

    # Simpan gambar hasil
    result_path = os.path.join("flask\\uploads", f"result_{filename}")
    img.save(result_path)

    # Logika pengobatan
    perawatan = []
    if detected_penyakit:
        if "Alga Leaf Spot" in detected_penyakit:
            perawatan.append("Perawatan bercak daun alga...")
        elif "Leaf Blight" in detected_penyakit:
            perawatan.append("Perawatan Leaf Blight...")
        elif "Leaf Spot" in detected_penyakit:
            perawatan.append("Perawatan Leaf Spot...")
        else:
            perawatan.append("Tidak perlu perawatan")
    else:
        perawatan.append("Tidak terdeteksi penyakit")

    return jsonify({
        "filename": f"result_{filename}",
        "penyakit": list(set(detected_penyakit)) or ["Tidak terdeteksi"],
        "jenis": list(set(detected_jenis)) or ["Tidak terdeteksi"],
        "pengobatan": list(set(perawatan))
    })

@app.route('/uploads/<filename>')
def uploaded_file(filename):
    return send_file(os.path.join("uploads", filename), mimetype='image/jpeg')

if __name__ == "__main__":
    os.makedirs("uploads", exist_ok=True)
    app.run(debug=True)

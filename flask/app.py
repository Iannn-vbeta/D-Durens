from flask import Flask, request, send_file, jsonify, send_from_directory
from ultralytics import YOLO
from PIL import Image, ImageDraw, ImageFont
import os
import uuid
from PIL import ImageFont

app = Flask(__name__)

model = YOLO("flask\model\Yolov8-Deteksi-Penyakit-Durian.pt")

label_map = {
    0: "Alga Leaf Spot",
    1: "Leaf Blight",
    2: "Leaf Spot",
    3: "Tidak Punya Penyakit"
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
    boxes = results.boxes

    img = Image.open(save_path).convert("RGB")
    draw = ImageDraw.Draw(img)
    font_size = 32
    font = ImageFont.truetype("arial.ttf", font_size)

    detected_labels = []

    for box in boxes:
        xyxy = box.xyxy[0].tolist()
        class_id = int(box.cls[0].item())
        label = label_map.get(class_id, f"kelas-{class_id}")
        detected_labels.append(label)
        draw.rectangle(xyxy, outline="red", width=10)
        draw.text((xyxy[0] + 15, xyxy[1] + 10), label, fill="red", font=font)

    result_path = os.path.join("flask/uploads", f"result_{filename}")
    img.save(result_path)
    perawatan = []
    if detected_labels:
        if detected_labels[0] == "Alga Leaf Spot":
            perawatan.append("Perawatan bercak daun alga (algal leaf spot) pada durian melibatkan pembersihan daun yang sakit, pemangkasan cabang yang terinfeksi, dan penggunaan fungisida tembaga jika infeksi parah. Pemangkasan cabang dan daun yang sakit membantu mencegah penyebaran penyakit, sementara fungisida tembaga membantu mengendalikan infeksi.")
        elif detected_labels[0] == "Leaf Blight":
            perawatan.append("Perawatan Leaf Blight (hawar daun) pada durian dapat dilakukan dengan menjaga kebersihan kebun, memangkas daun atau ranting yang terinfeksi, dan membakar sisa tanaman yang sakit untuk mencegah penyebaran. Penyemprotan fungisida berbahan aktif seperti mancozeb atau tembaga hidroksida juga efektif dilakukan secara berkala, terutama saat musim hujan. Selain itu, penting menjaga sirkulasi udara dan pencahayaan yang baik di sekitar pohon durian dengan penjarangan tanaman serta memastikan drainase tanah optimal agar kelembapan tidak berlebih, karena kondisi lembap mendukung perkembangan penyakit ini.")
        elif detected_labels[0] == "Leaf Spot":
            perawatan.append("Perawatan Leaf Spot pada durian dapat dilakukan dengan cara menjaga kebersihan kebun, memangkas daun atau ranting yang terinfeksi, serta membuang sisa tanaman yang terkontaminasi untuk mencegah penyebaran. Penyemprotan fungisida berbahan aktif seperti mancozeb atau klorotalonil secara teratur juga efektif untuk mengendalikan jamur penyebab penyakit.")
        else: 
            perawatan.append('Tidak Perlu Perawatan')
    print(perawatan)
    return jsonify({
        "filename": f"result_{filename}",
        "penyakit": list(set(detected_labels)) or ["Tidak terdeteksi"],
        "pengobatan" : list(set(perawatan)) or ["Tidak Perlu Dilakukan Pengobatan/Perawatan"]
    })

@app.route('/uploads/<filename>')
def uploaded_file(filename):
    return send_file(f"uploads\\{filename}", mimetype='image/jpeg')

if __name__ == "__main__":
    os.makedirs("uploads", exist_ok=True)
    app.run(debug=True)
 
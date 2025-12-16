from flask import Flask, request, jsonify
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing import image
import numpy as np
import os

app = Flask(__name__)

MODEL_PATH = "lungcare_model.h5"
model = load_model(MODEL_PATH)

# ⚠️ HARUS SESUAI URUTAN OUTPUT MODEL
LABELS = ["Normal", "Pneumonia", "Tuberculosis", "Pneumotoraks"]

@app.route("/predict", methods=["POST"])
def predict():
    if "file" not in request.files:
        return jsonify({"error": "No file uploaded"}), 400

    file = request.files["file"]

    os.makedirs("uploads", exist_ok=True)
    file_path = os.path.join("uploads", file.filename)
    file.save(file_path)

    # === PREPROCESS SESUAI TRAINING ===
    img = image.load_img(file_path, target_size=(240, 240))
    img_array = image.img_to_array(img)
    img_array = img_array / 255.0
    img_array = np.expand_dims(img_array, axis=0)

    # === PREDIKSI MURNI MODEL ===
    predictions = model.predict(img_array)[0]

    # Softmax safety (kalau model belum softmax)
    predictions = np.exp(predictions) / np.sum(np.exp(predictions))

    result = {}
    for label, value in zip(LABELS, predictions):
        result[label] = round(float(value) * 100, 2)

    return jsonify(result)

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
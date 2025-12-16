<?php
// index.php — Halaman utama LungCare
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LungCare | Cek Kesehatan Paru-paru</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #b8eaff;
      overflow-x: hidden;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    nav {
      background-color: white;
      display: flex;
      align-items: center;
      padding: 12px 40px;
      margin: 20px;
      border-radius: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .nav-left { display: flex; align-items: center; gap: 40px; }
    .logo { display: flex; align-items: center; font-weight: 700; font-size: 1.4rem; }
    .logo img { width: 40px; height: 40px; margin-right: 10px; }
    .nav-links { display: flex; align-items: center; gap: 15px; }
    .nav-links a {
      text-decoration: none; color: black; font-weight: 500;
      padding: 8px 15px; border-radius: 10px; transition: 0.3s;
    }
    .nav-links a:hover, .nav-links a.active { background-color: #d9d9d9; }

    .container {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
      margin-top: -20px;
    }

    .hero {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
      margin-bottom: 30px;
      max-width: 1200px;
    }

    .hero img { 
      width: 280px; 
      height: auto;
    }
    
    .hero-text { 
      max-width: 650px; 
      text-align: left; 
    }
    
    .hero-text h2 { 
      font-size: 28px; 
      font-weight: 700; 
      margin-bottom: 15px; 
      line-height: 1.3;
    }
    
    .hero-text p { 
      font-size: 18px; 
      color: #333; 
      line-height: 1.6; 
      margin-bottom: 12px; 
    }

    .upload-section {
      width: 100%;
      max-width: 900px;
      margin-top: 20px;
      text-align: center;
    }

    .upload-title {
      text-align: left;
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 10px;
      color: #333;
      width: 100%;
    }

    .upload-area {
      width: 100%;
      height: 250px;
      border: 2px dashed #000;
      border-radius: 15px;
      background-color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: 0.3s;
      margin: 0 auto;
    }

    .upload-area.dragover { 
      background-color: #e0f5ff; 
      border-color: #1e90ff; 
    }
    
    .upload-area img { 
      width: 70px; 
      margin-bottom: 15px; 
      opacity: 0.8; 
    }
    
    .upload-area h3 { 
      font-size: 16px; 
      margin: 0 0 5px 0; 
      font-weight: 600;
    }
    
    .upload-area p { 
      font-size: 13px; 
      color: #555; 
      margin: 0;
    }

    footer {
      text-align: center;
      color: #333;
      font-size: 12px;
      padding: 20px 0;
      margin-top: 20px;
      width: 100%;
    }

    form#uploadForm {
      width: 100%;
      max-width: 900px;
      margin: 0 auto;
    }

    .upload-btn-wrapper {
      text-align: left;
      margin-bottom: 15px;
      width: 100%;
    }

    .upload-btn {
      background-color: #1e90ff;
      color: white;
      font-weight: 600;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 8px;
      transition: 0.3s;
      cursor: pointer;
      display: inline-block;
      border: none;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
    }

    .upload-btn:hover {
      background-color: #0f72cf;
    }

    input[type="file"] {
      display: none;
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <nav>
    <div class="nav-left">
      <div class="logo">
        <img src="assets/logo.png" alt="LungCare Logo">
        <span class="title">LungCare</span>
      </div>
      <div class="nav-links">
        <a href="index.php" class="active">Home</a>
        <a href="upload.php">Upload</a>
        <a href="about.php">About</a>
      </div>
    </div>
  </nav>

  <!-- KONTEN UTAMA -->
  <div class="container">
    <div class="hero">
      <img src="assets/logo.png" alt="Lung Icon">
      <div class="hero-text">
        <h2>Cek Kesehatan Paru-paru Anda dengan Mudah!</h2>
        <p>Gunakan website ini untuk membantu mendeteksi penyakit paru-paru seperti <b>Pneumonia</b>, <b>Tuberkulosis</b>, dan <b>Pneumotoraks</b>.</p>
        <p>Cukup dengan mengunggah foto hasil rontgen paru-paru, sistem akan memeriksa secara otomatis dengan bantuan komputer pintar dan memberikan hasil yang menunjukkan persentase keterangan jenis penyakitnya.</p>
      </div>
    </div>

    <!-- FORM UPLOAD -->
    <div class="upload-section">
      <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
        <div class="upload-btn-wrapper">
          <label for="fileInput" class="upload-btn">📤 Upload X-ray photo</label>
          <input type="file" id="fileInput" name="xray" accept="image/*">
        </div>
        
        <div class="upload-area" id="uploadArea">
          <img src="assets/upload_icon.png" alt="Upload Icon">
          <h3>Drag & Drop to Upload</h3>
          <p>Seret & Lepas untuk Mengunggah</p>
        </div>
      </form>
    </div>
  </div>

  <footer>
    &copy; <?php echo date("Y"); ?> LungCare. Semua Hak Dilindungi.
  </footer>

  <script>
    // --- Drag & Drop dan Upload Otomatis ---
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const uploadForm = document.getElementById('uploadForm');

    uploadArea.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
      uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadArea.classList.remove('dragover');
      const file = e.dataTransfer.files[0];
      if (file) {
        fileInput.files = e.dataTransfer.files;
        uploadForm.submit();
      }
    });

    uploadArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', (e) => {
      if (e.target.files.length > 0) {
        uploadForm.submit();
      }
    });
  </script>

</body>
</html>
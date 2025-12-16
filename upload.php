<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["xray"])) {

    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = uniqid() . "_" . basename($_FILES["xray"]["name"]);
    $filePath = $uploadDir . $filename;

    move_uploaded_file($_FILES["xray"]["tmp_name"], $filePath);

    // === KIRIM KE FLASK ===
    $ch = curl_init("http://127.0.0.1:5000/predict");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        "file" => new CURLFile(realpath($filePath))
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    // ❌ JANGAN LANJUT JIKA ERROR
    if (!$result || isset($result["error"])) {
        die("Gagal mendapatkan hasil prediksi dari model");
    }

    $_SESSION["result"] = $result;
    $_SESSION["uploaded_file"] = $filePath;

    header("Location: hasil.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LungCare - Upload</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #b8eaff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Navbar */
    nav {
      background-color: white;
      display: flex;
      align-items: center;
      padding: 12px 40px;
      margin: 20px;
      border-radius: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .nav-left { 
      display: flex; 
      align-items: center; 
      gap: 40px; 
      width: 100%;
    }
    
    .logo { 
      display: flex; 
      align-items: center; 
      font-weight: 700; 
      font-size: 1.4rem; 
    }
    
    .logo img { 
      width: 40px; 
      height: 40px; 
      margin-right: 10px; 
    }
    
    .nav-links { 
      display: flex; 
      align-items: center; 
      gap: 15px; 
    }

    .nav-links a {
      text-decoration: none;
      color: black;
      font-weight: 500;
      padding: 8px 15px;
      border-radius: 10px;
      transition: 0.3s;
    }

    .nav-links a:hover,
    .nav-links a.active {
      background-color: #d9d9d9;
    }

    /* Main content */
    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 20px;
      margin-top: 30px;
    }

    .page-title {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 30px;
      color: #333;
    }

    /* Upload Container */
    .upload-container {
      width: 100%;
      max-width: 800px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Upload Card */
    .upload-card {
      background-color: white;
      border-radius: 15px;
      width: 100%;
      padding: 40px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }

    .upload-card h2 {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 5px;
      color: #333;
    }

    .upload-card .subtitle {
      font-size: 14px;
      color: #666;
      margin-bottom: 30px;
    }

    /* Upload Box */
    .upload-box {
      width: 100%;
      height: 280px;
      border: 2px dashed #000;
      border-radius: 12px;
      background-color: #f8f8f8;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      margin: 0 auto;
    }

    .upload-box:hover {
      background-color: #f0f8ff;
      border-color: #1e90ff;
    }

    .upload-box.dragover {
      background-color: #e0f7ff;
      border-color: #1e90ff;
      border-style: solid;
    }

    .upload-box img {
      width: 80px;
      margin-bottom: 20px;
      opacity: 0.7;
    }

    .upload-box p {
      font-size: 16px;
      font-weight: 500;
      margin: 5px 0;
      color: #333;
    }

    .upload-box .indonesian {
      font-size: 14px;
      color: #666;
      font-weight: normal;
    }

    /* Upload Button */
    .upload-btn-wrapper {
      width: 100%;
      text-align: left;
      margin-bottom: 20px;
    }

    .upload-btn {
      background-color: #1e90ff;
      color: white;
      font-weight: 600;
      text-decoration: none;
      padding: 12px 24px;
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

    /* Description */
    .description {
      margin-top: 20px;
      font-size: 16px;
      color: #333;
      line-height: 1.6;
      max-width: 700px;
      text-align: center;
    }

    .description p {
      margin-bottom: 10px;
    }

    /* Separator Line */
    .separator {
      width: 100%;
      height: 1px;
      background-color: #ddd;
      margin: 25px 0;
    }

    /* Form styling */
    form#uploadForm {
      width: 100%;
    }

    input[type="file"] {
      display: none;
    }

    /* Footer */
    footer {
      text-align: center;
      color: #333;
      font-size: 12px;
      padding: 20px 0;
      margin-top: 30px;
      width: 100%;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav>
    <div class="nav-left">
      <div class="logo">
        <img src="assets/logo.png" alt="LungCare Logo">
        <span class="title">LungCare</span>
      </div>
      <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="upload.php" class="active">Upload</a>
        <a href="about.php">About</a>
      </div>
    </div>
  </nav>

  <!-- Main Section -->
  <main>
    <div class="upload-container">
      <h1 class="page-title">Upload Foto Rontgen Paru-paru</h1>
      
      <div class="upload-card">
        <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
          <div class="upload-btn-wrapper">
            <label for="fileInput" class="upload-btn">📤 Upload X-ray photo</label>
            <input type="file" id="fileInput" name="xray" accept="image/*">
          </div>
          
          <div class="upload-box" id="dropArea">
            <img src="assets/upload_icon.png" alt="Upload Icon">
            <p><strong>Drag & Drop to Upload</strong></p>
            <p class="indonesian">Seret & Lepas untuk Mengunggah</p>
          </div>
        </form>
        
        <div class="separator"></div>
        
        <div class="description">
          <p>Unggah foto rontgen dan biarkan sistem kami memberikan hasil pemeriksaan awal secara cepat.</p>
        </div>
      </div>
      
      <div class="description">
        <p>Unggah foto hasil rontgen paru-paru Anda dan biarkan sistem menganalisisnya secara otomatis untuk mendeteksi tanda-tanda penyakit paru seperti Pneumonia, Tuberkulosis, atau Pneumotoraks.</p>
      </div>
    </div>
  </main>

  <footer>
    &copy; <?php echo date("Y"); ?> LungCare. Semua Hak Dilindungi.
  </footer>

  <script>
    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('fileInput');
    const form = document.getElementById('uploadForm');

    // Klik area upload
    dropArea.addEventListener('click', () => fileInput.click());

    // Drag & Drop events
    dropArea.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropArea.classList.add('dragover');
    });

    dropArea.addEventListener('dragleave', () => {
      dropArea.classList.remove('dragover');
    });

    dropArea.addEventListener('drop', (e) => {
      e.preventDefault();
      dropArea.classList.remove('dragover');
      
      if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        form.submit(); // Kirim langsung ke PHP dan Flask
      }
    });

    // File input change event
    fileInput.addEventListener('change', (e) => {
      if (e.target.files.length > 0) {
        form.submit();
      }
    });
  </script>
</body>
</html>
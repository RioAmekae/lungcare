<?php
session_start();

if (!isset($_SESSION["result"]) || !isset($_SESSION["uploaded_file"])) {
    die("Data hasil tidak tersedia.");
}

$result = $_SESSION["result"];
$image  = $_SESSION["uploaded_file"];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>LungCare - Hasil Pemeriksaan</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      background-color: #b3e6ff;
      font-family: 'Poppins', sans-serif;
      margin: 0;
    }

    /* ==== NAVBAR ==== */
    nav {
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 40px;
      margin: 20px;
      border-radius: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .nav-left {
      display: flex;
      align-items: center;
      gap: 40px;
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
      gap: 20px;
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

    /* ==== CONTENT ==== */
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    h1 {
      font-size: 2.4rem;
      margin-top: 10px;
      font-weight: 700;
    }

    /* ==== RESULT BOX ==== */
    .result-box {
      display: flex;
      align-items: center;
      background-color: white;
      border: 2px dashed black;
      border-radius: 20px;
      padding: 30px;
      margin-top: 25px;
      width: 40%;
      justify-content: center;
      gap: 60px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }

    .result-box img {
      width: 300px;
      height: auto;
      border-radius: 15px;
      object-fit: cover;
    }

    .bars {
      text-align: left;
      width: 320px;
    }

    .bar {
      margin-bottom: 20px;
    }

    .bar label {
      display: flex;
      justify-content: space-between;
      font-weight: 500;
    }

    .bar-bg {
      background-color: #e0e0e0;
      height: 14px;
      border-radius: 10px;
      overflow: hidden;
      position: relative;
    }

    .bar-fill {
      height: 14px;
      border-radius: 10px;
    }

    .normal { background-color: #2ecc71; }
    .pneumonia { background-color: #e67e22; }
    .tuberculosis { background-color: #f39c12; }
    .pneumotoraks { background-color: #3498db; }

    /* ==== BUTTON AREA ==== */
    .action {
      margin-top: 40px;
      text-align: center;
    }

    .buttons {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-top: 15px;
    }

    .btn {
      border: none;
      border-radius: 15px;
      color: white;
      font-weight: bold;
      padding: 15px 40px;
      cursor: pointer;
      font-size: 1rem;
      transition: 0.3s;
    }

    .btn-blue {
      background-color: #007bff;
    }

    .btn-blue:hover {
      background-color: #0066d3;
    }

    .btn-red {
      background-color: #e60000;
    }

    .btn-red:hover {
      background-color: #c50000;
    }
  </style>
</head>
<body>
  <!-- ==== NAVBAR ==== -->
  <nav>
    <div class="nav-left">
      <div class="logo">
        <img src="assets/logo.png" alt="logo">
        LungCare
      </div>
      <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="upload.php" class="active">Upload</a>
        <a href="about.php">About</a>
      </div>
    </div>
  </nav>

  <div class="container">
    <h1>Hasil Pemeriksaan</h1>

    <!-- Elemen yang akan disimpan -->
    <div class="result-box" id="resultBox">
      <?php if ($image): ?>
        <img src="<?php echo $image; ?>" alt="X-ray Image">
      <?php endif; ?>

      <div class="bars">
        <?php
        foreach ($result as $label => $value) {
          $class = strtolower($label);
          echo "
            <div class='bar'>
              <label>$label <span>{$value}%</span></label>
              <div class='bar-bg'>
                <div class='bar-fill $class' style='width: {$value}%;'></div>
              </div>
            </div>
          ";
        }
        ?>
      </div>
    </div>

    <div class="action">
      <h2>Simpan Hasil?</h2>
      <div class="buttons">
        <button class="btn btn-blue" onclick="saveAsImage()">Simpan</button>
        <button class="btn btn-red" onclick="window.location.href='upload.php'">Tidak</button>
      </div>
    </div>
  </div>

  <!-- Library html2canvas untuk tangkap tampilan -->
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script>
    function saveAsImage() {
      const node = document.getElementById('resultBox');
      html2canvas(node, { scale: 2 }).then(canvas => {
        const link = document.createElement('a');
        link.download = 'Hasil_Pemeriksaan_LungCare.png';
        link.href = canvas.toDataURL();
        link.click();
        alert("Hasil pemeriksaan disimpan ke perangkat Anda!");
      });
    }
  </script>
</body>
</html>
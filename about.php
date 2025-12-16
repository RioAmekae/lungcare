<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang LungCare</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Poppins", sans-serif;
      background-color: #b8eaff;
      overflow-y: auto;
    }

    /* Navbar */
    nav {
      background-color: white;
      display: flex;
      align-items: center;
      padding: 12px 40px;
      margin: 20px;
      border-radius: 15px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
      align-items: center;
      gap: 15px;
    }

    .nav-links a {
      text-decoration: none;
      color: black;
      font-weight: 500;
      font-size: 1rem;
      padding: 8px 15px;
      border-radius: 10px;
      transition: 0.3s;
    }

    .nav-links a:hover,
    .nav-links a.active {
      background-color: #d9d9d9;
    }

    /* Kontainer utama */
    .container {
      text-align: center;
      padding: 40px 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    h1 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 40px;
      color: #333;
    }

    /* Card styling */
    .card {
      display: flex;
      align-items: center;
      background-color: white;
      border-radius: 20px;
      padding: 30px;
      margin: 30px auto;
      max-width: 1000px;
      gap: 40px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .card:nth-child(even) {
      flex-direction: row-reverse;
    }

    .card img {
      width: 300px;
      height: 250px;
      border-radius: 10px;
      object-fit: cover;
    }

    .card .text {
      flex: 1;
      text-align: left;
    }

    .card h2 {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 15px;
      color: #1e90ff;
    }

    .card p {
      font-size: 16px;
      line-height: 1.8;
      color: #333;
      text-align: justify;
    }

    /* Footer */
    footer {
      text-align: center;
      color: #333;
      font-size: 12px;
      padding: 20px 0;
      margin-top: 40px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .card {
        flex-direction: column;
        padding: 20px;
      }
      
      .card:nth-child(even) {
        flex-direction: column;
      }
      
      .card img {
        width: 100%;
        height: auto;
      }
      
      h1 {
        font-size: 28px;
      }
      
      .card h2 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>

<nav>
  <div class="nav-left">
    <div class="logo">
      <img src="assets/logo.png" alt="LungCare Logo">
      <span class="title">LungCare</span>
    </div>
    <div class="nav-links">
      <a href="index.php">Home</a>
      <a href="upload.php">Upload</a>
      <a href="about.php" class="active">About</a>
    </div>
  </div>
</nav>

  <div class="container">
    <h1>Tentang Hasil Rontgen Paru-paru</h1>

    <!-- Paru-paru Normal -->
    <div class="card">
      <img src="assets/normal.jpeg" alt="Paru normal">
      <div class="text">
        <h2>Paru-paru Normal</h2>
        <p>
          Paru-paru normal pada hasil rontgen biasanya tampak berwarna gelap karena paru-paru terisi udara, sehingga sinar rontgen dapat melewati dengan mudah. Tidak terdapat bercak putih, bayangan, atau gambaran abnormal lainnya yang bisa mengindikasikan adanya infeksi, cairan, atau kelainan jaringan.
          <br><br>
          Selain itu, batas paru-paru terlihat jelas, posisi diafragma normal, dan tidak ada tanda penebalan pada dinding paru maupun penumpukan cairan di rongga pleura. Kondisi ini menunjukkan bahwa paru-paru dalam keadaan sehat dan berfungsi dengan baik tanpa adanya gangguan penyakit.
        </p>
      </div>
    </div>

    <!-- Pneumonia -->
    <div class="card">
      <img src="assets/pneumonia.jpg" alt="Pneumonia">
      <div class="text">
        <h2>Pneumonia</h2>
        <p>
          Gambar ini adalah hasil rontgen dada pasien yang mengalami pneumonia, yaitu infeksi pada paru-paru. Bagian yang penulis lingkari menunjukkan area paru-paru yang tampak lebih putih atau buram dibandingkan area sekitarnya.
          <br><br>
          Normalnya, paru-paru yang sehat pada rontgen akan terlihat lebih gelap karena berisi udara. Namun, pada kasus pneumonia, kantung udara di paru-paru terisi oleh cairan atau nanah akibat infeksi, sehingga tampak putih di hasil rontgen. Ciri seperti ini sangat khas pada pneumonia, sehingga melalui citra rontgen, dokter bisa mendeteksi adanya infeksi tersebut.
        </p>
      </div>
    </div>

    <!-- Tuberculosis -->
    <div class="card">
      <img src="assets/tb.jpg" alt="Tuberculosis">
      <div class="text">
        <h2>Tuberculosis</h2>
        <p>
          Gambar ini adalah hasil rontgen dada pasien yang mengalami tuberkulosis paru, yaitu infeksi kronis akibat bakteri Mycobacterium tuberculosis.
          <br><br>
          Pada kedua sisi paru-paru, terlihat jelas adanya bercak-bercak putih yang menyebar, terutama di bagian atas paru. Bercak putih ini menunjukkan adanya peradangan, kerusakan jaringan, atau infiltrasi akibat infeksi TB. Pada kasus TB yang lebih parah, bahkan bisa ditemukan rongga atau lubang (kavitas) di paru-paru, namun pada gambar ini masih berupa bercak-bercak menyebar.
        </p>
      </div>
    </div>

    <!-- Pneumotoraks -->
    <div class="card">
      <img src="assets/pneumotorax.jpg" alt="Pneumotoraks">
      <div class="text">
        <h2>Pneumotoraks</h2>
        <p>
          Gambar ini adalah rontgen dada pasien dengan kondisi pneumotoraks, yaitu adanya udara bebas di rongga pleura, ruang antara paru-paru dan dinding dada.
          <br><br>
          Area yang penulis lingkari di sisi kiri dada pasien (kanan pada gambar) menunjukkan ruang hitam polos tanpa bayangan jaringan paru. Ini adalah udara bebas di rongga pleura yang seharusnya tidak ada. Rongga pleura yang dimaksudkan sudah diberi tanda pada gambar yang dimana pleura adalah garis tipis yang memisahkan paru yang mengempis dengan area udara bebas tersebut.
        </p>
      </div>
    </div>
  </div>

  <footer>
    &copy; <?php echo date("Y"); ?> LungCare. Semua Hak Dilindungi.
  </footer>
  
</body>
</html>
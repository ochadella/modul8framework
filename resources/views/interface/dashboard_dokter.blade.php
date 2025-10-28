<?php
session_start();

// 🚨 Cek apakah user sudah login dan rolenya dokter
if (!session()->has('user') || strtolower(session('user.role')) !== 'dokter') {
    header('Location: /login');
    exit;
}

$nama = session('user.nama') ?? 'Dokter';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>RSHP — Dashboard Dokter</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom right, #142a46), #102f76;
      color: #f8fafc;
      margin: 0;
      padding: 0;
    }

    /* Navbar */
    .navbar {
      background: linear-gradient(to right, #102f76, #f9a01b);
      padding: 15px 40px;
    }

    .navbar a {
      color: white !important;
      font-weight: 500;
      font-size: 1rem;
      margin-left: 20px;
      transition: 0.3s;
      font-weight: bold
    }

    .navbar a:hover {
      opacity: 0.9;
      text-decoration: underline;
    }

    /* Hero */
    .hero {
      text-align: center;
      padding: 90px 20px;
      background: linear-gradient(to bottom, #102f76, #142a46);
    }

    .hero h1 {
      font-weight: 700;
      font-size: 2.8rem;
      color: #f9a01b;
    }

    .hero p {
      color: #f1f5f9;
      font-size: 1.1rem;
      margin-bottom: 25px;
    }

    .btn-cta {
      background: linear-gradient(to right, #f9a01b, #ff9554);
      color: #fff;
      font-weight: 600;
      padding: 12px 30px;
      border-radius: 12px;
      border: none;
      transition: 0.2s;
      font-size: 1.05rem;
      text-decoration: none;
      display: inline-block;
    }

    .btn-cta:hover {
      opacity: 0.9;
      transform: translateY(-3px);
    }

    /* Section Cards */
    .section-title {
      text-align: center;
      font-weight: 700;
      margin-top: 50px;
      color: #f9a01b;
      font-size: 1.8rem;
    }

    .menu-card {
      border: none;
      border-radius: 1rem;
      background: #fff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform .2s ease, box-shadow .2s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }

    .menu-icon {
      font-size: 2.5rem;
      color: #102f76;
    }

    .menu-img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    .card-title {
      color: #f9a01b;
      font-weight: 600;
    }

    .text-muted {
      color: #142a46 !important;
    }

    .row > div {
      display: flex;
    }

    footer {
      text-align: center;
      color: #ccc;
      font-size: 0.9rem;
      padding: 20px;
      background-color: #102f76;
      margin-top: 40px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar d-flex justify-content-between align-items-center">
    <span class="fw-bold text-white fs-5">
      🏥 <strong>RSHP</strong> — Dashboard Dokter
    </span>
    <div>
      <a href="dashboard_dokter.php"><i class="bi bi-house-door-fill"></i> Home</a>
      <a href="../views/dokter/pasien/DataPasien.php"><i class="bi bi-people-fill"></i> Pasien</a>
      <a href="../views/dokter/rekammedis/DataRekamMedis.php"><i class="bi bi-journal-medical"></i> Rekam Medis</a>
      <a href="../interface/login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero">
    <h1>Selamat datang, drh. <?= htmlspecialchars($nama); ?> 👨‍⚕️</h1>
    <p>Kelola data pasien dan rekam medis dengan profesional & penuh empati.</p>
    <a href="../views/dokter/jadwal/jadwal_pemeriksaan_dokter.php" class="btn-cta">
      ✍️ Jadwal Pemeriksaan
    </a>
  </section>

  <!-- Features -->
  <section class="container my-5 text-center">
    <h2 class="section-title mb-4">Fitur Dokter</h2>
    <div class="row justify-content-center g-4">

      <!-- 1. Data Rekam Medis -->
      <div class="col-md-4 d-flex">
        <a href="../views/dokter/rekammedis/DataRekamMedis.php" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-journal-medical menu-icon"></i>
            <h5 class="card-title mt-3">Data Rekam Medis</h5>
            <p class="text-muted small">Lihat data rekam medis pasien yang telah dibuat oleh perawat.</p>
          </div>
        </a>
      </div>

      <!-- 3. Data Pasien -->
      <div class="col-md-4 d-flex">
        <a href="../views/dokter/pasien/DataPasien.php" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-people menu-icon"></i>
            <h5 class="card-title mt-3">Daftar Pasien</h5>
            <p class="text-muted small">Lihat daftar pasien aktif, pemilik, dan informasi hewan peliharaan.</p>
          </div>
        </a>
      </div>

      <!-- 4. Jadwal Pemeriksaan -->
      <div class="col-md-4 d-flex">
        <a href="../views/dokter/jadwal/jadwal_pemeriksaan_dokter.php" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-calendar-check menu-icon"></i>
            <h5 class="card-title mt-3">Jadwal Pemeriksaan</h5>
            <p class="text-muted small">Lihat jadwal pemeriksaan pasien dan waktu praktik dokter.</p>
          </div>
        </a>
      </div>

      <!-- 5. Data Jenis Hewan -->
      <div class="col-md-4 d-flex">
        <a href="../views/dokter/jenis/Datajenishewan_dokter.php" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-bug menu-icon"></i>
            <h5 class="card-title mt-3">Data Jenis Hewan</h5>
            <p class="text-muted small">Lihat daftar jenis hewan yang terdaftar di sistem rekam medis.</p>
          </div>
        </a>
      </div>

      <!-- 6. Data Ras Hewan (DENGAN GAMBAR) -->
      <div class="col-md-4 d-flex">
        <a href="../views/dokter/ras/Datarashewan_dokter.php" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-bug menu-icon"></i>
            <h5 class="card-title mt-3">Data Ras Hewan</h5>
            <p class="text-muted small">Lihat informasi ras dari setiap jenis hewan yang terdaftar.</p>
          </div>
        </a>
      </div>

    </div>
  </section>

  <footer>
    © <?= date('Y'); ?> RS Hewan Purnama — Dashboard Dokter | Made by Ocha Della 💙
  </footer>

</body>
</html>

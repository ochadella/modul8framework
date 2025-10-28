<?php
// Mulai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek login & role
if (!session()->has('user') || strtolower(session('user.role')) !== 'perawat') {
    header('Location: /login');
    exit;
}

// Ambil nama dari session
$namaPerawat = session('user.nama') ?? 'Perawat';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Perawat - RSHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
      margin: 0;
      padding: 0;
    }
    nav {
      background-color: #fff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .navbar-brand {
      color: #102f76 !important;
      font-weight: bold;
    }
    .nav-link {
      color: #102f76 !important;
      font-weight: 600;
      transition: 0.3s ease;
    }
    .nav-link:hover {
      color: #f9a01b !important;
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
    }
    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .menu-icon {
      font-size: 2.5rem;
      color: #102f76;
    }
    .card-title {
      color: #f9a01b;
      font-weight: 600;
    }
    h1 {
      background: linear-gradient(90deg, #ffff 0%, #f9a01b 80%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 700;
    }
    .intro-text {
      background: linear-gradient(90deg, #ffff 0%, #f9a01b 80%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 500;
    }
    .text-muted {
      color: #142a46 !important;
    }
    .row > div {
      display: flex;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold">👩‍⚕️ Perawat RSHP</a>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="dashboard_perawat.php" class="nav-link active">Dashboard</a></li>
        <li class="nav-item"><a href="../views/perawat/pasien/data_pasien.php" class="nav-link">Data Pasien</a></li>
        <li class="nav-item"><a href="../views/perawat/pemeriksaan/data_pemeriksaan.php" class="nav-link">Pemeriksaan</a></li>
        <li class="nav-item"><a href="../views/perawat/jadwal/jadwal_jaga.php" class="nav-link">Jadwal Jaga</a></li>
        <li class="nav-item"><a href="../interface/login.php" class="nav-link">Logout</a></li>
      </ul>
    </div>
  </nav>

  <!-- Konten -->
  <div class="container py-5 text-center">
    <h1 class="fw-bold">Halo, <?= htmlspecialchars($namaPerawat) ?> 👋</h1>
    <p class="intro-text mb-5">Kelola data pasien, hasil pemeriksaan, dan jadwal jaga dengan mudah di RS Hewan Peliharaan.</p>

    <div class="row justify-content-center g-4">
      <!-- Data Pasien -->
      <div class="col-md-4 d-flex">
        <a href="../views/perawat/pasien/data_pasien.php" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-people-fill menu-icon"></i>
            <h5 class="card-title mt-3">Daftar Pasien</h5>
            <p class="text-muted small">Lihat dan pantau daftar pasien hewan beserta pemiliknya.</p>
          </div>
        </a>
      </div>

      <!-- Pemeriksaan -->
      <div class="col-md-4 d-flex">
        <a href="../views/perawat/pemeriksaan/data_pemeriksaan.php" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-heart-pulse menu-icon"></i>
            <h5 class="card-title mt-3">Pemeriksaan</h5>
            <p class="text-muted small">Catat hasil pemeriksaan hewan secara akurat dan cepat.</p>
          </div>
        </a>
      </div>

      <!-- Jadwal Jaga -->
      <div class="col-md-4 d-flex">
        <a href="../views/perawat/jadwal/jadwal_jaga.php" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-calendar-check menu-icon"></i>
            <h5 class="card-title mt-3">Jadwal Jaga</h5>
            <p class="text-muted small">Lihat shift jaga Anda agar pelayanan tetap optimal.</p>
          </div>
        </a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

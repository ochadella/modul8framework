<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Resepsionis - RSHP</title>
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
    .dropdown-menu {
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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
      background: linear-gradient(90deg, #FFFF 0%, #f9a01b 80%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 700;
    }
    .intro-text {
      background: linear-gradient(90deg, #FFFF 0%, #f9a01b 80%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 500;
    }
    .badge {
      background-color: #f9a01b !important;
      color: #102f76 !important;
      font-weight: 600;
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
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold">💁‍♀️ Resepsionis RSHP</a>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="{{ url('/dashboard_resepsionis') }}" class="nav-link active">Dashboard</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Registrasi
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ url('/resepsionis/pemilik/datapemilik') }}">Registrasi Pemilik</a></li>
            <li><a class="dropdown-item" href="{{ url('/resepsionis/pet/datapet') }}">Registrasi Pet</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ url('/resepsionis/temudokter/temudokter') }}" class="nav-link">Temu Dokter</a>
        </li>
        <li class="nav-item"><a href="{{ url('/logout') }}" class="nav-link">Logout</a></li>
      </ul>
    </div>
  </nav>

  <div class="container py-5 text-center">
    <h1 class="fw-bold">Halo, {{ $namaResepsionis }} 🐾</h1>
    <p class="intro-text mb-5">Atur registrasi pemilik & hewan, serta kelola antrian temu dokter dengan mudah.</p>

    <div class="row justify-content-center g-4">
      <div class="col-md-4 d-flex">
        <a href="{{ url('/resepsionis/pemilik/datapemilik') }}" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-person-vcard menu-icon"></i>
            <h5 class="card-title mt-3">Registrasi Pemilik</h5>
            <p class="text-muted small">Registrasi & kelola data pemilik hewan.</p>
          </div>
        </a>
      </div>

      <div class="col-md-4 d-flex">
        <a href="{{ url('/resepsionis/pet/datapet') }}" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-plus-circle menu-icon"></i>
            <h5 class="card-title mt-3">Registrasi Pet</h5>
            <p class="text-muted small">Registrasikan hewan baru ke sistem RSHP.</p>
          </div>
        </a>
      </div>

      <div class="col-md-4 d-flex">
        <a href="{{ url('/resepsionis/temudokter/temudokter') }}" class="w-100 text-decoration-none">
          <div class="menu-card p-4 w-100">
            <i class="bi bi-calendar-check menu-icon"></i>
            <h5 class="card-title mt-3">Temu Dokter</h5>
            <p class="text-muted small">Kelola jadwal dan antrian pasien hewan.</p>
            <span class="badge bg-warning text-dark">🐾 {{ $total_antrian }} antrian menunggu</span>
          </div>
        </a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

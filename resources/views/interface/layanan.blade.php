<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Layanan Umum - RSHP Universitas Airlangga</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      color: #142a46;
      margin: 0;
      padding: 0;
    }

    /* ===== NAVBAR (sama dengan home) ===== */
    nav {
      background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
    }
    nav ul {
      margin: 0;
      padding: 0;
      display: flex;
      list-style: none;
      justify-content: center;
    }
    nav ul li {
      padding: 15px 25px;
    }
    nav ul li a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }
    nav ul li a:hover {
      color: #ff9554;
    }

    .container {
      max-width: 1000px;
      margin: 60px auto;
      padding: 20px;
      text-align: center;
    }

    h1 {
      color: #102f76;
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 30px;
    }

    /* ===== CARD STYLE LAYANAN ===== */
    .layanan-card {
      display: flex;
      align-items: center;
      background: linear-gradient(to right, #f9a01b, #ff9541);
      padding: 20px;
      border-radius: 18px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      transition: transform 0.2s ease;
    }

    .layanan-card:hover {
      transform: translateY(-3px);
    }

    .layanan-icon {
      width: 45px;
      height: 45px;
      background-color: #102f76;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 18px;
      margin-right: 15px;
    }

    .layanan-text {
      color: white;
      font-weight: bold;
      font-size: 18px;
      text-align: left;
    }

    footer {
      background: linear-gradient(to right, #102f76, #142a46);
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 50px;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <!-- ===== NAVBAR ===== -->
  <nav>
    <ul>
      <li><a href="{{ url('/') }}">Home</a></li>
      <li><a href="{{ url('/#struktur') }}">Struktur Organisasi</a></li>
      <li><a href="{{ url('/layanan') }}">Layanan Umum</a></li>
      <li><a href="{{ url('/visimisi') }}">Visi, Misi & Tujuan</a></li>
      <li><a href="{{ url('/bedahhewan') }}">Bedah Hewan</a></li>
      <li><a href="{{ url('/login') }}">Login</a></li>
    </ul>
  </nav>

  <!-- ===== KONTEN LAYANAN ===== -->
  <div class="container">
    <h1>LAYANAN UMUM</h1>

    <div class="layanan-card">
      <div class="layanan-icon">1</div>
      <div class="layanan-text">Poliklinik Hewan Kecil</div>
    </div>

    <div class="layanan-card">
      <div class="layanan-icon">2</div>
      <div class="layanan-text">Rawat Inap</div>
    </div>

    <div class="layanan-card">
      <div class="layanan-icon">3</div>
      <div class="layanan-text">Laboratorium Diagnostik</div>
    </div>

    <div class="layanan-card">
      <div class="layanan-icon">4</div>
      <div class="layanan-text">
        <a href="{{ url('/bedahhewan') }}" style="color:white; text-decoration:none;">Bedah Hewan</a>
      </div>
    </div>

    <div class="layanan-card">
      <div class="layanan-icon">5</div>
      <div class="layanan-text">
        <a href="{{ url('/vaksinasi_sterilisasi') }}" style="color:white; text-decoration:none;">Vaksinasi & Sterilisasi</a>
      </div>
    </div>
  </div>

  <footer>
    <p>RSHP Universitas Airlangga &copy; 2025</p>
  </footer>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Struktur Organisasi - RSHP Universitas Airlangga</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      color: #142a46;
      margin: 0;
      padding: 0;
    }

    /* ===== NAVBAR (SAMA KAYAK HALAMAN LAIN) ===== */
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
    }

    h1 {
      color: #102f76;
      text-align: center;
      margin-bottom: 40px;
      font-size: 28px;
      font-weight: bold;
    }

    /* ===== TIMELINE STRUCTURE ===== */
    .timeline {
      position: relative;
      margin: 30px 0;
      padding-left: 40px;
    }
    .timeline::before {
      content: '';
      position: absolute;
      left: 15px;
      top: 0;
      bottom: 0;
      width: 3px;
      background-color: #4e7cff;
    }
    .timeline-item {
      position: relative;
      margin-bottom: 30px;
      display: flex;
      align-items: center;
      background: white;
      border-radius: 12px;
      padding: 15px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    .timeline-item::before {
      content: '';
      position: absolute;
      left: -27px;
      top: 50%;
      transform: translateY(-50%);
      width: 16px;
      height: 16px;
      background-color: white;
      border: 3px solid #4e7cff;
      border-radius: 50%;
      z-index: 1;
    }
    .timeline-content {
      flex: 1;
    }
    .timeline-content h3 {
      margin: 0;
      color: #102f76;
      font-size: 18px;
    }
    .timeline-content p {
      margin: 5px 0 0;
      color: #333;
      font-size: 14px;
      line-height: 1.5;
    }
    .timeline-photo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin-left: 20px;
      border: 3px solid #4e7cff;
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
      <li><a href="{{ url('/struktur') }}">Struktur Organisasi</a></li>
      <li><a href="{{ url('/layanan') }}">Layanan Umum</a></li>
      <li><a href="{{ url('/visimisi') }}">Visi, Misi & Tujuan</a></li>
      <li><a href="{{ url('/bedahhewan') }}">Bedah Hewan</a></li>
      <li><a href="{{ url('/login') }}">Login</a></li>
    </ul>
  </nav>

  <!-- ===== KONTEN STRUKTUR ORGANISASI ===== -->
  <div class="container">
    <h1>STRUKTUR ORGANISASI RSHP UNIVERSITAS AIRLANGGA</h1>

    <div class="timeline">
      <div class="timeline-item">
        <div class="timeline-content">
          <h3>Drh. Ocha Della, M.Kes – Direktur</h3>
          <p>Pemimpin visioner dengan latar belakang dokter hewan dan magister kesehatan. Berpengalaman memimpin tim lintas disiplin untuk mengembangkan layanan kesehatan hewan yang inovatif dan berstandar tinggi.</p>
        </div>
        <img src="{{ asset('gambar/ocha.jpg') }}" alt="Foto Ocha Della" class="timeline-photo">
      </div>

      <div class="timeline-item">
        <div class="timeline-content">
          <h3>Drh. Sovia Aribi – Kepala Layanan Medis</h3>
          <p>Spesialis medis veteriner yang dikenal tegas namun penuh empati. Mengawasi dan memastikan setiap prosedur medis berjalan sesuai protokol dan memberikan hasil terbaik bagi pasien hewan.</p>
        </div>
        <img src="{{ asset('gambar/sovia.jpg') }}" alt="Foto Sovia Aribi" class="timeline-photo">
      </div>

      <div class="timeline-item">
        <div class="timeline-content">
          <h3>Febrian Hadi, S.E. – Kepala Administrasi</h3>
          <p>Ahli manajemen dan tata kelola administrasi dengan fokus pada efisiensi dan ketelitian. Menjaga operasional harian tetap lancar melalui sistem kerja yang rapi dan terstruktur.</p>
        </div>
        <img src="{{ asset('gambar/brian.jpeg') }}" alt="Foto Febrian Hadi" class="timeline-photo">
      </div>
    </div>
  </div>

  <footer>
    <p>RSHP Universitas Airlangga &copy; 2025</p>
  </footer>

</body>
</html>

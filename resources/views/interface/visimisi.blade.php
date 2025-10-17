<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Visi, Misi, dan Tujuan - RSHP Universitas Airlangga</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      color: #142a46;
      margin: 0;
      padding: 0;
    }

    /* ====== NAVBAR (dari home) ====== */
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
      max-width: 1200px;
      margin: 50px auto;
      padding: 20px;
      text-align: center;
    }

    h1 {
      color: #102f76;
      font-size: 28px;
      margin-bottom: 30px;
      font-weight: bold;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }

    .card {
      border-radius: 16px;
      color: white;
      padding: 25px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      font-size: 16px;
      line-height: 1.6;
    }

    .card h2 {
      margin-top: 0;
      margin-bottom: 10px;
      font-size: 22px;
      color: #f9a01b, #142a46;
    }

    .visi, .tujuan {
      background: linear-gradient(to bottom right, #102f76, #142a46);
    }

    .misi {
      background: linear-gradient(to bottom right, #f9a01b, #ff9541);
      color: #142a46;
      text-align: left;
    }

    ul {
      margin: 0;
      padding-left: 20px;
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

  <!-- ====== NAVBAR (sama seperti di home) ====== -->
  <nav>
    <ul>
      <li><a href="{{ url('/') }}">Home</a></li>
      <li><a href="{{ url('/#struktur') }}">Struktur Organisasi</a></li>
      <li><a href="{{ url('/#layanan') }}">Layanan Umum</a></li>
      <li><a href="{{ url('/visimisi') }}">Visi, Misi & Tujuan</a></li>
      <li><a href="{{ url('/bedahhewan') }}">Bedah Hewan</a></li>
      <li><a href="{{ url('/login') }}">Login</a></li>
    </ul>
  </nav>

  <div class="container">
    <h1>VISI, MISI, DAN TUJUAN</h1>

    <div class="card-grid">
      <div class="card visi">
        <h2>Visi</h2>
        <p>Menjadi pusat layanan kesehatan dan pendidikan kedokteran hewan yang unggul serta berstandar internasional.</p>
      </div>

      <div class="card misi">
        <h2>Misi</h2>
        <ul>
          <li>Menyediakan layanan kesehatan hewan yang berkualitas.</li>
          <li>Mendukung pendidikan dan penelitian kedokteran hewan.</li>
          <li>Meningkatkan kesadaran masyarakat tentang kesehatan hewan.</li>
        </ul>
      </div>

      <div class="card tujuan">
        <h2>Tujuan</h2>
        <p>Meningkatkan kualitas kesehatan hewan demi kesejahteraan masyarakat.</p>
      </div>
    </div>
  </div>

  <footer>
    <p>RSHP Universitas Airlangga &copy; 2025</p>
  </footer>

</body>
</html>

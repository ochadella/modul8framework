<?php
// vaksinasi.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Vaksinasi Hewan - RSHP Universitas Airlangga</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f5f5f5;
      color: #142a46;
    }
    nav {
      background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
    }
    nav ul {
      margin: 0; padding: 0;
      display: flex; list-style: none;
      justify-content: center;
    }
    nav ul li { padding: 15px 25px; }
    nav ul li a {
      color: white; text-decoration: none; font-weight: bold;
    }
    nav ul li a:hover { color: #ff9554; }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }
    h1, h2, h3 { color: #102f76; }

    .hero {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 30px;
    }
    .hero img {
      width: 300px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .info-box {
      background: white;
      padding: 20px;
      border-left: 6px solid #f9a01b;
      border-radius: 12px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      margin: 20px 0;
    }
    .info-box h2 { margin-top: 0; }

    .vaccine-section {
      margin: 30px 0;
    }
    .vaccine-section h2 {
      margin-bottom: 10px;
    }
    .vaccine-card {
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      margin-bottom: 15px;
    }
    .vaccine-card h3 {
      margin-top: 0;
      color: #102f76;
    }

    .cta {
      text-align: center;
      margin: 40px 0;
    }
    .cta button {
      background: linear-gradient(to right, #f9a01b, #ff9554);
      border: none;
      color: white;
      padding: 15px 25px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }
    .cta button:hover {
      background: linear-gradient(to right, #ff9554, #f9a01b);
    }

    footer {
      background: linear-gradient(to right, #102f76, #142a46);
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 30px;
    }
  </style>
</head>
<body>

<nav>
  <ul>
    <li><a href="/">Beranda</a></li>
    <li><a href="/vaksinasi">Vaksinasi</a></li>
    <li><a href="/sterilisasi">Sterilisasi</a></li>
    <li><a href="/bedah">Bedah Hewan</a></li>
  </ul>
</nav>

<div class="container">
  <div class="hero">
    <img src="Vaksinasihewan.jpg" alt="Vaksinasi Hewan">
    <div>
      <h1>Layanan Vaksinasi Hewan</h1>
      <p>Menjaga kesehatan hewan peliharaan tidak hanya sebatas memberi makan atau mengajak bermain. Salah satu cara paling penting adalah dengan vaksinasi rutin.</p>
    </div>
  </div>

  <div class="info-box">
    <h2>Kenapa Vaksinasi Penting?</h2>
    <p>Vaksinasi membantu mencegah penyakit menular yang berbahaya, melindungi hewan dari sakit parah bahkan kematian, serta menjaga kesehatan keluarga dan lingkungan.</p>
  </div>

  <div class="vaccine-section">
    <h2>🧪 Vaksin Inti (Core)</h2>

    <div class="vaccine-card">
      <h3>Vaksin Rabies</h3>
      <p><b>Siapa yang perlu?</b> Anjing & kucing.</p>
      <p><b>Kapan diberikan?</b> Mulai usia 12 minggu, lalu booster tahunan.</p>
      <p><b>Manfaat:</b> Melindungi hewan & manusia dari penyakit zoonosis yang mematikan.</p>
    </div>

    <div class="vaccine-card">
      <h3>Vaksin DHPP / DHP (untuk anjing)</h3>
      <p><b>Siapa yang perlu?</b> Semua anak anjing & anjing dewasa yang belum divaksin.</p>
      <p><b>Kapan diberikan?</b> Usia 6–8 minggu, booster tiap 3–4 minggu sampai 16 minggu, lalu tiap 1–3 tahun.</p>
      <p><b>Manfaat:</b> Melindungi dari Distemper, Hepatitis, Parvo, Parainfluenza.</p>
    </div>

    <div class="vaccine-card">
      <h3>Vaksin FVRCP (untuk kucing)</h3>
      <p><b>Siapa yang perlu?</b> Semua kucing (indoor maupun outdoor).</p>
      <p><b>Kapan diberikan?</b> Usia 6–8 minggu dengan booster rutin.</p>
      <p><b>Manfaat:</b> Melindungi dari Feline Viral Rhinotracheitis, Calicivirus, Panleukopenia.</p>
    </div>
  </div>

  <div class="vaccine-section">
    <h2>🌍 Vaksin Non-Inti / Tambahan</h2>

    <div class="vaccine-card">
      <h3>Leptospirosis</h3>
      <p>Untuk anjing di daerah rawan banjir atau sering kontak air kotor. Bisa menular ke manusia.</p>
    </div>

    <div class="vaccine-card">
      <h3>Bordetella (Kennel Cough)</h3>
      <p>Cocok untuk anjing yang sering di pet hotel, grooming, atau dog park.</p>
    </div>

    <div class="vaccine-card">
      <h3>Lyme Disease</h3>
      <p>Disarankan untuk anjing di daerah endemik kutu. Mencegah demam, nyeri sendi, kerusakan organ.</p>
    </div>

    <div class="vaccine-card">
      <h3>Canine Influenza</h3>
      <p>Untuk anjing yang sering berkumpul di tempat ramai. Mencegah batuk, pilek, dan demam.</p>
    </div>

    <div class="vaccine-card">
      <h3>Vaksin untuk Ternak</h3>
      <p>Contoh: Foot-and-Mouth Disease (FMD), Brucellosis, Anthrax, Clostridial vaccines.</p>
    </div>
  </div>

  <div class="cta">
    <button onclick="window.location.href='https://wa.me/628123456789'">Buat Janji Vaksinasi</button>
  </div>
</div>

<footer>
  <p>RSHP Universitas Airlangga &copy; 2025</p>
</footer>

</body>
</html>

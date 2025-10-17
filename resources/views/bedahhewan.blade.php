<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Bedah Hewan - RSHP Universitas Airlangga</title>
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
    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }
    .card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      text-align: center;
      text-decoration: none;
      color: inherit;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 10px rgba(0,0,0,0.15);
    }
    .card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .procedure-box {
      background: white;
      padding: 20px;
      border-left: 6px solid #f9a01b;
      border-radius: 12px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      margin: 20px 0;
    }
    .steps {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin: 20px 0;
    }
    .step {
      background: linear-gradient(to right, #f9a01b, #ff9554);
      color: white;
      padding: 15px;
      border-radius: 10px;
      font-weight: bold;
    }
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 15px;
      margin-top: 20px;
    }
    .gallery img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }
    .faq {
      margin-top: 30px;
    }
    .faq-item {
      background: white;
      border-radius: 10px;
      margin-bottom: 10px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .faq-question {
      background: linear-gradient(to right, #153b7a, #ff9554);
      color: white;
      padding: 15px;
      cursor: pointer;
      font-weight: bold;
    }
    .faq-answer {
      display: none;
      padding: 15px;
      color: #142a46;
      background: #f5f5f5;
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
    <li><a href="/bedahhewan">Bedah Hewan</a></li>
  </ul>
</nav>

<div class="container">
  <div class="hero">
    <img src="{{ asset('gambar/Bedahhewan.jpg') }}" alt="Bedah Hewan">
    <div>
      <h1>Layanan Bedah Hewan</h1>
      <p>Kami menyediakan layanan bedah untuk hewan peliharaan Anda dengan standar medis terbaik, mulai dari tindakan ringan hingga operasi besar.</p>
    </div>
  </div>

  <h2>Jenis Bedah yang Tersedia</h2>
  <div class="card-grid">
    <a href="{{ url('/bedah-sterilisasi') }}" class="card">
      <img src="{{ asset('gambar/Bedahsteril.jpg') }}" alt="Bedah Sterilisasi">
      <h3>Bedah Sterilisasi</h3>
      <p>Spay/castrasi untuk mencegah reproduksi.</p>
    </a>
    <a href="{{ url('/bedah-minor') }}" class="card">
      <img src="{{ asset('gambar/Bedahminor.jpg') }}" alt="Bedah Minor">
      <h3>Bedah Minor</h3>
      <p>Luka, abses, atau pengangkatan tumor kecil.</p>
    </a>
    <a href="{{ url('/bedah-mayor') }}" class="card">
      <img src="{{ asset('gambar/Bedahmayor.jpg') }}" alt="Bedah Mayor">
      <h3>Bedah Mayor</h3>
      <p>Operasi tulang, fraktur, tumor besar, perut.</p>
    </a>
    <a href="{{ url('/bedah-darurat') }}" class="card">
      <img src="{{ asset('gambar/Bedahdarurat.jpg') }}" alt="Bedah Darurat">
      <h3>Bedah Darurat</h3>
      <p>Torsio lambung, kecelakaan, pendarahan.</p>
    </a>
    <a href="{{ url('/bedah-gigimulut') }}" class="card">
      <img src="{{ asset('gambar/Bedahgigimulut.jpg') }}" alt="Bedah Gigi & Mulut">
      <h3>Bedah Gigi & Mulut</h3>
      <p>Scaling, pencabutan gigi.</p>
    </a>
  </div>

  <div class="procedure-box">
    <h2>Prosedur Bedah Singkat</h2>
    <p>Bedah dilakukan dengan anestesi umum atau lokal, tergantung jenis tindakan. Lama operasi bervariasi, dari 30 menit hingga beberapa jam. Ada risiko seperti perdarahan atau infeksi, namun manfaatnya jauh lebih besar untuk kesehatan hewan.</p>
  </div>

  <h2>Pra-Bedah</h2>
  <div class="steps">
    <div class="step">Puasa 8–12 jam sebelum operasi.</div>
    <div class="step">Pemeriksaan darah, jantung, kesehatan umum.</div>
    <div class="step">Konsultasi risiko anestesi.</div>
  </div>

  <h2>Pasca-Bedah</h2>
  <div class="steps">
    <div class="step">Instruksi pulang: obat, perawatan luka, kontrol jahitan.</div>
    <div class="step">Pemulihan 7–14 hari tergantung operasi.</div>
    <div class="step">Kontak darurat jika ada komplikasi.</div>
  </div>

  <h2>Galeri</h2>
  <div class="gallery">
    <img src="{{ asset('gambar/Ruangoperasi.jpg') }}" alt="Ruang Operasi">
    <img src="{{ asset('gambar/Peralatansteril.jpg') }}" alt="Peralatan Steril">
    <img src="{{ asset('gambar/Timdokterhewan.jpg') }}" alt="Tim Dokter Hewan">
  </div>

  <div class="faq">
    <h2>FAQ Bedah Hewan</h2>
    <div class="faq-item">
      <div class="faq-question">Apakah hewan saya aman saat anestesi?</div>
      <div class="faq-answer">Risiko selalu ada, namun pemeriksaan pra-bedah membantu meminimalkan bahaya. Kami menggunakan standar anestesi modern.</div>
    </div>
    <div class="faq-item">
      <div class="faq-question">Berapa lama pemulihan pasca operasi?</div>
      <div class="faq-answer">Umumnya 7–14 hari, tergantung jenis dan ukuran operasi.</div>
    </div>
    <div class="faq-item">
      <div class="faq-question">Apa yang harus saya lakukan jika luka bengkak?</div>
      <div class="faq-answer">Segera hubungi klinik, jangan menunda. Bengkak bisa tanda infeksi atau masalah jahitan.</div>
    </div>
  </div>

  <div class="cta">
    <button onclick="window.location.href='https://wa.me/628123456789'">Buat Janji Bedah</button>
  </div>
</div>

<footer>
  <p>RSHP Universitas Airlangga &copy; 2025</p>
</footer>

<script>
  const questions = document.querySelectorAll('.faq-question');
  questions.forEach(q => {
    q.addEventListener('click', () => {
      const ans = q.nextElementSibling;
      ans.style.display = ans.style.display === 'block' ? 'none' : 'block';
    });
  });
</script>

</body>
</html>

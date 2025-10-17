<?php
// sterilisasi.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sterilisasi Hewan - RSHP Universitas Airlangga</title>
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
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .hero img {
      width: 300px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .section {
      margin: 40px 0;
    }
    .section h2 {
      margin-bottom: 20px;
      padding: 12px;
      border-radius: 10px;
      color: white;
    }
    .section.operatif h2 {
      background: linear-gradient(to right, #102f76, #142a46);
    }
    .section.non-operatif h2 {
      background: linear-gradient(to right, #f9a01b, #ff9554);
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      margin-bottom: 15px;
    }
    .card h3 {
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
    <li><a href="/layananumum">Beranda</a></li>
    <li><a href="/vaksinasi">Vaksinasi</a></li>
    <li><a href="/sterilisasi">Sterilisasi</a></li>
    <li><a href="/macambedahhewan">Bedah Hewan</a></li>
  </ul>
</nav>

<div class="container">
  <!-- HERO UTAMA -->
  <div class="hero">
    <img src="steril.jpg" alt="Sterilisasi Hewan">
    <div>
      <h2>Kenapa Sterilisasi Itu Penting?</h2>
      <p>
        Sterilisasi adalah salah satu langkah penting dalam menjaga kesehatan dan kesejahteraan hewan peliharaan. 
        Prosedur ini bukan hanya mencegah kehamilan yang tidak diinginkan, tetapi juga memiliki manfaat kesehatan dan perilaku. 
        Dengan sterilisasi, pemilik dapat mengendalikan populasi hewan liar sekaligus memberi kualitas hidup lebih baik bagi hewan peliharaan mereka.
      </p>
      <p>
        Sterilisasi terbagi menjadi dua kelompok besar, yaitu <b>sterilisasi operatif</b> (bedah) yang paling umum dilakukan, 
        serta <b>sterilisasi non-operatif</b> (alternatif) yang masih jarang dipakai dan biasanya dalam lingkup penelitian atau kasus tertentu.
      </p>
    </div>
  </div>

  <!-- STERILISASI OPERATIF -->
  <div class="section operatif">
    <h2>🔪 Sterilisasi Operatif</h2>

    <div class="card">
      <h3>Ovariohysterectomy (Spay) — Sterilisasi Betina</h3>
      <p><b>Tujuan:</b> Mengangkat ovarium & rahim untuk mencegah kehamilan pada betina.</p>
      <p><b>Manfaat:</b> Menurunkan risiko infeksi rahim (piometra), mengurangi kemungkinan tumor kelenjar susu, serta menenangkan perilaku.</p>
      <p><b>Usia Ideal:</b> 4–6 bulan sebelum birahi pertama, tergantung kondisi hewan.</p>
    </div>

    <div class="card">
      <h3>Orchiectomy (Castration) — Sterilisasi Jantan</h3>
      <p><b>Tujuan:</b> Mengangkat testis untuk mencegah reproduksi.</p>
      <p><b>Manfaat:</b> Mengurangi agresi, kebiasaan menandai urin, risiko kanker testis & penyakit prostat.</p>
      <p><b>Usia Ideal:</b> 4–6 bulan, bisa juga pada hewan dewasa setelah evaluasi dokter.</p>
    </div>

    <div class="card">
      <h3>Sterilisasi Minimally Invasive (Laparoskopi)</h3>
      <p><b>Metode modern</b> dengan sayatan kecil, rasa sakit minimal, pemulihan lebih cepat. 
      Belum tersedia di semua klinik karena butuh peralatan khusus.</p>
    </div>
  </div>

  <!-- STERILISASI NON-OPERATIF -->
  <div class="section non-operatif">
    <h2>🌱 Sterilisasi Non-Operatif / Alternatif</h2>

    <div class="card">
      <h3>Vasectomy / Tubectomy</h3>
      <p>Memotong saluran reproduksi tanpa mengangkat organ. Hewan tetap punya hormon, tapi tidak bisa membuahi. 
      Jarang dipilih karena tidak memberi manfaat kesehatan tambahan seperti sterilisasi penuh.</p>
    </div>

    <div class="card">
      <h3>Kontrasepsi Kimiawi (Hormon / Implan)</h3>
      <p>Kontrol reproduksi sementara dengan hormon atau implan. Praktis, tapi bisa ada efek samping dan risiko kesehatan jangka panjang.</p>
    </div>

    <div class="card">
      <h3>Immunocontraception (Vaksin Kontrasepsi)</h3>
      <p>Metode penelitian baru berupa vaksin untuk mencegah pembuahan. Menjanjikan untuk pengendalian populasi hewan liar, 
      tapi belum tersedia luas di klinik hewan umum.</p>
    </div>
  </div>

  <div class="cta">
    <button onclick="window.location.href='https://wa.me/628123456789'">Buat Janji Sterilisasi</button>
  </div>
</div>

<footer>
  <p>RSHP Universitas Airlangga &copy; 2025</p>
</footer>

</body>
</html>

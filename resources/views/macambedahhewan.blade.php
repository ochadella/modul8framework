<?php
// macambedahhewan.php
include 'vaksinasi.php';
include 'sterilisasi.php';
include 'macambedahhewan.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Macam Bedah Hewan - RSHP Universitas Airlangga</title>
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
    .section.minor h2 { background: linear-gradient(to right, #102f76, #142a46); }
    .section.major h2 { background: linear-gradient(to right, #f9a01b, #ff9554); }
    .section.gigi h2 { background: linear-gradient(to right, #3cba54, #009688); }
    .section.ortopedi h2 { background: linear-gradient(to right, #8e44ad, #5e3370); }
    .section.darurat h2 { background: linear-gradient(to right, #e53935, #b71c1c); }
    .section.manfaat h2 { background: linear-gradient(to right, #0288d1, #0277bd); }
    .section.persiapan h2 { background: linear-gradient(to right, #ff9800, #f57c00); }

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
    <li><a href="../index.php">Beranda</a></li>
    <li><a href="../vaksinasi.php">Vaksinasi</a></li>
    <li><a href="../sterilisasi/sterilisasi.php">Sterilisasi</a></li>
    <li><a href="macambedahhewan.php">Macam Bedah Hewan</a></li>
  </ul>
</nav>

<div class="container">
  <!-- HERO -->
  <div class="hero">
    <img src="bedah.jpg" alt="Macam Bedah Hewan">
    <div>
      <h2>Bedah Hewan</h2>
      <p>
        Bedah hewan merupakan salah satu layanan penting dalam dunia kedokteran hewan yang dilakukan untuk menyelamatkan nyawa, 
        meningkatkan kualitas hidup, serta memperbaiki fungsi tubuh hewan peliharaan maupun hewan ternak. 
        Prosedur bedah tidak hanya terbatas pada kondisi darurat, tetapi juga mencakup prosedur elektif seperti pengangkatan tumor atau koreksi kelainan bawaan.
      </p>
      <p>
        Dengan berkembangnya teknologi kedokteran hewan, prosedur bedah kini semakin aman berkat penggunaan anestesi modern, 
        peralatan steril, serta teknik minimal invasif yang mempercepat pemulihan pasien.
      </p>
    </div>
  </div>

  <!-- JENIS-JENIS BEDAH -->
  <div class="section minor">
    <h2>🔪 Bedah Minor</h2>
    <div class="card">
      <p><b>Definisi:</b> Operasi sederhana dengan risiko rendah, biasanya melibatkan sayatan kecil.</p>
      <p><b>Contoh:</b> Pembersihan & penjahitan luka, pengangkatan abses/kista kecil, operasi kulit superfisial.</p>
      <p><b>Pemulihan:</b> Relatif cepat (3–7 hari) dengan perawatan luka dasar.</p>
    </div>
  </div>

  <div class="section major">
    <h2>🔪 Bedah Mayor</h2>
    <div class="card">
      <p><b>Definisi:</b> Operasi kompleks yang melibatkan organ dalam atau struktur vital.</p>
      <p><b>Contoh:</b> Operasi usus/lambung, tulang & sendi (fraktur, dislokasi), pengangkatan tumor besar, operasi hernia.</p>
      <p><b>Pemulihan:</b> Lebih lama (2–6 minggu) dengan anestesi umum & monitoring intensif.</p>
    </div>
  </div>

  <div class="section gigi">
    <h2>🦷 Bedah Gigi & Mulut</h2>
    <div class="card">
      <p><b>Tujuan:</b> Menjaga kesehatan rongga mulut hewan.</p>
      <p><b>Contoh:</b> Scaling gigi, pencabutan gigi rusak/patah, operasi rahang/tumor mulut.</p>
      <p><b>Penting:</b> Infeksi gigi bisa menyebar ke organ lain (jantung, ginjal).</p>
    </div>
  </div>

  <div class="section ortopedi">
    <h2>🦴 Bedah Ortopedi</h2>
    <div class="card">
      <p><b>Fokus:</b> Menangani tulang, otot, & sendi.</p>
      <p><b>Contoh:</b> Operasi fraktur dengan pen, displasia panggul, operasi ligamen (ACL/CCL pada anjing).</p>
      <p><b>Catatan:</b> Membutuhkan keahlian khusus & rehabilitasi pasca operasi.</p>
    </div>
  </div>

  <div class="section darurat">
    <h2>🚨 Bedah Darurat</h2>
    <div class="card">
      <p><b>Tujuan:</b> Menyelamatkan nyawa akibat kondisi akut.</p>
      <p><b>Contoh:</b> Torsio lambung, trauma berat, pendarahan internal, caesar darurat.</p>
      <p><b>Catatan:</b> Harus segera dilakukan dengan fasilitas lengkap.</p>
    </div>
  </div>

  <!-- MANFAAT -->
  <div class="section manfaat">
    <h2>🌟 Manfaat Bedah Hewan</h2>
    <div class="card">
      <ul>
        <li>Menyelamatkan nyawa hewan dalam kondisi darurat.</li>
        <li>Mengurangi rasa sakit akibat luka, tumor, atau penyakit organ.</li>
        <li>Memperbaiki fungsi tubuh seperti berjalan, makan, bernapas.</li>
        <li>Meningkatkan kualitas hidup hewan & kenyamanan pemilik.</li>
      </ul>
    </div>
  </div>

  <!-- PERSIAPAN & PERAWATAN -->
  <div class="section persiapan">
    <h2>📋 Persiapan & Perawatan Pasca Bedah</h2>
    <div class="card">
      <p><b>Sebelum operasi:</b> Pemeriksaan fisik, tes darah, puasa 8–12 jam, evaluasi risiko anestesi.</p>
      <p><b>Setelah operasi:</b> Istirahat 7–14 hari, obat antibiotik & pereda nyeri, jaga luka tetap bersih & kering, gunakan kerah pelindung, kontrol rutin.</p>
    </div>
  </div>

  <!-- KESIMPULAN -->
  <div class="section">
    <h2>💡 Kesimpulan</h2>
    <div class="card">
      <p>
        Bedah hewan bukan sekadar tindakan medis, melainkan langkah penting untuk menjaga kesehatan, kenyamanan, & kesejahteraan hewan. 
        Dengan teknologi modern, tingkat keberhasilan operasi semakin tinggi dan hewan bisa kembali aktif seperti sedia kala.
      </p>
    </div>
  </div>

  <div class="cta">
    <button onclick="window.location.href='https://wa.me/628123456789'">Konsultasi Bedah Hewan</button>
  </div>
</div>

<footer>
  <p>RSHP Universitas Airlangga &copy; 2025</p>
</footer>

</body>
</html>

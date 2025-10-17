<?php
// vaksinasi_sterilisasi.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Vaksinasi & Sterilisasi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
      color: #142a46;
    }
    header {
      background: linear-gradient(to right, #0a2a66, #f97316);
      padding: 15px;
      text-align: center;
    }
    header a {
      color: white;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
    }
    header a:hover {
      text-decoration: underline;
    }
    .container {
      max-width: 1000px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h1 {
      text-align: center;
      color: #0a2a66;
    }
    .section {
      display: flex;
      align-items: center;
      margin: 20px 0;
      background: linear-gradient(to right, #0a2a66, #153b7a);
      color: white;
      border-radius: 12px;
      overflow: hidden;
    }
    .section img {
      width: 200px;
      height: 150px;
      object-fit: cover;
    }
    .section-content {
      padding: 20px;
      flex: 1;
    }
    .btn {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 15px;
      background: #f97316;
      color: white;
      border-radius: 8px;
      text-decoration: none;
    }
    .btn:hover {
      background: #ff9554;
    }
    footer {
      background: linear-gradient(to right, #0a2a66, #f97316);
      text-align: center;
      padding: 10px;
      color: white;
      margin-top: 30px;
    }
    .detail {
      display: none;
      margin-top: 20px;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background: #fafafa;
    }
    .detail h2 {
      color: #0a2a66;
    }
    .detail ul {
      margin: 0;
      padding-left: 20px;
    }

    /* FAQ STYLE */
    .faq-section {
      margin-top: 40px;
    }
    .faq-section h2 {
      text-align: center;
      color: #0a2a66;
      margin-bottom: 20px;
    }
    .faq {
      margin-bottom: 10px;
      border-radius: 8px;
      overflow: hidden;
      border: 1px solid #ddd;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .faq-question {
      padding: 15px;
      background: linear-gradient(to right, #153b7a, #ff9554);
      color: white;
      cursor: pointer;
      font-weight: bold;
    }
    .faq-answer {
      display: none;
      padding: 15px;
      background: #fafafa;
      color: #333;
      line-height: 1.6;
    }
  </style>
</head>
<body>
  <header>
    <a href="index.php">Beranda</a>
    <a href="vaksinasi_sterilisasi.php">Vaksinasi & Sterilisasi</a>
  </header>

  <div class="container">
    <h1>Vaksinasi & Sterilisasi</h1>

    <!-- Vaksinasi -->
    <div class="section">
      <img src="vaksin.jpg" alt="Vaksinasi">
      <div class="section-content">
        <h2>Vaksinasi</h2>
        <p>Vaksinasi adalah upaya pencegahan penyakit dengan memberikan vaksin untuk merangsang kekebalan tubuh hewan.</p>
        <a href="#detail-vaksin" class="btn" onclick="toggleDetail('detail-vaksin')">Pelajari Lebih Lanjut</a>
      </div>
    </div>

    <div id="detail-vaksin" class="detail">
      <h2>Jenis Vaksinasi</h2>
      <ul>
        <li><b>Rabies</b>: Proteksi terhadap rabies, wajib pada anjing & kucing.</li>
        <li><b>DHPP (anjing)</b>: Distemper, Hepatitis, Parvovirus, Parainfluenza.</li>
        <li><b>FVRCP (kucing)</b>: Rhinotracheitis, Calicivirus, Panleukopenia.</li>
        <li><b>Non-core</b>: Leptospirosis, Bordetella, Lyme, Canine Influenza.</li>
      </ul>
      <h3>Perawatan</h3>
      <ul>
        <li>Amati 15–30 menit setelah vaksin.</li>
        <li>Reaksi ringan normal: demam, letih, nyeri suntikan.</li>
        <li>Hubungi dokter jika muncul muntah, sesak, bengkak besar.</li>
      </ul>
    </div>

    <!-- Sterilisasi -->
    <div class="section">
      <img src="steril.jpg" alt="Sterilisasi">
      <div class="section-content">
        <h2>Sterilisasi</h2>
        <p>Sterilisasi adalah prosedur medis untuk mencegah reproduksi hewan, menjaga kesehatan, dan mengendalikan populasi.</p>
        <a href="#detail-steril" class="btn" onclick="toggleDetail('detail-steril')">Pelajari Lebih Lanjut</a>
      </div>
    </div>

    <div id="detail-steril" class="detail">
      <h2>Jenis Sterilisasi</h2>
      <ul>
        <li><b>Spay (betina)</b>: Angkat ovarium & rahim.</li>
        <li><b>Castration (jantan)</b>: Angkat testis, kurangi agresi & reproduksi.</li>
        <li><b>Laparoskopi</b>: Minim sayatan, pemulihan cepat.</li>
        <li><b>Alternatif</b>: Vasectomy, kontrasepsi kimia, imunokontrasepsi.</li>
      </ul>
      <h3>Perawatan</h3>
      <ul>
        <li>Puasa 8–12 jam sebelum operasi.</li>
        <li>Istirahat 7–14 hari pasca operasi.</li>
        <li>Jaga jahitan tetap kering dan bersih.</li>
      </ul>
    </div>

    <!-- FAQ Section -->
    <div class="faq-section">
      <h2>FAQ (Pertanyaan Umum)</h2>

      <div class="faq">
        <div class="faq-question" onclick="toggleFAQ(this)">Q: Kapan anak anjing/kucing boleh divaksin pertama?</div>
        <div class="faq-answer">A: Umumnya mulai 6–8 minggu untuk vaksin kombinasi; skema lengkap hingga sekitar 16 minggu. Untuk rabies ikuti aturan daerah setempat.</div>
      </div>

      <div class="faq">
        <div class="faq-question" onclick="toggleFAQ(this)">Q: Berapa lama pemulihan setelah steril?</div>
        <div class="faq-answer">A: Biasanya 7–14 hari sampai kembali normal, tergantung ukuran dan jenis hewan serta jenis operasi.</div>
      </div>

      <div class="faq">
        <div class="faq-question" onclick="toggleFAQ(this)">Q: Apakah steril membuat hewan menjadi gemuk?</div>
        <div class="faq-answer">A: Sterilisasi dapat mengubah metabolisme; kontrol pakan dan olahraga mencegah kenaikan berat badan.</div>
      </div>

      <div class="faq">
        <div class="faq-question" onclick="toggleFAQ(this)">Q: Apakah semua hewan harus divaksin?</div>
        <div class="faq-answer">A: Vaksin inti direkomendasikan untuk semua hewan peliharaan sesuai spesies; vaksin tambahan berdasarkan risiko.</div>
      </div>
    </div>

  </div>

  <footer>
    © 2025 RSHP Universitas Airlangga
  </footer>

  <script>
    function toggleDetail(id) {
      var detail = document.getElementById(id);
      detail.style.display = (detail.style.display === "block") ? "none" : "block";
    }

    function toggleFAQ(el) {
      var answer = el.nextElementSibling;
      if (answer.style.display === "block") {
        answer.style.display = "none";
      } else {
        answer.style.display = "block";
      }
    }
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struktur Organisasi RSHP</title>
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
            padding: 20px;
            max-width: 900px;
            margin: auto;
        }
        h1 {
            color: #102f76;
            text-align: center;
        }

        /* Timeline */
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
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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
        }
        .timeline-content p {
            margin: 5px 0 0;
            color: #333;
            font-size: 14px;
        }
        .timeline-photo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 15px;
            border: 2px solid #4e7cff;
        }

        footer {
            background: linear-gradient(to right, #102f76, #142a46);
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<nav>
    <ul>
        <li><a href="home .html">Home</a></li>
        <li><a href="struktur organisasi.html">Struktur Organisasi</a></li>
        <li><a href="layanan.html">Layanan Umum</a></li>
        <li><a href="visi.html">Visi, Misi & Tujuan</a></li>
    </ul>
</nav>

<div class="container">
    <h1>STRUKTUR ORGANISASI</h1>

    <div class="timeline">
        <div class="timeline-item">
            <div class="timeline-content">
                <h3>Drh. Ocha Della, M.Kes – Direktur</h3>
                <p>Pemimpin visioner dengan latar belakang dokter hewan dan magister kesehatan. Berpengalaman memimpin tim lintas disiplin untuk mengembangkan layanan kesehatan hewan yang inovatif dan berstandar tinggi.</p>
            </div>
            <img src="gambar/ocha.jpg" alt="Foto Ocha Della" class="timeline-photo">
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <h3>Drh. Sovia Aribi – Kepala Layanan Medis</h3>
                <p>Spesialis medis veteriner yang dikenal tegas namun penuh empati. Mengawasi dan memastikan setiap prosedur medis berjalan sesuai protokol dan memberikan hasil terbaik bagi pasien hewan.</p>
            </div>
            <img src="gambar/sovia.jpg" alt="Foto Sovia Aribi" class="timeline-photo">
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <h3>Febrian Hadi, S.E. – Kepala Administrasi</h3>
                <p>Ahli manajemen dan tata kelola administrasi dengan fokus pada efisiensi dan ketelitian. Menjaga operasional harian tetap lancar melalui sistem kerja yang rapi dan terstruktur.</p>
            </div>
            <img src="gambar/brian.jpeg" alt="Foto Febrian Hadi" class="timeline-photo">
        </div>
    </div>
</div>

<footer>
    &copy; 2025 RSHP Universitas Airlangga. Semua Hak Dilindungi.
</footer>

</body>
</html>

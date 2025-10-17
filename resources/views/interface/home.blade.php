<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>RSHP Universitas Airlangga</title>
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
            display: flex;
            flex-direction: column; 
            padding: 20px;
            gap: 20px;
            max-width: 1300px;
            margin: auto;
        }
        .main {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
        }
        .sidebar {
            background: linear-gradient(to bottom, #ff9554 0%, #f9a01b 25%, #102f76 100%);
            padding: 20px;
            border-radius: 8px;
            color: white;
        }
        h1, h2, h3, h4 {
            color: #102f76;
        }
        mark {
            background-color: white;
            color: #142a46;
            padding: 2px 4px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #142a46;
        }
        th {
            background-color: #f9a01b;
            color: #142a46;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        footer {
            background: linear-gradient(to right, #102f76, #142a46);
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 30px;
        }
        img {
            border-radius: 8px;
            margin-bottom: 15px;
        }

        /* STYLE LAYANAN UMUM */
        .layanan-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .layanan-card {
            display: flex;
            align-items: center;
            background: linear-gradient(to right, #f9a01b, #ff9554);
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }
        .layanan-icon {
            width: 40px;
            height: 40px;
            background-color: #142a46;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            font-size: 18px;
        }
        .layanan-text {
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        /* STYLE VISI MISI TUJUAN */
        .vmt-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .vmt-card {
            flex: 1 1 300px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            color: white;
        }
        .vmt-card h3 {
            margin-top: 0;
            font-size: 20px;
        }
        .visi {
            background: linear-gradient(to right, #142a46, #102f76);
        }
        .misi {
            background: linear-gradient(to right, #f9a01b, #ff9554);
            color: #142a46;
        }
        .tujuan {
            background: linear-gradient(to right, #102f76, #142a46);
        }
        .orange{
            color: #f9a01b;
        }
        
        /* TIMELINE */
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
    </style>
</head>
<body>

<nav>
    <ul>
        <li><a href="{{ url('/') }}">Home</a></li>

        <!-- 🔗 Sekarang ini diarahkan ke halaman struktur -->
        <li><a href="{{ url('/struktur') }}">Struktur Organisasi</a></li>

        <!-- 🔗 Halaman layanan -->
        <li><a href="{{ url('/layanan') }}">Layanan Umum</a></li>

        <!-- 🔗 Halaman visi misi -->
        <li><a href="{{ url('/visimisi') }}">Visi, Misi & Tujuan</a></li>

        <li><a href="{{ url('/bedahhewan') }}">Bedah Hewan</a></li>
        <li><a href="{{ url('/login') }}">Login</a></li>
    </ul>
</nav>

<div class="container">
    <div class="main">
        <h1 style="text-align: center;">Rumah Sakit Hewan Pendidikan (RSHP)</h1>

        <img src="{{ asset('gambar/unair.jpg') }}" alt="RSHP Universitas Airlangga" width="100%">

        <p><b>RSHP Universitas Airlangga</b> adalah Rumah Sakit Hewan Pendidikan yang berperan sebagai pusat layanan kesehatan hewan <i>modern</i>,
        dengan fasilitas lengkap dan tenaga ahli profesional. Dengan dukungan tenaga dokter hewan professional, mahasiswa, serta peralatan medis modern, RSHP memberikan layanan mulai pemeriksaan umum, vaksinasi, tindakan bedah, dan perawatan intensif hingga penunjang diagnostik seperti laboratorium dan radiologi. Untuk mengetahui lebih dalam tentang RSHP Universitas Airlangga, kunjungi 
        <a href="https://rshp.unair.ac.id" target="_blank">website resmi RSHP</a>.</p>
        <p><strong>Alamat</strong> : <ins>Kampus C Universitas Airlangga, Surabaya</ins></p>
        <p><mark>Penting:</mark> RSHP menerima pasien hewan setiap hari kerja.</p>
    </div>

    <div class="sidebar">
        <h3>Info Singkat</h3>
        <p>RSHP merupakan bagian dari Fakultas Kedokteran Hewan Universitas Airlangga.</p>
        <h4>Kontak</h4>
        <p>Telp: <b>(031) 599-3016</b></p>
        <p>Email: rshp@unair.ac.id</p>
        <h4>Jam Layanan</h4>
        <ul>
            <li>Senin - Jumat: 08.00 - 16.00</li>
            <li>Sabtu: 08.00 - 12.00</li>
        </ul>
    </div>
</div>

<footer>
    &copy; 2025 RSHP Universitas Airlangga. Semua Hak Dilindungi.
</footer>

</body>
</html>

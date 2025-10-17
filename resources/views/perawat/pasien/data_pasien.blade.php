<?php
session_start();
require_once __DIR__ . '/../../../config/koneksiDB.php';

// Cek login dan role
if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'perawat') {
    header('Location: ../../interface/login.php');
    exit;
}

$db = new DBConnection();
$conn = $db->getConnection();

// Aktifkan laporan error MySQLi untuk debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // ✅ Ambil data pasien dari tabel temu_dokter (inputan resepsionis)
    $query = "
        SELECT 
            td.idreservasi_dokter AS idreservasi,
            p.nama AS nama_hewan,
            rh.nama_ras AS jenis,
            TIMESTAMPDIFF(YEAR, p.tanggal_lahir, CURDATE()) AS umur,
            pm.nama AS nama_pemilik,
            DATE(td.waktu_daftar) AS tanggal_kunjungan,
            CASE 
                WHEN td.status = 'A' THEN 'Menunggu'
                WHEN td.status = 'S' THEN 'Selesai'
                WHEN td.status = 'B' THEN 'Batal'
                ELSE 'Tidak Diketahui'
            END AS status
        FROM temu_dokter td
        JOIN pet p ON td.idpet = p.idpet
        LEFT JOIN ras_hewan rh ON p.idras_hewan = rh.idras_hewan
        JOIN pemilik pm ON p.idpemilik = pm.idpemilik
        ORDER BY td.waktu_daftar DESC
    ";

    $result = $conn->query($query);
} catch (mysqli_sql_exception $e) {
    die('Error SQL: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Pasien Hewan | RSHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
      margin: 0;
      padding: 0;
      color: #142a46;
    }

    .navbar {
      background-color: #fff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar span {
      font-weight: bold;
      color: #102f76;
      font-size: 18px;
    }

    .navbar a {
      text-decoration: none;
      color: #102f76;
      font-weight: 600;
      margin-left: 20px;
      transition: 0.3s;
    }

    .navbar a:hover {
      color: #f9a01b;
    }

    .container {
      background: #fff;
      border-radius: 16px;
      padding: 30px;
      margin-top: 50px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      max-width: 1100px;
    }

    h2 {
      color: #f9a01b;
      font-weight: 700;
      text-align: center;
      margin-bottom: 25px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      border-radius: 10px;
      overflow: hidden;
    }

    table th {
      background-color: #102f76;
      color: #fff;
      padding: 12px;
      text-align: center;
      font-weight: 600;
    }

    table td {
      padding: 10px 12px;
      text-align: center;
      color: #142a46;
    }

    tr:hover td {
      background-color: rgba(249, 160, 27, 0.1);
    }

    .btn-back {
      background: linear-gradient(to right, #f9a01b, #ff9554);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-block;
    }

    .btn-back:hover {
      opacity: 0.9;
      transform: translateY(-3px);
    }

    .btn-action {
      border: none;
      border-radius: 8px;
      padding: 6px 12px;
      font-weight: 600;
      transition: 0.3s;
      text-decoration: none;
      color: #fff;
    }

    .btn-rekam {
      background: #102f76;
    }

    .btn-rekam:hover {
      background: #0d2460;
    }

    .footer-note {
      text-align: center;
      margin-top: 25px;
      font-size: 0.9rem;
      color: #142a46;
      opacity: 0.8;
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <span>🐾 Data Pasien Hewan RSHP</span>
    <span>
      <a href="../../../interface/dashboard_perawat.php"><i class="bi bi-house-door"></i> Dashboard</a>
      <a href="../../../interface/login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </span>
  </nav>

  <div class="container">
    <h2>📋 Daftar Pasien Hari Ini</h2>

    <div class="text-end mb-3">
      <a href="../../../interface/dashboard_perawat.php" class="btn-back">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
      </a>
    </div>

    <?php if (isset($result) && $result->num_rows > 0): ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>ID Reservasi</th>
            <th>Nama Hewan</th>
            <th>Jenis</th>
            <th>Umur</th>
            <th>Nama Pemilik</th>
            <th>Tanggal Kunjungan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['idreservasi']) ?></td>
              <td><?= htmlspecialchars($row['nama_hewan']) ?></td>
              <td><?= htmlspecialchars($row['jenis']) ?></td>
              <td><?= htmlspecialchars($row['umur']) ?> th</td>
              <td><?= htmlspecialchars($row['nama_pemilik']) ?></td>
              <td><?= htmlspecialchars($row['tanggal_kunjungan']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td>
                <!-- 🔹 ubah link ke InputRekamMedis.php -->
                <a href="../rekammedis/InputRekamMedis.php?idreservasi=<?= urlencode($row['idreservasi']) ?>" 
                   class="btn-action btn-rekam">
                  <i class="bi bi-clipboard2-pulse"></i> Rekam Medis
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-center text-muted">Belum ada pasien dari resepsionis hari ini.</p>
    <?php endif; ?>

    <div class="footer-note">RS Hewan Peliharaan — Melayani dengan Sepenuh Hati 💙</div>
  </div>

</body>
</html>

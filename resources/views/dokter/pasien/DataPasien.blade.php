<?php
session_start();
require_once __DIR__ . '/../../../config/koneksiDB.php';

// ✅ Cek login dan role
if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'dokter') {
    header('Location: ../../interface/login.php');
    exit;
}

$db = new DBConnection();
$conn = $db->getConnection();

// Aktifkan laporan error MySQLi untuk debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // ✅ Query Data Pasien untuk Role Dokter (berdasarkan algoritma RSHP)
    $query = "
        SELECT 
            td.idreservasi_dokter AS idreservasi,
            p.nama AS nama_hewan,
            jh.nama_jenis_hewan AS jenis_hewan,
            rh.nama_ras AS ras,
            p.jenis_kelamin,
            TIMESTAMPDIFF(YEAR, p.tanggal_lahir, CURDATE()) AS umur,
            pm.nama AS nama_pemilik,
            DATE(td.waktu_daftar) AS tanggal_kunjungan,
            CASE 
                WHEN td.status = 'A' THEN 'Menunggu'
                WHEN td.status = 'S' THEN 'Selesai'
                ELSE 'Tidak Diketahui'
            END AS status
        FROM temu_dokter td
        JOIN pet p ON td.idpet = p.idpet
        LEFT JOIN ras_hewan rh ON p.idras_hewan = rh.idras_hewan
        LEFT JOIN jenis_hewan jh ON rh.idjenis_hewan = jh.idjenis_hewan
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
  <title>Data Pasien | Dokter RSHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
      color: #142a46;
      margin: 0;
      padding: 0;
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
      padding: 35px 40px;
      margin-top: 50px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      max-width: 1300px;
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
      table-layout: auto;
    }

    table th {
      background-color: #102f76;
      color: #fff;
      padding: 14px;
      text-align: center;
      font-weight: 600;
      white-space: nowrap;
    }

    table td {
      padding: 12px 14px;
      text-align: center;
      color: #142a46;
      vertical-align: middle;
    }

    tr:hover td {
      background-color: rgba(249, 160, 27, 0.08);
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

    /* ✅ Tombol Detail mengikuti gaya dari halaman Rekam Medis */
    .btn-detail {
      background-color: #f9a01b;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 6px 14px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      min-width: 120px;
    }

    .btn-detail:hover {
      background-color: #102f76;
      color: #fff;
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
    <span>🐾 Data Pasien Dokter RSHP</span>
    <span>
      <a href="../../../interface/dashboard_dokter.php"><i class="bi bi-house-door"></i> Dashboard</a>
      <a href="../../../interface/login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </span>
  </nav>

  <div class="container">
    <h2>📋 Daftar Pasien Pemeriksaan</h2>

    <div class="text-end mb-3">
      <a href="../../../interface/dashboard_dokter.php" class="btn-back">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
      </a>
    </div>

    <?php if (isset($result) && $result->num_rows > 0): ?>
      <table class="table table-bordered table-hover align-middle">
        <thead>
          <tr>
            <th>ID Reservasi</th>
            <th>Nama Hewan</th>
            <th>Jenis Hewan</th>
            <th>Ras</th>
            <th>Jenis Kelamin</th>
            <th>Usia (Th)</th>
            <th>Pemilik</th>
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
              <td><?= htmlspecialchars($row['jenis_hewan']) ?></td>
              <td><?= htmlspecialchars($row['ras']) ?></td>
              <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
              <td><?= htmlspecialchars($row['umur']) ?></td>
              <td><?= htmlspecialchars($row['nama_pemilik']) ?></td>
              <td><?= htmlspecialchars($row['tanggal_kunjungan']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td>
                <a href="../rekammedis/DetailRekamMedis.php?idreservasi=<?= urlencode($row['idreservasi']) ?>" class="btn-detail">
                <i class="bi bi-info-circle"></i> Detail
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-center text-muted">Belum ada pasien dalam pemeriksaan atau selesai hari ini.</p>
    <?php endif; ?>

    <div class="footer-note">RS Hewan Peliharaan — Melayani dengan Sepenuh Hati 💙</div>
  </div>

</body>
</html>

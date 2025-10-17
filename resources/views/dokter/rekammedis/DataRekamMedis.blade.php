<?php
require_once(__DIR__ . '/../../../config/koneksiDB.php');
require_once(__DIR__ . '/../../../classes/RekamMedis.php');

$db = new DBConnection();
$conn = $db->getConnection();
$rekam = new RekamMedis($conn);

// ambil semua data (read-only)
$result = $rekam->readAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Rekam Medis | Dokter RSHP</title>
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
      margin-bottom: 20px;
    }

    .btn-back:hover {
      opacity: 0.9;
      transform: translateY(-3px);
    }

    .btn-detail {
      background-color: #f9a01b;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 5px 12px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s;
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
    <span>📋 Data Rekam Medis Hewan RSHP</span>
    <span>
      <a href="../../../interface/dashboard_dokter.php"><i class="bi bi-house-door"></i> Dashboard</a>
      <a href="../../../auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </span>
  </nav>

  <div class="container">
    <h2>🩺 Data Rekam Medis</h2>

    <div class="mb-3 text-center">
      <a href="../../../interface/dashboard_dokter.php" class="btn-back">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard Dokter
      </a>
    </div>

    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>ID Reservasi</th>
          <th>Keluhan</th>
          <th>Diagnosa</th>
          <th>Tindakan</th>
          <th>Catatan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['idrekam_medis'] ?? '-') ?></td>
            <td><?= htmlspecialchars($row['idreservasi_dokter'] ?? '-') ?></td>
            <td><?= htmlspecialchars($row['anamnesa'] ?? '-') ?></td>
            <td><?= htmlspecialchars($row['diagnosa'] ?? '-') ?></td>
            <td><?= htmlspecialchars($row['temuan_klinis'] ?? '-') ?></td>
            <td><?= htmlspecialchars($row['dokter_pemeriksa'] ?? '-') ?></td>
            <td>
              <a href="DetailRekamMedis.php?id=<?= $row['idrekam_medis']; ?>" class="btn-detail">
                <i class="bi bi-info-circle"></i> Detail
              </a>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="7" class="text-center text-muted">Belum ada data rekam medis yang tercatat.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>

    <div class="footer-note">RS Hewan Peliharaan — Melayani dengan Sepenuh Hati 💙</div>
  </div>

</body>
</html>

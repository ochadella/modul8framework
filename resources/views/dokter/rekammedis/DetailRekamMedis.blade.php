<?php
require_once(__DIR__ . '/../../../config/koneksiDB.php');
require_once(__DIR__ . '/../../../classes/RekamMedis.php');

$db = new DBConnection();
$conn = $db->getConnection();
$rekam = new RekamMedis($conn);

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$idreservasi = isset($_GET['idreservasi']) ? intval($_GET['idreservasi']) : 0;
$data = null;

// Jika yang dikirim idreservasi, cari idrekam_medis-nya dulu
if ($idreservasi > 0 && $id === 0) {
    $stmt = $conn->prepare("SELECT idrekam_medis FROM rekam_medis WHERE idreservasi_dokter = ?");
    $stmt->bind_param("i", $idreservasi);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $id = $row['idrekam_medis'];
    }
    $stmt->close();
}

if ($id > 0) {
    // Query join antara rekam_medis dan temu_dokter
    $query = "
        SELECT r.*, t.waktu_daftar AS tanggal_reservasi
        FROM rekam_medis r
        LEFT JOIN temu_dokter t ON r.idreservasi_dokter = t.idreservasi_dokter
        WHERE r.idrekam_medis = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Rekam Medis | RSHP</title>
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
      padding: 30px 40px;
      margin-top: 50px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      max-width: 900px;
    }
    h2 {
      color: #f9a01b;
      font-weight: 700;
      text-align: center;
      margin-bottom: 30px;
    }
    .detail-box {
      background: #f8f9fa;
      border-radius: 12px;
      padding: 20px 25px;
      margin-bottom: 15px;
      border-left: 6px solid #102f76;
    }
    .detail-box strong {
      color: #102f76;
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
    <span>📋 Detail Rekam Medis Hewan RSHP</span>
    <span>
      <a href="../../../interface/dashboard_dokter.php"><i class="bi bi-house-door"></i> Dashboard</a>
      <a href="../../../auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </span>
  </nav>

  <div class="container">
    <h2>🩺 Detail Rekam Medis</h2>

    <div class="mb-3 text-center">
      <a href="../pasien/DataPasien.php" class="btn-back">
        <i class="bi bi-arrow-left-circle"></i> Kembali 
      </a>
    </div>

    <?php if ($data): ?>
      <div class="detail-box"><strong>ID Rekam Medis:</strong> <?= htmlspecialchars($data['idrekam_medis'] ?? '-') ?></div>
      <div class="detail-box"><strong>ID Reservasi:</strong> <?= htmlspecialchars($data['idreservasi_dokter'] ?? '-') ?></div>
      <div class="detail-box"><strong>Keluhan:</strong> <?= htmlspecialchars($data['anamnesa'] ?? '-') ?></div>
      <div class="detail-box"><strong>Diagnosa:</strong> <?= htmlspecialchars($data['diagnosa'] ?? '-') ?></div>
      <div class="detail-box"><strong>Tindakan:</strong> <?= htmlspecialchars($data['temuan_klinis'] ?? '-') ?></div>
      <div class="detail-box"><strong>Catatan Dokter:</strong> <?= htmlspecialchars($data['dokter_pemeriksa'] ?? '-') ?></div>
      <div class="detail-box">
        <strong>Tanggal Pemeriksaan:</strong>
        <?= !empty($data['tanggal_reservasi'])
          ? htmlspecialchars(date('d-m-Y', strtotime($data['tanggal_reservasi'])))
          : '-' ?>
      </div>
      <div class="detail-box"><strong>Dibuat Oleh:</strong> <?= htmlspecialchars($data['dibuat_oleh'] ?? 'Perawat RSHP') ?></div>
    <?php else: ?>
      <p class="text-center text-muted">Data rekam medis tidak ditemukan.</p>
    <?php endif; ?>

    <div class="footer-note">RS Hewan Peliharaan — Melayani dengan Sepenuh Hati 💙</div>
  </div>

</body>
</html>

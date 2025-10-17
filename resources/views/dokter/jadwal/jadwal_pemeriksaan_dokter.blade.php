<?php
session_start();
require_once __DIR__ . '/../../../config/koneksiDB.php';

// ✅ Cek login dan role
if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'dokter') {
  header('Location: ../../login.php');
  exit;
}

$db = new DBConnection();
$conn = $db->getConnection();

// Ambil data user login
$iduser = $_SESSION['user']['iduser'] ?? 0;
$email_user = $_SESSION['user']['email'] ?? '';

// ✅ Pastikan ambil ID dokter dari tabel user berdasarkan email
$stmt_dokter = $conn->prepare("SELECT iduser FROM user WHERE email = ?");
$stmt_dokter->bind_param("s", $email_user);
$stmt_dokter->execute();
$res_dokter = $stmt_dokter->get_result();
$id_dokter = 0;
if ($res_dokter && $row = $res_dokter->fetch_assoc()) {
  $id_dokter = $row['iduser'];
}
$stmt_dokter->close();

// ✅ Gunakan prepared statement agar aman & pasti match integer id
$stmt = $conn->prepare("
  SELECT tanggal_pemeriksaan, jam_mulai, jam_selesai, ruang, keterangan
  FROM jadwal_pemeriksaan
  WHERE id_dokter = ?
  ORDER BY tanggal_pemeriksaan ASC
");
$stmt->bind_param("i", $id_dokter);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Jadwal Pemeriksaan | Dokter RSHP</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css' rel='stylesheet'>
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
      max-width: 1000px;
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
    <span>🩺 Jadwal Pemeriksaan Dokter RSHP</span>
    <span>
      <a href="../../../interface/dashboard_dokter.php"><i class="bi bi-house-door"></i> Dashboard</a>
      <a href="../../../interface/login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </span>
  </nav>

  <div class="container">
    <h2>📅 Jadwal Pemeriksaan Dokter</h2>
    <div class="text-end mb-3">
      <a href="../../../interface/dashboard_dokter.php" class="btn-back">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
      </a>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr class="text-center">
            <th>Tanggal Pemeriksaan</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Ruang</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['tanggal_pemeriksaan']) ?></td>
              <td><?= htmlspecialchars($row['jam_mulai']) ?></td>
              <td><?= htmlspecialchars($row['jam_selesai']) ?></td>
              <td><?= htmlspecialchars($row['ruang'] ?? '-') ?></td>
              <td><?= htmlspecialchars($row['keterangan'] ?? '-') ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-center text-muted">Belum ada jadwal pemeriksaan untuk Anda.</p>
    <?php endif; ?>

    <div class="footer-note">RS Hewan Peliharaan — Melayani dengan Sepenuh Hati 💙</div>
  </div>

</body>
</html>

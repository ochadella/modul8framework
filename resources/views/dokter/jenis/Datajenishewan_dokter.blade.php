<?php
session_start();
require_once __DIR__ . '/../../../config/koneksiDB.php';

if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'dokter') {
  header('Location: ../../login.php');
  exit;
}

$db = new DBConnection();
$conn = $db->getConnection();

$sql = "SELECT * FROM jenis_hewan ORDER BY idjenis_hewan ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Jenis Hewan | Dokter RSHP</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css' rel='stylesheet'>
  <style>
    body {font-family:'Poppins',sans-serif;background:linear-gradient(to right,#142a46,#102f76,#f9a01b);color:#142a46;}
    .navbar{background:#fff;box-shadow:0 4px 10px rgba(0,0,0,0.15);padding:15px 30px;display:flex;justify-content:space-between;align-items:center;}
    .navbar a{color:#102f76;font-weight:600;text-decoration:none;margin-left:20px;}
    .navbar a:hover{color:#f9a01b;}
    .container{background:#fff;border-radius:16px;padding:30px;margin-top:50px;box-shadow:0 8px 20px rgba(0,0,0,0.2);max-width:800px;}
    h2{text-align:center;color:#f9a01b;margin-bottom:25px;font-weight:700;}
    table{width:100%;border-collapse:collapse;border-radius:10px;overflow:hidden;}
    th{background:#102f76;color:#fff;padding:12px;text-align:center;}
    td{text-align:center;padding:10px;color:#142a46;}
    tr:hover td{background:rgba(249,160,27,0.1);}
    .footer{text-align:center;margin-top:25px;color:#142a46;opacity:0.8;}
  </style>
</head>
<body>
  <nav class="navbar">
    <span>🐾 Data Jenis Hewan</span>
    <span>
      <a href="../../../interface/dashboard_dokter.php"><i class="bi bi-house-door"></i> Dashboard</a>
      <a href="../../../interface/login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </span>
  </nav>

  <div class="container">
    <h2>📋 Jenis Hewan</h2>
    <?php if ($result && $result->num_rows > 0): ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr><th>ID</th><th>Nama Jenis Hewan</th></tr>
        </thead>
        <tbody>
          <?php while($row=$result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['idjenis_hewan']) ?></td>
              <td><?= htmlspecialchars($row['nama_jenis_hewan']) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-center text-muted">Belum ada data jenis hewan.</p>
    <?php endif; ?>
    <div class="footer">RS Hewan Peliharaan — Melayani dengan Sepenuh Hati 💙</div>
  </div>
</body>
</html>

<?php
session_start();
require_once __DIR__ . '/../../../config/koneksiDB.php';

// cek login & role
if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'perawat') {
    header('Location: ../../login.php');
    exit;
}

$db = new DBConnection();
$conn = $db->getConnection();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<script>alert('ID tidak ditemukan!'); window.location='data_pemeriksaan.php';</script>";
    exit;
}

$q = $conn->query("SELECT * FROM rekam_medis WHERE idrekam_medis = '$id'");
if ($q->num_rows == 0) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='data_pemeriksaan.php';</script>";
    exit;
}
$data = $q->fetch_assoc();

if (isset($_POST['update'])) {
    $anamnesa = $_POST['anamnesa'];
    $diagnosa = $_POST['diagnosa'];
    $temuan = $_POST['temuan_klinis'];
    $tanggal = $_POST['tanggal_periksa'];

    $update = $conn->query("
        UPDATE rekam_medis 
        SET anamnesa = '$anamnesa',
            diagnosa = '$diagnosa',
            temuan_klinis = '$temuan',
            tanggal_periksa = '$tanggal'
        WHERE idrekam_medis = '$id'
    ");

    if ($update) {
        echo "<script>alert('✅ Data berhasil diperbarui!'); window.location='data_pemeriksaan.php';</script>";
    } else {
        echo "<script>alert('❌ Gagal memperbarui data!'); window.location='data_pemeriksaan.php';</script>";
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Pemeriksaan | RSHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
      color: #142a46;
      margin: 0;
      padding: 0;
    }
    .container {
      background: #fff;
      border-radius: 16px;
      padding: 30px;
      margin-top: 60px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      max-width: 700px;
    }
    h2 {
      text-align: center;
      color: #f9a01b;
      font-weight: 700;
      margin-bottom: 25px;
    }
    label {
      font-weight: 600;
    }
    .btn-submit {
      background: linear-gradient(to right, #102f76, #0e3a91);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-weight: 600;
    }
    .btn-submit:hover {
      opacity: 0.9;
      transform: translateY(-2px);
    }
    .btn-back {
      background: linear-gradient(to right, #f9a01b, #ff9554);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-weight: 600;
      text-decoration: none;
    }
    .btn-back:hover {
      opacity: 0.9;
      transform: translateY(-2px);
    }
  </style>
</head>
<body>

<div class="container">
  <h2>✏️ Edit Data Pemeriksaan</h2>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Anamnesa</label>
      <textarea name="anamnesa" class="form-control" rows="3" required><?= htmlspecialchars($data['anamnesa']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Diagnosa</label>
      <textarea name="diagnosa" class="form-control" rows="3" required><?= htmlspecialchars($data['diagnosa']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Temuan Klinis</label>
      <textarea name="temuan_klinis" class="form-control" rows="3"><?= htmlspecialchars($data['temuan_klinis']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Tanggal Periksa</label>
      <input type="datetime-local" name="tanggal_periksa"
             class="form-control"
             value="<?= date('Y-m-d\TH:i', strtotime($data['tanggal_periksa'])) ?>">
    </div>

    <div class="text-end">
      <a href="data_pemeriksaan.php" class="btn-back">⬅️ Kembali</a>
      <button type="submit" name="update" class="btn-submit">💾 Simpan</button>
    </div>
  </form>
</div>

</body>
</html>

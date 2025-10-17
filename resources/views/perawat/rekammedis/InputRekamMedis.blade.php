<?php
session_start();
require_once __DIR__ . '/../../../config/koneksiDB.php';
require_once __DIR__ . '/../../../classes/RekamMedis.php';

if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'perawat') {
    header('Location: ../../interface/login.php');
    exit;
}

$db = new DBConnection();
$conn = $db->getConnection();
$rekamMedis = new RekamMedis($conn);

// 🔹 Proses simpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rekamMedis->idreservasi_dokter = $_POST['idreservasi_dokter'];
    $rekamMedis->anamnesa = $_POST['anamnesa'];
    $rekamMedis->diagnosa = $_POST['diagnosa'];
    $rekamMedis->temuan_klinis = $_POST['temuan_klinis'];
    $rekamMedis->dokter_pemeriksa = $_POST['dokter_pemeriksa'];

    if ($rekamMedis->create()) {
        header("Location: ./DataRekamMedis.php");
        exit;
    } else {
        echo "<script>alert('Gagal menyimpan rekam medis!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Input Rekam Medis | RSHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
      color: #142a46;
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
  </style>
</head>
<body>

<div class="container">
  <h2>🩺 Input Rekam Medis</h2>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">ID Reservasi Dokter</label>
      <input type="number" name="idreservasi_dokter" class="form-control" placeholder="Masukkan ID Reservasi" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Anamnesa / Keluhan</label>
      <textarea name="anamnesa" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Diagnosa</label>
      <textarea name="diagnosa" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Temuan Klinis / Tindakan</label>
      <textarea name="temuan_klinis" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Dokter Pemeriksa (ID)</label>
      <input type="number" name="dokter_pemeriksa" class="form-control" required>
    </div>

    <div class="text-end">
      <button type="submit" class="btn-submit">Simpan Rekam Medis</button>
      <a href="./DataRekamMedis.php" class="btn-back">Kembali</a>
    </div>
  </form>
</div>

</body>
</html>

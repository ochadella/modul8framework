<?php
session_start();
require_once __DIR__ . '/../../../config/koneksiDB.php';
require_once __DIR__ . '/../../../classes/RekamMedis.php';

// Cek login & role
if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'perawat') {
    header('Location: ../../interface/login.php');
    exit;
}

$db = new DBConnection();
$conn = $db->getConnection();
$rekamMedis = new RekamMedis($conn);

// 🔹 Ambil semua data
$result = $rekamMedis->readAll();

// 🔹 Mode edit: ambil data berdasarkan ID jika ada parameter ?edit=
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $rekamMedis->readById($_GET['edit']);
}

// 🔹 Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $rekamMedis->idrekam_medis = $_POST['idrekam_medis'];
    $rekamMedis->idreservasi_dokter = $_POST['idreservasi_dokter'];
    $rekamMedis->anamnesa = $_POST['anamnesa'];
    $rekamMedis->diagnosa = $_POST['diagnosa'];
    $rekamMedis->temuan_klinis = $_POST['temuan_klinis'];
    $rekamMedis->dokter_pemeriksa = $_POST['dokter_pemeriksa'];

    if ($rekamMedis->update()) {
        echo "<script>alert('Rekam medis berhasil diperbarui!'); window.location='DataRekamMedis.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}

// 🔹 Proses hapus
if (isset($_GET['hapus'])) {
    if ($rekamMedis->delete($_GET['hapus'])) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='DataRekamMedis.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Rekam Medis | RSHP</title>
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

    .btn-add {
      background: linear-gradient(to right, #102f76, #0e3a91);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
      margin-right: 10px;
    }

    .btn-add:hover {
      opacity: 0.9;
      transform: translateY(-3px);
    }

    .btn-action {
      border: none;
      border-radius: 8px;
      padding: 6px 12px;
      font-weight: 500;
      color: #fff;
      text-decoration: none;
      transition: all 0.3s;
      margin: 0 3px;
      display: inline-block;
    }

    .btn-edit {
      background-color: #0e3a91;
    }

    .btn-edit:hover {
      background-color: #1b56cc;
      transform: translateY(-2px);
    }

    .btn-delete {
      background-color: #dc3545;
    }

    .btn-delete:hover {
      background-color: #b52a36;
      transform: translateY(-2px);
    }

    .footer-note {
      text-align: center;
      margin-top: 25px;
      font-size: 0.9rem;
      color: #142a46;
      opacity: 0.8;
    }

    .form-section {
      background-color: #f8f9fa;
      border-radius: 10px;
      padding: 25px;
      margin-bottom: 30px;
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <span>📋 Data Rekam Medis Hewan RSHP</span>
    <span>
      <a href="../../../interface/dashboard_perawat.php"><i class="bi bi-house-door"></i> Dashboard</a>
      <a href="../../../auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </span>
  </nav>

  <div class="container">
    <h2>🩺 Daftar Rekam Medis</h2>

    <?php if ($editData): ?>
    <div class="form-section">
      <form method="POST">
        <input type="hidden" name="idrekam_medis" value="<?= htmlspecialchars($editData['idrekam_medis']) ?>">

        <div class="mb-3">
          <label class="form-label fw-semibold">ID Reservasi Dokter:</label>
          <input type="number" name="idreservasi_dokter" class="form-control"
                 value="<?= htmlspecialchars($editData['idreservasi_dokter']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Keluhan / Anamnesa:</label>
          <textarea name="anamnesa" class="form-control" rows="2" required><?= htmlspecialchars($editData['anamnesa']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Diagnosa:</label>
          <textarea name="diagnosa" class="form-control" rows="2" required><?= htmlspecialchars($editData['diagnosa']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Tindakan / Temuan Klinis:</label>
          <textarea name="temuan_klinis" class="form-control" rows="2" required><?= htmlspecialchars($editData['temuan_klinis']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Catatan / Dokter Pemeriksa (ID):</label>
          <input type="text" name="dokter_pemeriksa" class="form-control"
                 value="<?= htmlspecialchars($editData['dokter_pemeriksa'] ?? '') ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-warning fw-semibold">Update</button>
        <a href="DataRekamMedis.php" class="btn btn-danger fw-semibold">Batal</a>
      </form>
    </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between mb-3">
      <a href="InputRekamMedis.php" class="btn-add">
        <i class="bi bi-plus-circle"></i> Tambah Rekam Medis
      </a>

      <a href="../pasien/data_pasien.php" class="btn-back">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Data Pasien
      </a>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
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
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['idrekam_medis']) ?></td>
              <td><?= htmlspecialchars($row['idreservasi_dokter']) ?></td>
              <td><?= htmlspecialchars($row['anamnesa']) ?></td>
              <td><?= htmlspecialchars($row['diagnosa']) ?></td>
              <td><?= htmlspecialchars($row['temuan_klinis']) ?></td>
              <td><?= htmlspecialchars($row['dokter_pemeriksa'] ?? '-') ?></td>
              <td>
                <a href="DataRekamMedis.php?edit=<?= $row['idrekam_medis'] ?>" class="btn-action btn-edit">
                  <i class="bi bi-pencil-square"></i> Edit
                </a>
                <a href="DataRekamMedis.php?hapus=<?= $row['idrekam_medis'] ?>"
                   class="btn-action btn-delete"
                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                   <i class="bi bi-trash"></i> Hapus
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-center text-muted">Belum ada data rekam medis yang tercatat.</p>
    <?php endif; ?>

    <div class="footer-note">RS Hewan Peliharaan — Melayani dengan Sepenuh Hati 💙</div>
  </div>

</body>
</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user']) || $_SESSION['user']['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../../../config/koneksiDB.php";
require_once __DIR__ . "/../../../classes/Pet.php";
require_once __DIR__ . "/../../../classes/Pemilik.php";
require_once __DIR__ . "/../../../classes/RasHewan.php";

$db = new DBConnection();
$pet = new Pet($db);
$pemilik = new Pemilik($db);
$ras = new RasHewan($db);

// 🔹 Tambah Data
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $warna_bulu = $_POST['warna_bulu'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $idpemilik = $_POST['idpemilik'];
    $idras = $_POST['idras_hewan'];

    $pet->create($nama, $tanggal_lahir, $warna_bulu, $jenis_kelamin, $idpemilik, $idras);

    $conn = $db->getConnection();
    $idpetBaru = $conn->insert_id;

    $stmt = $conn->prepare("INSERT INTO reservasi (idhewan, tanggal_kunjungan, status) VALUES (?, CURDATE(), 'Menunggu')");
    $stmt->bind_param("i", $idpetBaru);
    $stmt->execute();
    $stmt->close();

    header("Location: Datapet.php");
    exit;
}

// 🔹 Update Data
if (isset($_POST['update'])) {
    $id = $_POST['idpet'];
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $warna_bulu = $_POST['warna_bulu'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $idpemilik = $_POST['idpemilik'];
    $idras = $_POST['idras_hewan'];

    $pet->update($id, $nama, $tanggal_lahir, $warna_bulu, $jenis_kelamin, $idpemilik, $idras);
    header("Location: Datapet.php");
    exit;
}

// 🔹 Hapus Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn = $db->getConnection();

    // Hapus data terkait di temu_dokter dulu
    $conn->query("DELETE FROM temu_dokter WHERE idpet = $id");

    // Baru hapus dari tabel pet
    $pet->delete($id);

    // ❌ Jangan reset ID — biarkan auto_increment
    header("Location: Datapet.php");
    exit;
}

// 🔹 Ambil Data
$rows = $pet->getAll()['data'] ?? [];
$listPemilik = $pemilik->getAll()['data'] ?? [];
$listRas = $ras->getAll()['data'] ?? [];
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $pet->getById($_GET['edit']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Pet</title>
  <style>
    body{margin:0;font-family:Arial,sans-serif;background:#f4f6f9;}
    .navbar{background:#102f76;padding:15px 25px;color:#fff;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 6px rgba(0,0,0,0.3);}
    .navbar span{font-size:18px;font-weight:bold;color:#f9a01b;}
    .navbar a{color:#fff;text-decoration:none;margin-left:20px;font-weight:bold;transition:0.3s;}
    .navbar a:hover{color:#f9a01b;}
    .content{padding:30px;}
    h2{margin-bottom:20px;color:#102f76;}
    .btn{display:inline-block;padding:8px 14px;margin:4px;border-radius:6px;font-size:14px;font-weight:bold;text-decoration:none;color:white;transition:0.3s;border:none;cursor:pointer;}
    .btn-back{background:#6c757d;}
    .btn-add{background:linear-gradient(to right,#f9a01b,#ff9554);}
    .btn-edit{background:#ffc107;color:black;}
    .btn-delete{background:#dc3545;}
    .btn:hover{opacity:0.9;}
    .form-card,.table-container{background:#fff;border-radius:12px;padding:20px;box-shadow:0 4px 12px rgba(0,0,0,0.15);margin-bottom:20px;}
    input,select{width:100%;padding:8px;margin:8px 0;border:1px solid #ccc;border-radius:6px;}
    table{border-collapse:collapse;width:100%;min-width:800px;}
    th{background:#102f76;color:#f9a01b;padding:12px;text-align:left;}
    td{padding:10px;border-bottom:1px solid #ddd;}
    tr:hover td{background:rgba(249,160,27,0.08);}
    .actions{white-space:nowrap;}
  </style>
</head>
<body>
  <div class="navbar">
      <span>🐾 Data Pet</span>
      <span>
        <a href="../../../interface/dashboard.php">Dashboard</a>
        <a href="../../../interface/login.php">Logout</a>
      </span>
  </div>
  <div class="content">
      <h2>Data Pet</h2>
      <div class="form-card">
          <form method="post">
              <input type="hidden" name="idpet" value="<?= $editData['idpet'] ?? '' ?>">
              <label>Nama Pet:</label>
              <input type="text" name="nama" value="<?= $editData['nama'] ?? '' ?>" required>

              <label>Tanggal Lahir:</label>
              <input type="date" name="tanggal_lahir" value="<?= $editData['tanggal_lahir'] ?? '' ?>" required>

              <label>Warna Bulu:</label>
              <input type="text" name="warna_bulu" value="<?= $editData['warna_bulu'] ?? '' ?>" required>

              <label>Jenis Kelamin:</label>
              <select name="jenis_kelamin" required>
                  <option value="">-- Pilih Jenis Kelamin --</option>
                  <option value="Jantan" <?= ($editData && $editData['jenis_kelamin']=='Jantan')?'selected':'' ?>>Jantan</option>
                  <option value="Betina" <?= ($editData && $editData['jenis_kelamin']=='Betina')?'selected':'' ?>>Betina</option>
              </select>

              <label>Pemilik:</label>
              <select name="idpemilik" required>
                  <option value="">-- Pilih Pemilik --</option>
                  <?php foreach($listPemilik as $p): ?>
                  <option value="<?= $p['idpemilik'] ?>" <?= ($editData && $editData['idpemilik']==$p['idpemilik'])?'selected':'' ?>>
                      <?= $p['nama'] ?>
                  </option>
                  <?php endforeach; ?>
              </select>

              <label>Ras Hewan:</label>
              <select name="idras_hewan" required>
                  <option value="">-- Pilih Ras --</option>
                  <?php foreach($listRas as $r): ?>
                  <option value="<?= $r['idras_hewan'] ?>" <?= ($editData && $editData['idras_hewan']==$r['idras_hewan'])?'selected':'' ?>>
                      <?= $r['nama_ras'] ?>
                  </option>
                  <?php endforeach; ?>
              </select>

              <?php if ($editData): ?>
                <button type="submit" name="update" class="btn btn-edit">Update</button>
                <a href="Datapet.php" class="btn btn-delete">Batal</a>
              <?php else: ?>
                <button type="submit" name="tambah" class="btn btn-add">Tambah</button>
                <a href="../../../views/admin/datamaster.php" class="btn btn-back">← Kembali</a>
              <?php endif; ?>
          </form>
      </div>

      <div class="table-container">
          <table>
              <tr><th>No</th><th>Nama Pet</th><th>Tanggal Lahir</th><th>Jenis Kelamin</th><th>Pemilik</th><th>Ras</th><th>Aksi</th></tr>
              <?php if ($rows): $no = 1; foreach($rows as $r): ?>
              <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $r['nama'] ?></td>
                  <td><?= $r['tanggal_lahir'] ?></td>
                  <td><?= $r['jenis_kelamin'] ?></td>
                  <td><?= $r['nama_pemilik'] ?></td>
                  <td><?= $r['nama_ras'] ?></td>
                  <td class="actions">
                      <a href="Datapet.php?edit=<?= $r['idpet'] ?>" class="btn btn-edit">✏ Edit</a>
                      <a href="Datapet.php?delete=<?= $r['idpet'] ?>" class="btn btn-delete" onclick="return confirm('Hapus data ini?')">🗑 Hapus</a>
                  </td>
              </tr>
              <?php endforeach; else: ?>
              <tr><td colspan="7" style="text-align:center;color:#666;">Belum ada data</td></tr>
              <?php endif; ?>
          </table>
      </div>
  </div>
</body>
</html>

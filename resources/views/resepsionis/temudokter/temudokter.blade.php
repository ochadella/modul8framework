<?php
require_once __DIR__ . "/../../../config/koneksiDB.php";
require_once __DIR__ . "/../../../classes/temuDokter.php";

$db = new DBConnection();
$temuObj = new TemuDokter($db);

// 🔹 Tambah antrian
if (isset($_POST['add'])) {
    $no_urut = (int)$_POST['no_urut'];
    $status = $_POST['status'] ?? 'A';
    $idpet = (int)$_POST['idpet'];
    $idrole_user = (int)$_POST['idrole_user'];
    $temuObj->create($no_urut, $status, $idpet, $idrole_user);
    header("Location: temudokter.php");
    exit;
}

// 🔹 Update data
if (isset($_POST['edit'])) {
    $id = (int)$_POST['idreservasi_dokter'];
    $no_urut = (int)$_POST['no_urut'];
    $status = $_POST['status'];
    $idpet = (int)$_POST['idpet'];
    $idrole_user = (int)$_POST['idrole_user'];
    $temuObj->update($id, $no_urut, $status, $idpet, $idrole_user);
    header("Location: temudokter.php");
    exit;
}

// 🔹 Hapus data
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $temuObj->delete($id);
    header("Location: temudokter.php");
    exit;
}

// 🔹 Ambil semua data
$dataTemu = $temuObj->getAll();

// 🔹 Data dropdown
$conn = $db->getConnection();
$pets = $conn->query("SELECT idpet, nama FROM pet")->fetch_all(MYSQLI_ASSOC);
$dokters = $conn->query("
    SELECT ru.idrole_user, u.nama 
    FROM role_user ru 
    JOIN user u ON ru.iduser = u.iduser 
    JOIN role r ON ru.idrole = r.idrole 
    WHERE r.nama_role = 'Dokter' AND ru.status = 1
")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Temu Dokter - RSHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      background: #f4f6f9;
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      background: #102f76;
      padding: 15px 25px;
      color: #ffff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    }
    .navbar span {
      font-size: 18px;
      font-weight: bold;
      color: #f9a01b;
    }
    .navbar a {
      color: #ffff;
      text-decoration: none;
      margin-left: 20px;
      font-weight: bold;
      transition: 0.3s;
    }
    .navbar a:hover { color: #f9a01b; }

    .content {
      padding: 30px;
    }
    h2 {
      margin-bottom: 20px;
      color: #102f76;
      font-weight: bold;
    }
    .btn-custom {
      background: linear-gradient(to right,#f9a01b,#ff9554);
      color: white;
      font-weight: bold;
      border: none;
      transition: 0.3s;
    }
    .btn-custom:hover {
      opacity: 0.9;
    }
    .btn-back {
      background: #6c757d;
      color: white;
      font-weight: bold;
      border: none;
    }
    .card-header {
      background: #102f76;
      color: #f9a01b;
      font-weight: bold;
      border-radius: 8px 8px 0 0;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      overflow: hidden;
    }
    table th {
      background: #102f76;
      color: #f9a01b;
      text-align: center;
    }
    table td {
      vertical-align: middle;
      text-align: center;
    }
    tr:hover td {
      background: rgba(249,160,27,0.08);
    }
    .modal-header {
      background: #102f76;
      color: #f9a01b;
    }
  </style>
</head>
<body>

<div class="navbar">
  <span>🐾 Data Temu Dokter</span>
  <span>
    <a href="../../../interface/dashboard_resepsionis.php">Dashboard</a>
    <a href="../../../interface/login.php">Logout</a>
  </span>
</div>

<div class="content">
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="mb-0">📋 Data Temu Dokter</h4>
      <a href="../../../interface/dashboard_resepsionis.php" class="btn btn-back btn-sm">← Kembali</a>
    </div>
    <div class="card-body">
      <!-- Form Tambah -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
          <h5 class="mb-3 text-primary">➕ Tambah Antrian Baru</h5>
          <form method="POST" class="row g-3">
            <div class="col-md-2">
              <label class="form-label">No Urut</label>
              <input type="number" name="no_urut" class="form-control" required>
            </div>

            <div class="col-md-3">
              <label class="form-label">Pilih Hewan</label>
              <select name="idpet" class="form-select" required>
                <option value="">-- Pilih Hewan --</option>
                <?php foreach ($pets as $p): ?>
                  <option value="<?= $p['idpet'] ?>"><?= htmlspecialchars($p['nama']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Pilih Dokter</label>
              <select name="idrole_user" class="form-select" required>
                <option value="">-- Pilih Dokter --</option>
                <?php foreach ($dokters as $d): ?>
                  <option value="<?= $d['idrole_user'] ?>"><?= htmlspecialchars($d['nama']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-2">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="A">Menunggu</option>
                <option value="S">Selesai</option>
                <option value="B">Batal</option>
              </select>
            </div>

            <div class="col-md-2 align-self-end">
              <button type="submit" name="add" class="btn btn-custom w-100">Tambah</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Tabel Data -->
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>No Urut</th>
              <th>Waktu Daftar</th>
              <th>Status</th>
              <th>Nama Hewan</th>
              <th>Dokter</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($dataTemu)): ?>
              <?php foreach ($dataTemu as $i => $row): ?>
                <tr>
                  <td><?= $i + 1 ?></td>
                  <td><?= htmlspecialchars($row['no_urut'] ?? '-') ?></td>
                  <td><?= htmlspecialchars($row['waktu_daftar'] ?? '-') ?></td>
                  <td>
                    <?php
                      $status = $row['status'] ?? 'A';
                      $badge = $status == 'S' ? 'badge bg-success' : ($status == 'B' ? 'badge bg-danger' : 'badge bg-warning text-dark');
                      $text = $status == 'S' ? 'Selesai' : ($status == 'B' ? 'Batal' : 'Menunggu');
                    ?>
                    <span class="<?= $badge ?>"><?= $text ?></span>
                  </td>
                  <td><?= htmlspecialchars($row['nama_pet'] ?? '-') ?></td>
                  <td><?= htmlspecialchars($row['nama_dokter'] ?? '-') ?></td>
                  <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['idreservasi_dokter'] ?>">✏</button>
                    <a href="?delete=<?= $row['idreservasi_dokter'] ?>" onclick="return confirm('Yakin mau hapus data ini?')" class="btn btn-sm btn-danger">🗑</a>
                  </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal<?= $row['idreservasi_dokter'] ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <form method="POST">
                        <div class="modal-header">
                          <h5 class="modal-title">✏ Edit Antrian</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="idreservasi_dokter" value="<?= $row['idreservasi_dokter'] ?>">

                          <div class="mb-3">
                            <label class="form-label">No Urut</label>
                            <input type="number" name="no_urut" class="form-control" value="<?= $row['no_urut'] ?>">
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Pilih Hewan</label>
                            <select name="idpet" class="form-select">
                              <?php foreach ($pets as $p): ?>
                                <option value="<?= $p['idpet'] ?>" <?= $p['idpet'] == $row['idpet'] ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($p['nama']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Pilih Dokter</label>
                            <select name="idrole_user" class="form-select">
                              <?php foreach ($dokters as $d): ?>
                                <option value="<?= $d['idrole_user'] ?>" <?= $d['idrole_user'] == $row['idrole_user'] ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($d['nama']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                              <option value="A" <?= $row['status'] == 'A' ? 'selected' : '' ?>>Menunggu</option>
                              <option value="S" <?= $row['status'] == 'S' ? 'selected' : '' ?>>Selesai</option>
                              <option value="B" <?= $row['status'] == 'B' ? 'selected' : '' ?>>Batal</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" name="edit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="7" class="text-muted">Belum ada data temu dokter 🕐</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

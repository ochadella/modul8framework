<?php
require_once __DIR__ . "/../../../config/koneksiDB.php";
require_once __DIR__ . "/../../../classes/role.php";

$db = new DBConnection();
$roleObj = new Role($db);

$userRoles = $roleObj->getAllUserWithRoles();
$roleOptions = $roleObj->getRoleOptions()['data'] ?? [];

if (isset($_POST['save'])) {
    $iduser = (int)$_POST['iduser'];
    $idrole = (int)$_POST['idrole'];
    $status = (int)$_POST['status'];
    $roleObj->addRoleToUser($iduser, $idrole, $status);

    // 🟩 Tambahan sinkronisasi role ke tabel user (biar tampil juga di Data User)
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT nama_role FROM role WHERE idrole = ?");
    $stmt->bind_param("i", $idrole);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $namaRole = $row['nama_role'];
        $update = $conn->prepare("UPDATE user SET role = ? WHERE iduser = ?");
        $update->bind_param("si", $namaRole, $iduser);
        $update->execute();
    }

    header("Location: manajemenrole.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Role</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        color: #333;
    }

    /* Navbar */
    .navbar {
        background: #102f76;
        padding: 15px 25px;
        color: #fff;
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
        color: #fff;
        text-decoration: none;
        margin-left: 20px;
        font-weight: bold;
        transition: 0.3s;
    }
    .navbar a:hover {
        color: #f9a01b;
    }

    .btn-kembali {
        background: #6c757d;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        padding: 8px 16px;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-kembali:hover { opacity: 0.9; }

    h2 {
        color: #102f76;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .table-container {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        overflow-x: auto;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        min-width: 900px;
        table-layout: fixed;
    }

    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background: #102f76;
        color: #fff;
        padding: 12px;
        font-weight: bold;
    }

    tr:hover td {
        background: rgba(249,160,27,0.08);
    }

    th:nth-child(1), td:nth-child(1) { width: 5%; }
    th:nth-child(2), td:nth-child(2) { width: 7%; }
    th:nth-child(3), td:nth-child(3) { width: 16%; }
    th:nth-child(4), td:nth-child(4) { width: 20%; }
    th:nth-child(5), td:nth-child(5) { width: 35%; }
    /* 🟦 kolom aksi dikecilin biar pas */
    th:nth-child(6), td:nth-child(6) { width: 18%; }

    .btn-simpan {
        background: linear-gradient(to right, #f9a01b, #ff9554);
        border: none;
        color: white !important;
        font-weight: bold;
        border-radius: 6px;
        padding: 6px 14px;
        transition: 0.3s;
    }
    .btn-edit {
        background: #102f76;
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 6px;
        padding: 6px 14px;
        transition: 0.3s;
    }
    .btn-hapus {
        background: #dc3545;
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 6px;
        padding: 6px 14px;
        transition: 0.3s;
    }
    .btn:hover { opacity: 0.9; }

    .form-select {
        border-radius: 6px;
        border: 1px solid #f9a01b;
        background-color: #fff;
        font-size: 14px;
        text-align: center;
    }

    /* 💙 Gradasi biru dari palet project */
    .badge-role {
        background: linear-gradient(to right, #004AAD, #00B4D8);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .role-wrapper {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-align: center;
    }

    .role-wrapper.mb-2 {
        justify-content: center;
    }

    .aksi-wrapper {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .no-col {
        background: #f9a01b;
        color: #fff;
        font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="navbar">
      <span>⚙️ Manajemen Role</span>
      <span>
          <a href="../../../interface/dashboard.php">Dashboard</a>
          <a href="../datamaster.php">Data Master</a>
          <a href="../../../interface/login.php">Logout</a>
      </span>
  </div>

  <div class="container mt-5">
    <div class="mb-4">
      <a href="../datamaster.php" class="btn btn-kembali">
        ← Kembali
      </a>
    </div>

    <h2>Manajemen Role</h2>

    <div class="table-container">
      <table class="table table-bordered align-middle">
        <thead>
          <tr>
            <th>No</th>
            <th>ID User</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role & Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($userRoles['data'] as $row): ?>
          <tr>
            <form method="POST">
              <td class="no-col"><?= $no++ ?></td>
              <td><?= $row['iduser'] ?></td>
              <td><?= htmlspecialchars($row['nama']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>

              <td>
                <div class="role-wrapper mb-2">
                  <?php
                    $roles = explode(',', $row['roles'] ?? '');
                    foreach ($roles as $r) {
                      if (trim($r) !== '') {
                        echo '<span class="badge-role">'.htmlspecialchars(trim($r)).'</span>';
                      }
                    }
                  ?>
                </div>

                <div class="role-wrapper">
                  <select name="idrole" class="form-select w-auto">
                    <option value="">Pilih Role</option>
                    <?php foreach ($roleOptions as $r): ?>
                      <option value="<?= $r['idrole'] ?>"><?= $r['nama_role'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <select name="status" class="form-select w-auto">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                  </select>
                  <input type="hidden" name="iduser" value="<?= $row['iduser'] ?>">
                  <button type="submit" name="save" class="btn btn-simpan btn-sm"><i class="bi bi-check2-circle"></i> Simpan</button>
                </div>
              </td>

              <td>
                <div class="aksi-wrapper">
                  <a href="hapusrole.php?id=<?= $row['iduser'] ?>" class="btn btn-hapus btn-sm" onclick="return confirm('Yakin hapus semua role user ini?')">
                    <i class="bi bi-trash"></i> Hapus
                  </a>
                </div>
              </td>
            </form>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>

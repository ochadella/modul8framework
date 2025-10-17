<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['user']) || $_SESSION['user']['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../../../config/koneksiDB.php";
require_once __DIR__ . "/../../../classes/Kategori.php";

$db = new DBConnection();
$kategori = new Kategori($db);

// Tambah
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_kategori'];
    $kategori->create($nama);
    header("Location: Datakategori.php");
    exit;
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['idkategori'];
    $nama = $_POST['nama_kategori'];
    $kategori->update($id, $nama);
    header("Location: Datakategori.php");
    exit;
}

// Hapus
if (isset($_GET['delete'])) {
    $kategori->delete($_GET['delete']);
    header("Location: Datakategori.php");
    exit;
}

// Data
$rows = $kategori->getAll()['data'] ?? [];
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $kategori->getById($_GET['edit']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Kategori</title>
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
input{width:100%;padding:8px;margin:8px 0;border:1px solid #ccc;border-radius:6px;}
table{border-collapse:collapse;width:100%;min-width:500px;}
th{background:#102f76;color:#f9a01b;padding:12px;text-align:left;}
td{padding:10px;border-bottom:1px solid #ddd;}
tr:hover td{background:rgba(249,160,27,0.08);}
.actions{white-space:nowrap;}
</style>
</head>
<body>
<div class="navbar">
    <span>📂 Kategori</span>
    <span>
        <a href="dashboard.php">Dashboard</a>
        <a href="datamaster.php">Data Master</a>
        <a href="logout.php">Logout</a>
    </span>
</div>
<div class="content">
    <h2>Data Kategori</h2>
    <div class="form-card">
        <form method="post">
            <input type="hidden" name="idkategori" value="<?= $editData['idkategori'] ?? '' ?>">
            <label>Nama Kategori:</label>
            <input type="text" name="nama_kategori" value="<?= $editData['nama_kategori'] ?? '' ?>" required>
            <?php if ($editData): ?>
                <button type="submit" name="update" class="btn btn-edit">Update</button>
                <a href="Datakategori.php" class="btn btn-delete">Batal</a>
            <?php else: ?>
                <button type="submit" name="tambah" class="btn btn-add">Tambah</button>
                <a href="../../admin/datamaster.php" class="btn btn-back">← Kembali</a>
            <?php endif; ?>
        </form>
    </div>
    <div class="table-container">
        <table>
            <tr><th>ID</th><th>Nama Kategori</th><th>Aksi</th></tr>
            <?php if ($rows): foreach($rows as $r): ?>
                <tr>
                    <td><?= $r['idkategori'] ?></td>
                    <td><?= $r['nama_kategori'] ?></td>
                    <td class="actions">
                        <a href="Datakategori.php?edit=<?= $r['idkategori'] ?>" class="btn btn-edit">✏ Edit</a>
                        <a href="Datakategori.php?delete=<?= $r['idkategori'] ?>" class="btn btn-delete" onclick="return confirm('Hapus data ini?')">🗑 Hapus</a>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="3" style="text-align:center;color:#666;">Belum ada data</td></tr>
            <?php endif; ?>
        </table>
    </div>
</div>
</body>
</html>

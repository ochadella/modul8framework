<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/koneksiDB.php"; 
require_once __DIR__ . "/user.php";      

$db = new DBConnection();
$user = new User($db);

// Ambil data user by ID
if (!isset($_GET['id'])) {
    header("Location: datauser.php");
    exit;
}
$id = $_GET['id'];
$editData = $user->getById($id);

// Update user
if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $user->update($id, $nama, $email);
    header("Location: datauser.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <style>
        body { margin:0; font-family: Arial, sans-serif; background:#f4f6f9; }
        .navbar { background:#102f76; padding:15px 25px; color:#fff; display:flex; justify-content:space-between; align-items:center; box-shadow:0 2px 6px rgba(0,0,0,0.3); }
        .navbar span { font-size:18px; font-weight:bold; color:#f9a01b; }
        .navbar a { color:#fff; text-decoration:none; margin-left:20px; font-weight:bold; transition:0.3s; }
        .navbar a:hover { color:#f9a01b; }
        .content { padding:30px; max-width:600px; margin:40px auto; }
        h2 { margin-bottom:20px; color:#102f76; text-align:center; }
        .form-card { background:#fff; border-radius:12px; padding:25px; box-shadow:0 4px 12px rgba(0,0,0,0.15); }
        label { display:block; font-weight:bold; margin-top:10px; }
        input { width:100%; padding:10px; margin-top:6px; border:1px solid #ccc; border-radius:6px; }
        .btn { display:inline-block; padding:10px 16px; margin:8px 4px 0 0; border-radius:6px; font-size:14px; font-weight:bold; text-decoration:none; color:white; transition:0.3s; border:none; cursor:pointer; }
        .btn-back { background:#6c757d; }
        .btn-save { background:linear-gradient(to right, #f9a01b, #ff9554); }
        .btn:hover { opacity:0.9; }
    </style>
</head>
<body>
    <div class="navbar">
        <span>✏ Edit User</span>
        <span>
            <a href="dashboard.php">Dashboard</a>
            <a href="datamaster.php">Data Master</a>
            <a href="logout.php">Logout</a>
        </span>
    </div>
    <div class="content">
        <h2>Form Edit User</h2>
        <div class="form-card">
            <form method="post">
                <label>Nama:</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($editData['nama']) ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($editData['email']) ?>" required>

                <button type="submit" name="update" class="btn btn-save">💾 Simpan Perubahan</button>
                <a href="datauser.php" class="btn btn-back">← Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
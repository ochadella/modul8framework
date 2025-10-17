<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Berhasil</title>
<style>
body { font-family: Arial,sans-serif; background:#f5f5f5; display:flex; justify-content:center; align-items:center; min-height:100vh; margin:0; }
.container { text-align:center; background:white; padding:30px; border-radius:16px; box-shadow:0 4px 12px rgba(0,0,0,0.2); }
a { display:inline-block; margin-top:20px; text-decoration:none; background:#102f76; color:white; padding:10px 20px; border-radius:8px; }
a:hover { background:#142a46; }
</style>
</head>
<body>
<div class="container">
    <h2>Selamat Anda Berhasil Login 🎉</h2>
    <p>Halo, <?= htmlspecialchars($_SESSION['user']['nama']) ?></p>
    <a href="../index.php">Kembali ke Beranda</a>
</div>
</body>
</html>

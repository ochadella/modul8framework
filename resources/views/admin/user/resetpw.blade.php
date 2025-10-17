<?php
require_once __DIR__ . "/config/koneksiDB.php";
require_once __DIR__ . "/classes/user.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_GET['id'])) {
    die("ID user tidak ditemukan!");
}

$db = new DBConnection();
$userObj = new User($db);

$iduser = (int) $_GET['id'];
$newPassword = '123456'; // default password baru

$result = $userObj->resetPassword($iduser, $newPassword);

if ($result['status'] === 'success') {
    echo "<script>
        alert('Password berhasil direset menjadi 123456');
        window.location.href='views/admin/user/datauser.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal reset password!');
        window.history.back();
    </script>";
}
?>
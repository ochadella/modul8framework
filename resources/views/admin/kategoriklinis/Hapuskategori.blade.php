<?php
require_once(__DIR__ . '/../../../config/koneksiDB.php');
require_once(__DIR__ . '/../../../classes/KategoriKlinis.php');

// ✅ pastikan koneksi aktif
if (!isset($conn) || !$conn) {
    $db = new DBConnection();
    $conn = $db->getConnection();
}

$kategori = new KategoriKlinis($conn);

// ✅ sesuaikan properti id dengan class (id_kategori_klinis)
$kategori->id_kategori_klinis = $_GET['id'];

if ($kategori->delete()) {
    header("Location: Datakategoriklinis.php");
    exit;
} else {
    echo "<script>alert('Gagal menghapus data!');</script>";
}
?>

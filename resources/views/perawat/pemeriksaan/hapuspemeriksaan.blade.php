<?php
session_start();
require_once __DIR__ . '/../../../config/koneksiDB.php';

// Cek login & role
if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'perawat') {
    header('Location: ../../login.php');
    exit;
}

$db = new DBConnection();
$conn = $db->getConnection();

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<script>alert('ID tidak ditemukan!'); window.location='data_pemeriksaan.php';</script>";
    exit;
}

// Hapus data
$hapus = $conn->query("DELETE FROM rekam_medis WHERE idrekam_medis = '$id'");

if ($hapus) {
    echo "<script>alert('🗑️ Data berhasil dihapus!'); window.location='data_pemeriksaan.php';</script>";
} else {
    echo "<script>alert('❌ Gagal menghapus data!'); window.location='data_pemeriksaan.php';</script>";
}
exit;
?>

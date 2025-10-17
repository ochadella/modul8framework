<?php
require_once(__DIR__ . '/../../../config/koneksiDB.php');
require_once(__DIR__ . '/../../../classes/KategoriKlinis.php');

// ✅ pastikan koneksi $conn tersedia
if (!isset($conn) || !$conn) {
    $db = new DBConnection();
    $conn = $db->getConnection();
}

$kategori = new KategoriKlinis($conn);

// ✅ sesuaikan nama properti id dengan yang ada di class
$kategori->id_kategori_klinis = $_GET['id'];

// ✅ panggil fungsi readById dengan parameter id
$data = $kategori->readById($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ✅ sesuaikan nama properti dengan class KategoriKlinis
    $kategori->nama_kategori_klinis = $_POST['nama_kategori'];
    $kategori->deskripsi = $_POST['deskripsi'];

    if ($kategori->update()) {
        header("Location: Datakategoriklinis.php");
        exit;
    }
}
?>
<form method="POST">
    <h3>Edit Kategori Klinis</h3>
    <label>Nama Kategori:</label><br>
    <!-- ✅ ubah ke nama kolom yang benar di database -->
    <input type="text" name="nama_kategori" value="<?= htmlspecialchars($data['nama_kategori_klinis']) ?>" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi"><?= htmlspecialchars($data['deskripsi']) ?></textarea><br><br>

    <button type="submit">Update</button>
</form>

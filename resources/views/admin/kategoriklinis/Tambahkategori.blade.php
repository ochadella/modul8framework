<?php
require_once(__DIR__ . '/../../../config/koneksiDB.php');
require_once(__DIR__ . '/../../../classes/KategoriKlinis.php');

global $conn; // ✅ Tambahkan ini supaya variabel $conn dari koneksiDB.php dikenali

$kategori = new KategoriKlinis($conn);

// variabel default (biar form tetap bisa tampil walau belum ada POST)
$id = "";
$nama_kategori = "";
$deskripsi = "";

// 🟡 Jika halaman dibuka dengan parameter ?id= (mode edit)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $kategori->readById($id);
    if ($data) {
        $nama_kategori = $data['nama_kategori_klinis'];
        $deskripsi = $data['deskripsi'];
    }
}

// 🟢 Jika form disubmit (baik tambah atau edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori->nama_kategori_klinis = $_POST['nama_kategori'];
    $kategori->deskripsi = $_POST['deskripsi'];

    // kalau ada hidden id → berarti mode edit
    if (!empty($_POST['id'])) {
        $kategori->id_kategori_klinis = $_POST['id'];
        if ($kategori->update()) {
            header("Location: Datakategoriklinis.php");
            exit;
        } else {
            echo "<script>alert('Gagal mengupdate data!');</script>";
        }
    } else {
        if ($kategori->create()) {
            header("Location: Datakategoriklinis.php");
            exit;
        } else {
            echo "<script>alert('Gagal menambah data!');</script>";
        }
    }
}
?>
<form method="POST">
    <h3><?= isset($_GET['id']) ? 'Edit Kategori Klinis' : 'Tambah Kategori Klinis' ?></h3>

    <!-- hidden id untuk mode edit -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

    <label>Nama Kategori:</label><br>
    <input type="text" name="nama_kategori" value="<?= htmlspecialchars($nama_kategori) ?>" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi"><?= htmlspecialchars($deskripsi) ?></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

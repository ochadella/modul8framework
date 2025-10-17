<?php
require_once(__DIR__ . '/../../../config/koneksiDB.php');

$db = new DBConnection();
$koneksi = $db->getConnection();

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['logged_in'] !== true) {
    header("Location: ../../interface/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_tindakan'])) {
    $kode_tindakan = $_POST['kode_tindakan'];
    $nama_tindakan = $_POST['nama_tindakan'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO tindakan (kode_tindakan, nama_tindakan, harga) VALUES ('$kode_tindakan', '$nama_tindakan', '$harga')";
    mysqli_query($koneksi, $query);
    header("Location: DataTindakan.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM tindakan WHERE id_tindakan='$id'");
    header("Location: DataTindakan.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM tindakan ORDER BY id_tindakan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tindakan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: #eef1f7;
        }

        /* Header bar atas */
        .header {
            background: #102f76;
            color: #fff;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
            color: #f9a01b;
        }
        .header nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 25px;
            font-weight: 500;
        }
        .header nav a:hover {
            color: #f9a01b;
        }

        /* Container utama */
        .container {
            width: 90%;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Judul di tengah */
        .title-container {
            text-align: center;
            margin-bottom: 25px;
        }

        h2 {
            color: #102f76;
            font-weight: bold;
            margin: 0 auto;
            border-bottom: 3px solid #f9a01b;
            padding-bottom: 8px;
            display: inline-block;
        }

        /* Tombol kembali */
        .back {
            display: inline-block;
            margin-bottom: 15px;
            color: #102f76;
            text-decoration: none;
            font-weight: bold;
        }
        .back:hover {
            color: #f9a01b;
        }

        /* Form tambah */
        .form-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            padding: 25px;
            margin-bottom: 25px;
        }

        .form-tambah {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .form-tambah input {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            width: 220px;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        .form-tambah input:focus {
            border-color: #102f76;
            box-shadow: 0 0 5px rgba(16,47,118,0.3);
            outline: none;
        }

        .form-tambah button {
            background: #f9a01b;
            border: none;
            color: #102f76;
            font-weight: bold;
            border-radius: 6px;
            padding: 10px 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .form-tambah button:hover {
            background: #102f76;
            color: #fff;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background: #102f76;
            color: white;
            padding: 12px;
            font-size: 14px;
            text-align: center;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: center;
            background-color: white;
            font-size: 14px;
        }

        tr:nth-child(even) td {
            background: #fafafa;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: 0.3s;
        }
        .btn-delete:hover {
            background: #b02a37;
        }
    </style>
<div class="header">
    <h1>🐾 Kode Tindakan</h1>
    <nav>
        <a href="../../../interface/dashboard.php">Dashboard</a>
        <a href="../datamaster.php">Data Master</a>
        <a href="../../../interface/login.php">Logout</a>
    </nav>
</div>

    <div class="container">
        <a href="../datamaster.php" class="back">← Kembali ke Data Master</a>
        
        <div class="title-container">
            <h2>Data Tindakan</h2>
        </div>

        <div class="form-card">
            <form method="POST" class="form-tambah">
                <input type="text" name="kode_tindakan" placeholder="Kode Tindakan" required>
                <input type="text" name="nama_tindakan" placeholder="Nama Tindakan" required>
                <input type="number" name="harga" placeholder="Harga (Rp)" required>
                <button type="submit" name="tambah_tindakan">Tambah</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Tindakan</th>
                    <th>Nama Tindakan</th>
                    <th>Harga (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['kode_tindakan']); ?></td>
                    <td><?= htmlspecialchars($row['nama_tindakan']); ?></td>
                    <td><?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="DataTindakan.php?hapus=<?= $row['id_tindakan']; ?>" onclick="return confirm('Hapus data ini?')">
                            <button class="btn-delete">Hapus</button>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

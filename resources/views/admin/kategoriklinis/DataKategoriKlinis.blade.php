<?php
require_once(__DIR__ . '/../../../config/koneksiDB.php');
require_once(__DIR__ . '/../../../classes/KategoriKlinis.php');

$kategori = new KategoriKlinis();

// ✅ Perbaikan kecil di bagian tambah kategori
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_kategori'])) {
    $nama = trim($_POST['nama_kategori']);
    $desk = trim($_POST['deskripsi']);

    if (!empty($nama) && !empty($desk)) {
        // Gunakan koneksi manual agar tidak error "private property"
        $conn = new mysqli("127.0.0.1", "root", "Konikulaposero25", "kuliah_wf_2025");
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO kategori_klinis (nama_kategori_klinis, deskripsi) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama, $desk);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    header("Location: DataKategoriKlinis.php");
    exit;
}

$result = $kategori->readAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori Klinis</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
        }

        /* ==== NAVBAR ==== */
        .navbar {
            background-color: #102f76;
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .navbar .logo {
            font-weight: 700;
            font-size: 20px;
            color: #f9a01b;
            text-decoration: none;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 25px;
            margin: 0;
            padding: 0;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }

        .navbar ul li a:hover {
            color: #f9a01b;
        }

        /* ==== CONTAINER & TABLE ==== */
        .container {
            max-width: 1300px;
            margin: 50px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            padding: 35px 45px;
        }

        h2 {
            color: #102f76;
            font-size: 26px;
            margin-bottom: 25px;
        }

        .top-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            color: white;
            text-decoration: none;
            transition: 0.25s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.12);
        }

        .add-btn {
            background: linear-gradient(90deg, #f9a01b, #ff9554);
        }

        .add-btn:hover {
            filter: brightness(0.9);
        }

        .back-btn {
            background: #6c757d;
        }

        .back-btn:hover {
            background: #5a6268;
        }

        /* Form input langsung */
        .form-inline {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .form-inline input {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 230px;
            font-size: 15px;
        }

        .form-inline button {
            background: #f9a01b;
            border: none;
            color: #102f76;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 20px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .form-inline button:hover {
            background: #102f76;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            font-size: 15px;
        }

        th {
            background: #102f76;
            color: #f9a01b;
            padding: 14px;
            text-align: left;
            font-size: 16px;
        }

        td {
            padding: 12px 14px;
            border-bottom: 1px solid #e9edf3;
        }

        tr:nth-child(even) td {
            background: #f8fbff;
        }

        tr:hover td {
            background: rgba(249, 160, 27, 0.08);
        }

        .action-btn {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .edit-btn {
            background-color: #ffc107;
            color: #1f1f1f;
        }

        .edit-btn:hover {
            background-color: #e0a800;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <!-- === NAVBAR === -->
    <nav class="navbar">
        <a href="../dashboard.php" class="logo">🏥 Kategori Klinis</a>
        <ul>
            <li><a href="../../../interface/dashboard.php">Dashboard</a></li>
            <li><a href="../datamaster.php">Data Master</a></li>
            <li><a href="../../../interface/login.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Data Kategori Klinis</h2>
        
        <div class="top-buttons">
            <!-- Form input langsung -->
            <form method="POST" class="form-inline">
                <input type="text" name="nama_kategori" placeholder="Nama Kategori" required>
                <input type="text" name="deskripsi" placeholder="Deskripsi" required>
                <button type="submit" name="tambah_kategori">Tambah</button>
            </form>

            <!-- Tombol kembali -->
            <a href="../DataMaster.php" class="btn back-btn">← Kembali</a>
        </div>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                $nama = $row['nama_kategori_klinis'] ?? ($row['nama_kategori'] ?? ($row['nama'] ?? ''));
                $desk = $row['deskripsi'] ?? ($row['keterangan'] ?? '');
                $id   = $row['idkategori_klinis'] ?? ($row['id_kategori'] ?? ($row['id'] ?? ''));

                echo "<tr>
                    <td>{$no}</td>
                    <td>{$nama}</td>
                    <td>{$desk}</td>
                    <td>
                        <a href='Editkategori.php?id={$id}'><button class='action-btn edit-btn'>✏️ Edit</button></a>
                        <a href='Hapuskategori.php?id={$id}' onclick='return confirm(\"Yakin hapus?\")'>
                            <button class='action-btn delete-btn'>🗑 Hapus</button>
                        </a>
                    </td>
                </tr>";
                $no++;
            }
            ?>
        </table>
    </div>
</body>
</html>

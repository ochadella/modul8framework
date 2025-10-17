<?php
session_start();
require_once __DIR__ . '/../../../config/koneksiDB.php';

// Cek apakah user login dan rolenya perawat
if (!isset($_SESSION['user']) || strtolower($_SESSION['user']['role']) !== 'perawat') {
    header('Location: ../../login.php');
    exit;
}

$db = new DBConnection();
$conn = $db->getConnection();

// 🔹 Query diperbaiki sesuai struktur tabel kamu
$query = "
    SELECT 
        rm.idrekam_medis,
        p.nama AS nama_hewan,
        pm.nama AS pemilik,
        u.nama AS dokter_pemeriksa,
        rm.anamnesa,
        rm.diagnosa,
        rm.temuan_klinis,
        r.tanggal_kunjungan AS tanggal_periksa
    FROM rekam_medis rm
    JOIN reservasi r ON rm.idreservasi_dokter = r.idreservasi
    JOIN pet p ON r.idhewan = p.idpet
    JOIN pemilik pm ON p.idpemilik = pm.idpemilik
    JOIN role_user ru ON rm.idrole_user = ru.idrole_user
    JOIN user u ON ru.iduser = u.iduser
    ORDER BY rm.idrekam_medis DESC
";

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pemeriksaan | RSHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #142a46, #102f76, #f9a01b);
            margin: 0;
            padding: 0;
            color: #142a46;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar span {
            font-weight: bold;
            color: #102f76;
            font-size: 18px;
        }

        .navbar a {
            text-decoration: none;
            color: #102f76;
            font-weight: 600;
            margin-left: 20px;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: #f9a01b;
        }

        .container {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 1100px;
        }

        h2 {
            color: #f9a01b;
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
        }

        table th {
            background-color: #102f76;
            color: #fff;
            padding: 12px;
            text-align: center;
            font-weight: 600;
        }

        table td {
            padding: 10px 12px;
            text-align: center;
            color: #142a46;
        }

        tr:hover td {
            background-color: rgba(249, 160, 27, 0.1);
        }

        .btn-back {
            background: linear-gradient(to right, #f9a01b, #ff9554);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-back:hover {
            opacity: 0.9;
            transform: translateY(-3px);
        }

        .btn-edit {
            background-color: #0e3a91;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
            margin: 0 3px;
            display: inline-block;
        }

        .btn-edit:hover {
            background-color: #1b56cc;
            transform: translateY(-2px);
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
            margin: 0 3px;
            display: inline-block;
        }

        .btn-delete:hover {
            background-color: #b52a36;
            transform: translateY(-2px);
        }

        .footer-note {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: #142a46;
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <span>🩺 Data Pemeriksaan Hewan RSHP</span>
        <span>
            <a href="../../../interface/dashboard_perawat.php"><i class="bi bi-house-door"></i> Dashboard</a>
            <a href="../../../interface/login.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </span>
    </nav>

    <div class="container">
        <h2>📋 Daftar Pemeriksaan</h2>
        <div class="text-end mb-3">
            <a href="../../../interface/dashboard_perawat.php" class="btn-back">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
            </a>
        </div>

        <?php if ($result && $result->num_rows > 0): ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Hewan</th>
                        <th>Pemilik</th>
                        <th>Dokter Pemeriksa</th>
                        <th>Anamnesa</th>
                        <th>Diagnosa</th>
                        <th>Temuan Klinis</th>
                        <th>Tanggal Periksa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_hewan']) ?></td>
                            <td><?= htmlspecialchars($row['pemilik']) ?></td>
                            <td><?= htmlspecialchars($row['dokter_pemeriksa']) ?></td>
                            <td><?= htmlspecialchars($row['anamnesa']) ?></td>
                            <td><?= htmlspecialchars($row['diagnosa']) ?></td>
                            <td><?= htmlspecialchars($row['temuan_klinis']) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($row['tanggal_periksa'])) ?></td>
                            <td>
                                <a href="../pemeriksaan/editpemeriksaan.php?id=<?= $row['idrekam_medis'] ?>" class="btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="hapus_pemeriksaan.php?id=<?= $row['idrekam_medis'] ?>" 
                                   class="btn-delete" 
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center text-muted">Belum ada data pemeriksaan.</p>
        <?php endif; ?>

        <div class="footer-note">RS Hewan Peliharaan — Melayani dengan Sepenuh Hati 💙</div>
    </div>

</body>
</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// cek login
if (!isset($_SESSION['user']) || $_SESSION['user']['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "/../../../config/koneksiDB.php"; 
require_once __DIR__ . "/../../../classes/user.php";      

// Buat objek User
$db = new DBConnection();
$user = new User($db);

// =============================================
// ✏️ Tambahan: proses edit user
// =============================================
if (isset($_POST['edit_id'])) {
    $iduser = (int)$_POST['edit_id'];
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);

    $conn = $db->getConnection();
    $stmt = $conn->prepare("UPDATE user SET nama = ?, email = ?, role = ? WHERE iduser = ?");
    $stmt->bind_param("sssi", $nama, $email, $role, $iduser);

    if ($stmt->execute()) {
        echo "<script>alert('Data user berhasil diperbarui!'); window.location.href='datauser.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui data user!'); window.location.href='datauser.php';</script>";
        exit;
    }
}

// Ambil semua user
$result = $user->getAll();
$users = $result['data'] ?? [];

// =============================================
// 🔑 Tambahan: proses reset password
// =============================================
if (isset($_GET['reset_id'])) {
    $iduser = (int)$_GET['reset_id'];
    $newPassword = "123456"; // password default baru
    $hashed = password_hash($newPassword, PASSWORD_DEFAULT);

    $conn = $db->getConnection();
    $stmt = $conn->prepare("UPDATE user SET password = ? WHERE iduser = ?");
    $stmt->bind_param("si", $hashed, $iduser);

    if ($stmt->execute()) {
        echo "<script>alert('Password berhasil di-reset ke: 123456'); window.location.href='datauser.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal mereset password!'); window.location.href='datauser.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }
        .navbar {
            background: #102f76;
            padding: 15px 25px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }
        .navbar span {
            font-size: 18px;
            font-weight: bold;
            color: #f9a01b;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
            transition: 0.3s;
        }
        .navbar a:hover {
            color: #f9a01b;
        }
        .content {
            padding: 30px;
        }
        h2 {
            margin-bottom: 20px;
            color: #102f76;
        }
        .btn {
            display: inline-block;
            padding: 8px 14px;
            margin: 0;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            color: white;
            transition: 0.3s;
        }
        .btn-back { background: #6c757d; }
        .btn-add { background: linear-gradient(to right, #f9a01b, #ff9554); }
        .btn-edit { background: #ffc107; color: black; }
        .btn-reset { background: #17a2b8; }
        .btn:hover { opacity: 0.9; }
        .table-container {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            overflow-x: auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 850px;
            table-layout: fixed;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        th:nth-child(1), td:nth-child(1) { width: 8%; }
        th:nth-child(2), td:nth-child(2) { width: 20%; }
        th:nth-child(3), td:nth-child(3) { width: 27%; }
        th:nth-child(4), td:nth-child(4) { width: 31%; }
        th {
            background: #102f76;
            color: #fff;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover td {
            background: rgba(249,160,27,0.08);
        }
        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <span>📋 Data User</span>
        <span>
            <a href="../../../interface/dashboard.php">Dashboard</a>
            <a href="../datamaster.php">Data Master</a>
            <a href="../../../interface/login.php">Logout</a>
        </span>
    </div>

    <div class="content">
        <h2>Daftar User</h2>

        <div style="margin-bottom: 15px;">
            <a href="../datamaster.php" class="btn btn-back">← Kembali</a>
            <a href="tambahuser.php" class="btn btn-add">+ Tambah User</a>
        </div>

        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
                <?php if (!empty($users)): ?>
                    <?php foreach($users as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['iduser']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['role'] ?? '-') ?></td>
                        <td class="actions">
                            <button onclick="editUser(<?= $row['iduser'] ?>, '<?= htmlspecialchars($row['nama']) ?>', '<?= htmlspecialchars($row['email']) ?>', '<?= htmlspecialchars($row['role'] ?? '') ?>')" class="btn btn-edit">✏ Edit</button>
                            <a href="datauser.php?reset_id=<?= $row['iduser'] ?>" class="btn btn-reset" onclick="return confirm('Reset password user ini ke 123456?')">🔑 Reset</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center; color:#666;">Belum ada data user</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <!-- Form Edit (hidden) -->
    <form method="POST" id="editForm" style="display:none;">
        <input type="hidden" name="edit_id" id="edit_id">
        <input type="hidden" name="nama" id="edit_nama">
        <input type="hidden" name="email" id="edit_email">
        <input type="hidden" name="role" id="edit_role">
    </form>

    <script>
        function editUser(id, nama, email, role) {
            const newNama = prompt("Ubah Nama:", nama);
            if (newNama === null) return;
            const newEmail = prompt("Ubah Email:", email);
            if (newEmail === null) return;
            const newRole = prompt("Ubah Role:", role);
            if (newRole === null) return;

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama').value = newNama;
            document.getElementById('edit_email').value = newEmail;
            document.getElementById('edit_role').value = newRole;

            document.getElementById('editForm').submit();
        }
    </script>
</body>
</html>

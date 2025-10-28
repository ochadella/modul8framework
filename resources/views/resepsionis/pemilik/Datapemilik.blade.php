<?php
// ✅ Hindari error saat variabel belum didefinisikan
$editData = $editData ?? [];
$rows = $rows ?? [];

// ✅ Jika data dari DB berbentuk objek (stdClass), ubah ke array biar bisa dipanggil seperti $r['nama']
if (!empty($rows) && is_object($rows[0] ?? null)) {
    $rows = json_decode(json_encode($rows), true);
}
if (is_object($editData)) {
    $editData = json_decode(json_encode($editData), true);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi Pemilik</title>
  <style>
    body{margin:0;font-family:Arial,sans-serif;background:#f4f6f9;}
    .navbar{background:#102f76;padding:15px 25px;color:#fff;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 6px rgba(0,0,0,0.3);}
    .navbar span{font-size:18px;font-weight:bold;color:#f9a01b;}
    .navbar a{color:#fff;text-decoration:none;margin-left:20px;font-weight:bold;transition:0.3s;}
    .navbar a:hover{color:#f9a01b;}
    .content{padding:30px;}
    h2{margin-bottom:20px;color:#102f76;}
    .btn{display:inline-block;padding:8px 14px;margin:4px;border-radius:6px;font-size:14px;font-weight:bold;text-decoration:none;color:white;transition:0.3s;border:none;cursor:pointer;}
    .btn-back{background:#6c757d;}
    .btn-add{background:linear-gradient(to right,#f9a01b,#ff9554);}
    .btn-edit{background:#ffc107;color:black;}
    .btn-delete{background:#dc3545;}
    .btn:hover{opacity:0.9;}
    .form-card,.table-container{background:#fff;border-radius:12px;padding:20px;box-shadow:0 4px 12px rgba(0,0,0,0.15);margin-bottom:20px;}
    input{width:100%;padding:8px;margin:8px 0;border:1px solid #ccc;border-radius:6px;}
    table{border-collapse:collapse;width:100%;min-width:700px;}
    th{background:#102f76;color:#f9a01b;padding:12px;text-align:left;}
    td{padding:10px;border-bottom:1px solid #ddd;}
    tr:hover td{background:rgba(249,160,27,0.08);}
    .actions{white-space:nowrap;}
  </style>
</head>
<body>
  <div class="navbar">
      <span>👤 Registrasi Pemilik</span>
      <!-- ✅ path tetap sama -->
      <span>
        <a href="../../../interface/dashboard.php">Dashboard</a>
        <a href="../../../auth/login">Logout</a>
      </span>
  </div>
  <div class="content">
      <h2>Registrasi Pemilik</h2>
      <div class="form-card">
          <form method="post">
              <input type="hidden" name="idpemilik" value="<?= $editData['idpemilik'] ?? '' ?>">
              <label>Nama:</label><input type="text" name="nama_pemilik" value="<?= $editData['nama'] ?? '' ?>" required>
              <label>No Telp:</label><input type="text" name="no_telp" value="<?= $editData['no_wa'] ?? '' ?>" required>
              <label>Alamat:</label><input type="text" name="alamat" value="<?= $editData['alamat'] ?? '' ?>" required>
              <?php if (!empty($editData)): ?>
                <button type="submit" name="update" class="btn btn-edit">Update</button>
                <a href="Datapemilik" class="btn btn-delete">Batal</a>
              <?php else: ?>
                <button type="submit" name="tambah" class="btn btn-add">Tambah</button>
                <a href="{{ route('admin.datamaster') }}" class="btn btn-back">← Kembali</a>
              <?php endif; ?>
          </form>
      </div>
      <div class="table-container">
          <table>
              <tr><th>ID</th><th>Nama</th><th>No Telp</th><th>Alamat</th><th>Aksi</th></tr>
              <?php if (!empty($rows)): foreach($rows as $r): ?>
              <tr>
                  <td><?= htmlspecialchars($r['idpemilik'] ?? '') ?></td>
                  <td><?= htmlspecialchars($r['nama'] ?? '') ?></td>
                  <td><?= htmlspecialchars($r['no_wa'] ?? '') ?></td>
                  <td><?= htmlspecialchars($r['alamat'] ?? '') ?></td>
                  <td class="actions">
                      <a href="Datapemilik.php?edit=<?= $r['idpemilik'] ?>" class="btn btn-edit">✏ Edit</a>
                      <a href="Datapemilik.php?delete=<?= $r['idpemilik'] ?>" class="btn btn-delete" onclick="return confirm('Hapus data ini?')">🗑 Hapus</a>
                  </td>
              </tr>
              <?php endforeach; else: ?>
              <tr><td colspan="5" style="text-align:center;color:#666;">Belum ada data</td></tr>
              <?php endif; ?>
          </table>
      </div>
  </div>
</body>
</html>

<?php
if (!isset($editData)) $editData = null;
if (!isset($rows)) $rows = [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Jenis Hewan</title>
  <style>
    body { margin:0; font-family:Arial,sans-serif; background:#f4f6f9; }
    /* Navbar */
    .navbar { background:#102f76; padding:15px 25px; color:#fff; display:flex; justify-content:space-between; align-items:center; box-shadow:0 2px 6px rgba(0,0,0,0.3); }
    .navbar span { font-size:18px; font-weight:bold; color:#f9a01b; }
    .navbar a { color:#fff; text-decoration:none; margin-left:20px; font-weight:bold; transition:0.3s; }
    .navbar a:hover { color:#f9a01b; }
    /* Content */
    .content { padding:30px; }
    h2 { margin-bottom:20px; color:#102f76; }
    /* Buttons */
    .btn { display:inline-block; padding:8px 14px; margin:4px; border-radius:6px; font-size:14px; font-weight:bold; text-decoration:none; color:white; transition:0.3s; border:none; cursor:pointer; }
    .btn-back { background:#6c757d; }
    .btn-add { background:linear-gradient(to right,#f9a01b,#ff9554); }
    .btn-edit { background:#ffc107; color:black; }
    .btn-delete { background:#dc3545; }
    .btn:hover { opacity:0.9; }
    /* Form */
    .form-card { background:#fff; border-radius:12px; padding:20px; box-shadow:0 4px 12px rgba(0,0,0,0.15); margin-bottom:20px; max-width:400px; }
    label { font-weight:bold; }
    input { width:100%; max-width: 380px; padding:8px; margin:8px 0; border:1px solid #ccc; border-radius:6px; }
    /* Table */
    .table-container { background:#fff; border-radius:12px; padding:20px; box-shadow:0 4px 12px rgba(0,0,0,0.15); overflow-x:auto; }
    table { border-collapse:collapse; width:100%; min-width:600px; }
    th { background:#102f76; color:#f9a01b; padding:12px; text-align:left; }
    td { padding:10px; border-bottom:1px solid #ddd; }
    tr:hover td { background:rgba(249,160,27,0.08); }
    .actions { white-space:nowrap; }
  </style>
</head>
<body>
  <!-- Navbar -->
    <div class="navbar">
        <span>🐾 Jenis Hewan</span>
        <span>
            <a href="../../../interface/dashboard.php">Dashboard</a>
            <a href="../../admin/datamaster.php">Data Master</a>
            <a href="../../../interface/login.php">Logout</a>
        </span>
    </div>

  <!-- Content -->
  <div class="content">
      <h2>Data Jenis Hewan</h2>

      <!-- Form Tambah/Edit -->
      <div class="form-card">
          <form method="post" action="">
              @csrf
              <input type="hidden" name="id" value="<?= $editData->idjenis_hewan ?? '' ?>">
              <label>Nama Jenis:</label>
              <input type="text" name="nama" value="<?= $editData->nama_jenis_hewan ?? '' ?>" required>
              <?php if ($editData): ?>
                <button type="submit" name="update" class="btn btn-edit">Update</button>
                <a href="{{ route('dokter.jenis.data') }}" class="btn btn-delete">Batal</a>
              <?php else: ?>
                <button type="submit" name="tambah" class="btn btn-add">Tambah</button>
                <a href="../../admin/datamaster" class="btn btn-back">← Kembali</a>
              <?php endif; ?>
          </form>
      </div>

      <!-- Tabel -->
      <div class="table-container">
          <table>
            <tr><th>ID</th><th>Nama Jenis</th><th>Aksi</th></tr>
            <?php if (!empty($rows)): foreach ($rows as $r): ?>
              <tr>
                <td><?= $r->idjenis_hewan ?></td>
                <td><?= $r->nama_jenis_hewan ?></td>
                <td class="actions">
                  <a href="{{ route('dokter.jenis.edit', $r->idjenis_hewan) }}" class="btn btn-edit">✏ Edit</a>
                  <a href="{{ route('dokter.jenis.delete', $r->idjenis_hewan) }}" class="btn btn-delete" onclick="return confirm('Hapus data ini?')">🗑 Hapus</a>
                </td>
              </tr>
            <?php endforeach; else: ?>
              <tr><td colspan="3" style="text-align:center; color:#666;">Belum ada data</td></tr>
            <?php endif; ?>
          </table>
      </div>
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Ras Hewan</title>
  <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f4f6f9;
    }
    /* Navbar */
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
    /* Content */
    .content {
        padding: 30px;
    }
    h2 {
        margin-bottom: 20px;
        color: #102f76;
    }
    /* Buttons */
    .btn {
        display: inline-block;
        padding: 8px 14px;
        margin: 4px;
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
    .btn-delete { background: #dc3545; }
    .btn:hover { opacity: 0.9; }
    /* Form */
    .form-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        margin-bottom: 20px;
        max-width: 465px;
    }
    label { font-weight: bold; }
    select, input {
        width: 100%;
        max-width: 440px;
        padding: 8px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
    }
    /* Table */
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
        min-width: 700px;
    }
    th {
        background: #102f76;
        color: #f9a01b;
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
    .actions { white-space: nowrap; }
  </style>
</head>
<body>
  <!-- Navbar -->
  <div class="navbar">
      <span>🐕 Ras Hewan</span>
      <span>
          <a href="../../../../interface/dashboard.php">Dashboard</a>
          <a href="../../../admin/datamaster.php">Data Master</a>
          <a href="../../../../interface/login.php">Logout</a>
      </span>
  </div>

  <!-- Content -->
  <div class="content">
      <h2>Data Ras Hewan</h2>

      <!-- Form -->
      <div class="form-card">
          <form method="POST" action="{{ $editData ? route('dokter.ras.update', $editData->idras_hewan) : route('dokter.ras.store') }}">
              @csrf
              <input type="hidden" name="id" value="{{ old('id', $editData->idras_hewan ?? '') }}">
              
              <label>Nama Ras:</label>
              <input type="text" name="nama_ras" value="{{ old('nama_ras', $editData->nama_ras ?? '') }}" required>
              
              <label>Jenis Hewan:</label>
              <select name="idjenis_hewan" required>
                <option value="">-- Pilih Jenis Hewan --</option>
                @foreach ($listJenis as $j)
                    <option value="{{ $j->idjenis_hewan }}" 
                        @if(isset($editData) && $editData->idjenis_hewan == $j->idjenis_hewan) selected @endif>
                        {{ $j->nama_jenis_hewan }}
                    </option>
                @endforeach
              </select>
              
              @if (isset($editData))
                <button type="submit" class="btn btn-edit">Update</button>
                <a href="{{ route('dokter.ras.data') }}" class="btn btn-delete">Batal</a>
              @else
                <button type="submit" class="btn btn-add">Tambah</button>
                <a href="{{ route('admin.datamaster') }}" class="btn btn-back">← Kembali</a>
              @endif
          </form>
      </div>

      <!-- Tabel -->
      <div class="table-container">
          <table>
            <tr><th>ID</th><th>Nama Ras</th><th>Jenis Hewan</th><th>Aksi</th></tr>
            @if (count($listRas) > 0)
              @foreach ($listRas as $r)
              <tr>
                <td>{{ $r->idras_hewan }}</td>
                <td>{{ $r->nama_ras }}</td>
                <td>{{ $r->nama_jenis_hewan }}</td>
                <td class="actions">
                  <a href="{{ route('dokter.ras.edit', $r->idras_hewan) }}" class="btn btn-edit">✏ Edit</a>
                  <a href="{{ route('dokter.ras.delete', $r->idras_hewan) }}" class="btn btn-delete" onclick="return confirm('Hapus data ini?')">🗑 Hapus</a>
                </td>
              </tr>
              @endforeach
            @else
              <tr><td colspan="4" style="text-align:center; color:#666;">Belum ada data</td></tr>
            @endif
          </table>
      </div>
  </div>
</body>
</html>

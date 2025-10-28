<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Kategori</title>
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
table{border-collapse:collapse;width:100%;min-width:500px;}
th{background:#102f76;color:#f9a01b;padding:12px;text-align:left;}
td{padding:10px;border-bottom:1px solid #ddd;}
tr:hover td{background:rgba(249,160,27,0.08);}
.actions{white-space:nowrap;}
</style>
</head>
<body>
<div class="navbar">
    <span>📂 Kategori</span>
    <span>
        <a href="{{ route('interface.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.datamaster') }}">Data Master</a>
        <a href="{{ route('logout') }}">Logout</a>
    </span>
</div>

<div class="content">
    <h2>Data Kategori</h2>
    <div class="form-card">
        <form method="post" action="">
            @csrf
            <input type="hidden" name="idkategori" value="{{ $editData['idkategori'] ?? '' }}">
            <label>Nama Kategori:</label>
            <input type="text" name="nama_kategori" value="{{ $editData['nama_kategori'] ?? '' }}" required>

            @if (!empty($editData))
                <button type="submit" name="update" class="btn btn-edit">Update</button>
                <a href="{{ route('admin.kategori.data') }}" class="btn btn-delete">Batal</a>
            @else
                <button type="submit" name="tambah" class="btn btn-add">Tambah</button>
                <a href="{{ route('admin.datamaster') }}" class="btn btn-back">← Kembali</a>
            @endif
        </form>
    </div>

    <div class="table-container">
        <table>
            <tr><th>ID</th><th>Nama Kategori</th><th>Aksi</th></tr>
            @if (!empty($rows) && count($rows) > 0)
                @foreach($rows as $r)
                    <tr>
                        <td>{{ $r['idkategori'] }}</td>
                        <td>{{ $r['nama_kategori'] }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.kategori.data') }}?edit={{ $r['idkategori'] }}" class="btn btn-edit">✏ Edit</a>
                            <a href="{{ route('admin.kategori.data') }}?delete={{ $r['idkategori'] }}" class="btn btn-delete" onclick="return confirm('Hapus data ini?')">🗑 Hapus</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="3" style="text-align:center;color:#666;">Belum ada data</td></tr>
            @endif
        </table>
    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kode Tindakan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: #eef1f7;
        }

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

        .container {
            width: 90%;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

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
</head>
<body>

<div class="header">
    <h1>🐾 Kode Tindakan</h1>
    <nav>
        <a href="{{ url('dashboard_admin') }}">Dashboard</a>
        <a href="{{ url('admin/datamaster') }}">Data Master</a>
        <a href="{{ url('logout') }}">Logout</a>
    </nav>
</div>

<div class="container">
    <a href="{{ url('admin/datamaster') }}" class="back">← Kembali ke Data Master</a>
    
    <div class="title-container">
        <h2>Data Tindakan</h2>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div style="background:#d4edda;color:#155724;border:1px solid #c3e6cb;border-radius:6px;padding:10px;margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Tambah Data --}}
    <div class="form-card">
        <form method="POST" action="{{ route('admin.kodetindakan.store') }}" class="form-tambah">
            @csrf
            <input type="text" name="kode_tindakan" placeholder="Kode Tindakan" required>
            <input type="text" name="nama_tindakan" placeholder="Nama Tindakan" required>
            <input type="number" name="harga" placeholder="Harga (Rp)" required>
            <button type="submit">Tambah</button>
        </form>
    </div>

    {{-- Tabel Data --}}
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
            @php $no = 1; @endphp
            @forelse($rows as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->kode_tindakan ?? '-' }}</td>
                    <td>{{ $row->nama_tindakan ?? '-' }}</td>
                    <td>{{ number_format($row->harga ?? 0, 0, ',', '.') }}</td>
                    <td>
                        <form method="GET" action="{{ url('/admin/kodetindakan/delete/' . $row->id_tindakan) }}" onsubmit="return confirm('Hapus data ini?')">
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:#777;">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>

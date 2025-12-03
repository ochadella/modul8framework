<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
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
            max-width: 600px;
            margin: 40px auto;
        }
        h2 {
            margin-bottom: 20px;
            color: #102f76;
            text-align: center;
        }
        .form-card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .btn {
            display: inline-block;
            padding: 10px 16px;
            margin: 8px 4px 0 0;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            color: white;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }
        .btn-back { background: #6c757d; }
        .btn-save { background: linear-gradient(to right, #f9a01b, #ff9554); }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <span>➕ Tambah User</span>
        <span>
            <a href="{{ route('interface.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.datamaster') }}">Data Master</a>
            <a href="{{ route('login') }}">Logout</a>
        </span>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Form Tambah User</h2>
        <div class="form-card">
            @if (session('success'))
                <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('admin.user.store') }}">
                @csrf
                <label>Nama:</label>
                <input type="text" name="nama" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Password:</label>
                <input type="password" name="password" required>

                <button type="submit" class="btn btn-save">💾 Simpan</button>
                <a href="{{ route('admin.user.data') }}" class="btn btn-back">← Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>

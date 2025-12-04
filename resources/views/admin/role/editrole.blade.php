<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Role</title>

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* =====================================================
           🌟 BACKGROUND GRADIENT ELEGANT ORANGE SOFT
        ====================================================== */
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(
                180deg,
                #ffffff 0%,
                #fff7ef 20%,
                #ffe6bf 50%,
                #ffcf86 80%,
                #ffb74a 100%
            );
            background-attachment: fixed;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: radial-gradient(
                circle at bottom,
                rgba(255,170,40,0.22),
                transparent 60%
            );
            pointer-events: none;
            z-index: -1;
        }

        /* ================= NAVBAR (TOP) ================= */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: linear-gradient(135deg, #102f76 0%, #142a46 100%);
            color: #ffffff;
            padding: 14px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 18px rgba(0,0,0,0.25);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-logo {
            font-size: 30px;
            padding: 6px 10px;
            border-radius: 12px;
            background: rgba(255,255,255,0.08);
        }

        .brand-text-title {
            font-weight: 700;
            font-size: 18px;
        }

        .brand-text-sub {
            font-size: 12px;
            opacity: 0.8;
        }

        .nav-center {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 0 40px;
        }

        .nav-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            border-radius: 999px;
            padding: 6px 14px;
            min-width: 280px;
            max-width: 420px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .nav-search i {
            color: #102f76;
            font-size: 16px;
        }

        .nav-search input {
            border: none;
            outline: none;
            font-size: 13px;
            width: 100%;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #f9a01b;
            color: #102f76;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.35);
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
        }

        .user-role {
            font-size: 11px;
            opacity: 0.8;
        }

        .btn-logout {
            padding: 7px 14px;
            border-radius: 999px;
            border: none;
            background: #f5594b;
            color: #ffffff;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(245,89,75,0.5);
        }

        .btn-logout:hover {
            filter: brightness(1.05);
        }

        /* ================= CONTAINER CARD ================= */
        .container {
            margin: 40px auto;
            max-width: 600px;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            padding: 32px 36px 40px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
            animation: fadeIn 0.45s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header-icon {
            font-size: 48px;
            color: #102f76;
            background: #f9a01b33;
            padding: 18px;
            border-radius: 50%;
            display: inline-block;
        }

        .page-header h2 {
            margin-top: 15px;
            font-size: 28px;
            color: #102f76;
            font-weight: 800;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #102f76;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .required {
            color: #f5594b;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #f9a01b;
            box-shadow: 0 0 0 3px rgba(249,160,27,0.1);
        }

        .form-group input:disabled {
            background: #f5f5f5;
            cursor: not-allowed;
            color: #888;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
        }

        .btn-cancel {
            padding: 12px 20px;
            background: #6c757d;
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

        .btn-submit {
            padding: 12px 20px;
            background: linear-gradient(90deg, #f9a01b, #ffba4c);
            border: none;
            color: #102f76;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(249,160,27,0.35);
            transition: 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(249,160,27,0.45);
        }

        /* Alert Success/Error */
        .alert {
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>

@php
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'User';
    $displayRole = ucfirst($user->role ?? 'Admin');
    $initial     = strtoupper(mb_substr($displayName, 0, 1));
@endphp

<!-- TOP NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <i class="bi bi-hospital nav-logo"></i>
        <div>
            <div class="brand-text-title">Klinik Hewan</div>
            <div class="brand-text-sub">Panel Administrator</div>
        </div>
    </div>

    <div class="nav-center">
        <div class="nav-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari menu...">
        </div>
    </div>

    <div class="nav-right">
        <div class="user-info">
            <div class="user-avatar">{{ $initial }}</div>
            <div>
                <div class="user-name">{{ $displayName }}</div>
                <div class="user-role">{{ $displayRole }}</div>
            </div>
        </div>
        <a href="{{ route('logout') }}" class="btn-logout">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

<!-- FORM EDIT ROLE -->
<div class="container">
    
    <!-- Header -->
    <div class="page-header">
        <i class="bi bi-pencil-square page-header-icon"></i>
        <h2>Edit Role</h2>
    </div>

    <!-- Alert jika ada pesan -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Form Edit -->
    <form method="POST" action="{{ route('admin.role.update', $role->idrole) }}">
        @csrf

        <div class="form-group">
            <label><i class="bi bi-key-fill"></i> ID Role</label>
            <input type="text" value="{{ $role->idrole }}" disabled>
        </div>

        <div class="form-group">
            <label><i class="bi bi-tag-fill"></i> Nama Role <span class="required">*</span></label>
            <input 
                type="text" 
                name="nama_role" 
                value="{{ old('nama_role', $role->nama_role) }}" 
                required 
                placeholder="Contoh: Dokter, Perawat, Admin"
            >
        </div>

        <div class="form-group">
            <label><i class="bi bi-toggle-on"></i> Status <span class="required">*</span></label>
            <select name="status" required>
                <option value="1" {{ $role->status == 1 ? 'selected' : '' }}>✅ Aktif</option>
                <option value="0" {{ $role->status == 0 ? 'selected' : '' }}>❌ Nonaktif</option>
            </select>
        </div>

        <div class="modal-buttons">
            <a href="{{ route('admin.role.manajemen') }}" class="btn-cancel">
                <i class="bi bi-x-circle"></i> Batal
            </a>
            <button type="submit" class="btn-submit">
                <i class="bi bi-check-circle"></i> Update Role
            </button>
        </div>
    </form>
</div>

</body>
</html>
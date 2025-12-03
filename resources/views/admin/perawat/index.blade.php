<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Perawat</title>

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
            background: radial-gradient(circle at bottom, rgba(255,170,40,0.22), transparent 60%);
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

        /* ================= LAYOUT: SIDEBAR + MAIN ================= */
        .layout {
            max-width: 1400px;
            margin: 24px auto 40px;
            display: flex;
            gap: 22px;
        }

        /* ---------- SIDEBAR ---------- */
        .sidebar {
            width: 230px;
            background: linear-gradient(180deg, #102f76 0%, #142a46 100%);
            border-radius: 18px;
            padding: 20px 16px 24px;
            color: #ffffff;
            box-shadow: 0 12px 30px rgba(0,0,0,0.35);
        }

        .sidebar-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            margin-bottom: 18px;
            padding: 4px 6px 10px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .sidebar-title i {
            font-size: 18px;
            padding: 6px;
            border-radius: 10px;
            background: rgba(255,255,255,0.1);
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-top: 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 10px;
            color: #e6efff;
            font-size: 13px;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .sidebar-link i {
            font-size: 16px;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(249,160,27,0.16);
            color: #ffffff;
        }

        .sidebar-section {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.6;
            margin: 10px 4px 4px;
        }

        /* ---------- MAIN AREA ---------- */
        .main-area {
            flex: 1;
        }

        /* ================= CENTERED PAGE HEADER ================= */
        .page-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .page-header-icon {
            font-size: 54px;
            color: #102f76;
            background: #f9a01b33;
            padding: 20px;
            border-radius: 50%;
        }

        .page-header h1 {
            margin-top: 18px;
            font-size: 34px;
            color: #102f76;
            font-weight: 800;
        }

        .page-header p {
            margin-top: -6px;
            font-size: 15px;
            color: #3c3c3c;
        }

        /* ================= CONTAINER CARD ================= */
        .container {
            margin: 0 auto;
            max-width: 100%;
            background: rgba(255,255,255,0.78);
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

        /* ================= BUTTONS ================= */
        .btn-add {
            padding: 12px 20px;
            background: linear-gradient(90deg, #f9a01b, #ffba4c);
            color: #102f76;
            text-decoration: none;
            font-weight: 700;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(249,160,27,0.35);
        }

        .btn-back {
            margin-left: 10px;
            padding: 10px 18px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }

        /* ================= TABLE ================= */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 28px;
            overflow: hidden;
            border-radius: 14px;
            box-shadow: 0 10px 26px rgba(0,0,0,0.10);
        }

        th {
            background: linear-gradient(135deg, #102f76 0%, #142a46 100%);
            color: #f9a01b;
            padding: 15px;
            font-size: 16px;
            text-align: center !important;
        }

        td {
            padding: 14px;
            background: rgba(255,255,255,0.82);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            text-align: center !important;
            vertical-align: middle !important;
        }

        tr:hover td {
            background: rgba(249,160,27,0.13);
        }

        /* ================= STATUS BADGE ================= */
        .status-badge {
            padding: 6px 14px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 20px;
            display: inline-block;
        }

        .active-badge {
            background: #c3f7c3;
            color: #1d7a1d;
            border: 1px solid #8be88b;
        }

        .inactive-badge {
            background: #ffd3d3;
            color: #b71818;
            border: 1px solid #ff9a9a;
        }

        /* ================= ACTION ICONS ================= */
        .action-icons {
            display: flex;
            justify-content: center;
            gap: 16px;
            align-items: center;
        }

        .icon-btn {
            font-size: 22px;
            color: #102f76;
            cursor: pointer;
            text-decoration: none;
        }

        .icon-btn:hover {
            color: #f9a01b;
            transform: translateY(-2px);
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1100px) {
            .layout {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                display: flex;
                overflow-x: auto;
            }
            .sidebar-menu {
                flex-direction: row;
                flex-wrap: nowrap;
            }
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
            <input type="text" placeholder="Cari menu atau data perawat...">
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

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-title">
            <i class="bi bi-grid-fill"></i>
            <span>Data Master</span>
        </div>

        <div class="sidebar-menu">

            <div class="sidebar-section">Dashboard</div>
            <a href="{{ route('interface.dashboard') }}" class="sidebar-link">
                <i class="bi bi-speedometer2"></i><span>Dashboard</span>
            </a>

            <div class="sidebar-section">User & Staff</div>
            <a href="{{ route('admin.user.data') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i><span>Data User</span>
            </a>
            <a href="{{ route('admin.dokter.index') }}" class="sidebar-link">
                <i class="bi bi-stethoscope"></i><span>Data Dokter</span>
            </a>
            <a href="{{ route('admin.perawat.index') }}" class="sidebar-link active">
                <i class="bi bi-clipboard2-pulse"></i><span>Data Perawat</span>
            </a>
            <a href="{{ route('admin.resepsionis.index') }}" class="sidebar-link">
                <i class="bi bi-headset"></i><span>Data Resepsionis</span>
            </a>
            <a href="{{ route('admin.role.manajemen') }}" class="sidebar-link">
                <i class="bi bi-shield-lock-fill"></i><span>Manajemen Role</span>
            </a>

            <div class="sidebar-section">Master Data</div>
            <a href="{{ route('dokter.jenis.data') }}" class="sidebar-link">
                <i class="bi bi-ui-checks-grid"></i><span>Jenis Hewan</span>
            </a>
            <a href="{{ route('dokter.ras.data') }}" class="sidebar-link">
                <i class="bi bi-diagram-3-fill"></i><span>Ras Hewan</span>
            </a>
            <a href="{{ route('resepsionis.pemilik') }}" class="sidebar-link">
                <i class="bi bi-person-vcard-fill"></i><span>Data Pemilik</span>
            </a>
            <a href="{{ route('resepsionis.pet') }}" class="sidebar-link">
                <i class="bi bi-bag-heart-fill"></i><span>Data Pet</span>
            </a>
            <a href="{{ route('admin.kategori.data') }}" class="sidebar-link">
                <i class="bi bi-tags-fill"></i><span>Kategori</span>
            </a>
            <a href="{{ route('admin.kategoriklinis.data') }}" class="sidebar-link">
                <i class="bi bi-card-checklist"></i><span>Kategori Klinis</span>
            </a>
            <a href="{{ route('admin.kodetindakan.data') }}" class="sidebar-link">
                <i class="bi bi-code-square"></i><span>Kode Tindakan</span>
            </a>
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="main-area">

        <!-- HEADER TENGAH -->
        <div class="page-header">
            <i class="bi bi-clipboard2-pulse page-header-icon"></i>
            <h1>Data Perawat</h1>
            <p>Daftar perawat yang terdaftar dalam sistem.</p>
        </div>

        <!-- KONTEN UTAMA -->
        <div class="container">

            <a href="{{ route('admin.perawat.create') }}" class="btn-add">+ Tambah Perawat</a>
            <a href="{{ route('admin.datamaster') }}" class="btn-back">← Kembali</a>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @php $no = 1; @endphp
                    @foreach($perawat as $p)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->email }}</td>

                            <!-- STATUS BADGE -->
                            <td>
                                @if($p->status === 'aktif')
                                    <span class="status-badge active-badge">Active</span>
                                @else
                                    <span class="status-badge inactive-badge">Inactive</span>
                                @endif
                            </td>

                            <!-- ACTION ICONS -->
                            <td>
                                <div class="action-icons">
                                    <!-- EDIT -->
                                    <a class="icon-btn"
                                       href="{{ route('admin.perawat.edit', ['id' => $p->iduser]) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- RESET -->
                                    <a class="icon-btn"
                                       href="{{ route('admin.perawat.reset', ['id' => $p->iduser]) }}"
                                       onclick="return confirm('Reset password perawat ini?')">
                                        <i class="bi bi-key-fill"></i>
                                    </a>

                                    <!-- DELETE -->
                                    <a class="icon-btn"
                                       href="{{ route('admin.perawat.delete', ['id' => $p->iduser]) }}"
                                       onclick="return confirm('Hapus perawat ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div><!-- /container -->
    </div><!-- /main-area -->

</div><!-- /layout -->

</body>
</html>

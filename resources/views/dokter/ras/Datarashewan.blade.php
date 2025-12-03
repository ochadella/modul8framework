<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Ras Hewan</title>

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* =====================================================
           🌟 BACKGROUND GRADIENT ORANGE SOFT (SAMA PERSIS)
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

        /* ================= NAVBAR ================= */
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

        .nav-left { display: flex; align-items: center; gap: 12px; }
        .nav-logo {
            font-size: 30px; padding: 6px 10px; border-radius: 12px;
            background: rgba(255,255,255,0.08);
        }
        .brand-text-title { font-weight: 700; font-size: 18px; }
        .brand-text-sub { font-size: 12px; opacity: 0.8; }

        .nav-center {
            flex: 1; display: flex; justify-content: center; padding: 0 40px;
        }
        .nav-search {
            display: flex; align-items: center; gap: 8px;
            background: #ffffff; border-radius: 999px; padding: 6px 14px;
            min-width: 280px; max-width: 420px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        .nav-search i { color: #102f76; font-size: 16px; }
        .nav-search input {
            border: none; outline: none; font-size: 13px; width: 100%;
        }

        .nav-right { display: flex; align-items: center; gap: 16px; }
        .user-info { display: flex; align-items: center; gap: 10px; }

        .user-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: #f9a01b; color: #102f76; font-weight: 700;
            display: flex; justify-content: center; align-items: center;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.35);
        }

        .btn-logout {
            padding: 7px 14px; border-radius: 999px; border: none;
            background: #f5594b; color: #fff; font-size: 12px;
            font-weight: 600; text-decoration: none;
            box-shadow: 0 4px 12px rgba(245,89,75,0.5);
        }
        .btn-logout:hover { filter: brightness(1.05); }

        /* ================= LAYOUT WRAPPER ================= */
        .layout {
            max-width: 1400px;
            margin: 24px auto 40px;
            display: flex;
            gap: 22px;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 230px;
            background: linear-gradient(180deg, #102f76 0%, #142a46 100%);
            border-radius: 18px;
            padding: 20px 16px 24px;
            color: #ffffff;
            box-shadow: 0 12px 30px rgba(0,0,0,0.35);
        }
        .sidebar-title {
            display: flex; align-items: center; gap: 10px;
            font-weight: 700; margin-bottom: 18px;
            padding: 4px 6px 10px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }
        .sidebar-menu { display: flex; flex-direction: column; gap: 4px; margin-top: 6px; }
        .sidebar-link {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 10px; border-radius: 10px;
            color: #e6efff; font-size: 13px; text-decoration: none;
        }
        .sidebar-link:hover,
        .sidebar-link.active { background: rgba(249,160,27,0.16); color: #fff; }
        .sidebar-section {
            font-size: 11px; opacity: 0.6;
            text-transform: uppercase; margin: 10px 4px 4px;
        }

        /* ================= PAGE HEADER ================= */
        .main-area { flex: 1; }

        .page-header { text-align: center; margin-bottom: 20px; }
        .page-header-icon {
            font-size: 54px; color: #102f76;
            background: #f9a01b33; padding: 20px;
            border-radius: 50%;
        }
        .page-header h1 {
            margin-top: 18px; font-size: 34px;
            color: #102f76; font-weight: 800;
        }
        .page-header p { margin-top: -6px; font-size: 15px; color: #3c3c3c; }

        /* ================= CONTAINER ================= */
        .container {
            background: rgba(255,255,255,0.78);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            padding: 32px 36px 40px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
            animation: fadeIn 0.45s ease-in-out;
        }

        /* ================= BUTTONS ================= */
        .btn-add {
            padding: 12px 20px; border-radius: 10px;
            background: linear-gradient(90deg, #f9a01b, #ffba4c);
            color: #102f76; font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(249,160,27,0.35);
        }
        .btn-back {
            padding: 10px 18px; border-radius: 8px;
            background: #6c757d; color: white;
            text-decoration: none; margin-left: 8px;
        }

        /* ================= TABLE ================= */
        table {
            width: 100%; border-collapse: collapse;
            margin-top: 28px; border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(0,0,0,0.10);
        }
        th {
            background: linear-gradient(135deg, #102f76 0%, #142a46 100%);
            color: #f9a01b; padding: 15px; font-size: 16px;
            text-align: center !important;
        }
        td {
            padding: 14px; background: rgba(255,255,255,0.82);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            text-align: center !important;
        }
        tr:hover td { background: rgba(249,160,27,0.13); }

        .action-icons { display: flex; gap: 16px; justify-content: center; }
        .icon-btn {
            font-size: 22px; color: #102f76;
            text-decoration: none; cursor: pointer;
        }
        .icon-btn:hover { color: #f9a01b; transform: translateY(-2px); }

    </style>
</head>

<body>

@php
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'User';
    $displayRole = ucfirst($user->role ?? 'Admin');
    $initial     = strtoupper(mb_substr($displayName, 0, 1));
@endphp

<!-- NAVBAR -->
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
            <input type="text" placeholder="Cari data ras hewan...">
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

<!-- LAYOUT -->
<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-title">
            <i class="bi bi-grid-fill"></i><span>Data Master</span>
        </div>

        <div class="sidebar-menu">
            <div class="sidebar-section">Dashboard</div>
            <a href="{{ route('interface.dashboard') }}" class="sidebar-link">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="sidebar-section">User & Staff</div>
            <a href="{{ route('admin.user.data') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i> Data User
            </a>
            <a href="{{ route('admin.dokter.index') }}" class="sidebar-link">
                <i class="bi bi-stethoscope"></i> Data Dokter
            </a>
            <a href="{{ route('admin.perawat.index') }}" class="sidebar-link">
                <i class="bi bi-clipboard2-pulse"></i> Data Perawat
            </a>
            <a href="{{ route('admin.resepsionis.index') }}" class="sidebar-link">
                <i class="bi bi-headset"></i> Data Resepsionis
            </a>
            <a href="{{ route('admin.role.manajemen') }}" class="sidebar-link">
                <i class="bi bi-shield-lock-fill"></i> Manajemen Role
            </a>

            <div class="sidebar-section">Master Data</div>
            <a href="{{ route('dokter.jenis.data') }}" class="sidebar-link">
                <i class="bi bi-ui-checks-grid"></i> Jenis Hewan
            </a>
            <a href="{{ route('dokter.ras.data') }}" class="sidebar-link active">
                <i class="bi bi-diagram-3-fill"></i> Ras Hewan
            </a>
            <a href="{{ route('resepsionis.pemilik') }}" class="sidebar-link">
                <i class="bi bi-person-vcard-fill"></i> Data Pemilik
            </a>
            <a href="{{ route('resepsionis.pet') }}" class="sidebar-link">
                <i class="bi bi-bag-heart-fill"></i> Data Pet
            </a>
            <a href="{{ route('admin.kategori.data') }}" class="sidebar-link">
                <i class="bi bi-tags-fill"></i> Kategori
            </a>
            <a href="{{ route('admin.kategoriklinis.data') }}" class="sidebar-link">
                <i class="bi bi-card-checklist"></i> Kategori Klinis
            </a>
            <a href="{{ route('admin.kodetindakan.data') }}" class="sidebar-link">
                <i class="bi bi-code-square"></i> Kode Tindakan
            </a>
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="main-area">

        <!-- HEADER -->
        <div class="page-header">
            <i class="bi bi-diagram-3-fill page-header-icon"></i>
            <h1>Data Ras Hewan</h1>
            <p>Daftar ras hewan yang terdaftar dalam sistem.</p>
        </div>

        <!-- CONTAINER -->
        <div class="container">

            <!-- BUTTONS -->
            <a href="{{ route('dokter.ras.create') }}" class="btn-add">+ Tambah Ras Hewan</a>
            <a href="{{ route('admin.datamaster') }}" class="btn-back">← Kembali</a>

            <!-- TABLE -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Ras</th>
                        <th>Jenis Hewan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($listRas as $r)
                        <tr>
                            <td>{{ $r->idras_hewan }}</td>
                            <td>{{ $r->nama_ras }}</td>
                            <td>{{ $r->nama_jenis_hewan }}</td>
                            <td>
                                <div class="action-icons">
                                    <a class="icon-btn" href="{{ route('dokter.ras.edit', $r->idras_hewan) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a class="icon-btn"
                                        href="{{ route('dokter.ras.delete', $r->idras_hewan) }}"
                                        onclick="return confirm('Hapus data ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color:#555;">
                                Belum ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div><!-- container -->

    </div><!-- main-area -->
</div><!-- layout -->

</body>
</html>

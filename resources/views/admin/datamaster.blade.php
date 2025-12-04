<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master</title>

    <!-- ICONS & CHART.JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        /* ================= LAYOUT: SIDEBAR + MAIN ================= */
        .layout {
            max-width: 1420px;
            margin: 24px auto 40px;
            display: flex;
            gap: 22px;
        }

        /* ---------- SIDEBAR (SAMA PERSIS SEPERTI DATA USER) ---------- */
        .sidebar {
            width: 215px;
            border-radius: 24px;
            background: linear-gradient(180deg, #102f76 0%, #142a46 100%);
            color: #fff;
            box-shadow: 0 18px 38px rgba(0,0,0,0.35);
            padding: 26px 22px 20px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
            cursor: pointer;
            padding: 0;
            border-radius: 12px;
            transition: 0.25s ease;
        }

        .sidebar-header:hover {
            background: rgba(255,255,255,0.08);
        }

        .sidebar-header-icon {
            width: 42px;
            height: 42px;
            border-radius: 18px;
            background: rgba(250, 177, 64, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .sidebar-header-title {
            display: flex;
            flex-direction: column;
            font-size: 18px;
            font-weight: 700;
        }

        .sidebar-header-sub {
            font-size: 12px;
            opacity: .8;
            font-weight: 500;
        }

        .sidebar-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.18);
            margin: 8px 0 6px;
        }

        .sidebar-section-title {
            font-size: 11px;
            letter-spacing: 1px;
            font-weight: 700;
            text-transform: uppercase;
            color: rgba(255,255,255,0.65);
            margin-top: 6px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 12px;
            color: #e9f1ff;
            font-size: 14px;
            transition: 0.25s ease;
            text-decoration: none;
        }

        .sidebar-link i {
            font-size: 18px;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,0.10);
            transform: translateX(3px);
        }

        .sidebar-link.active {
            background: rgba(18,25,55,0.85);
            box-shadow: 0 10px 24px rgba(0,0,0,0.45);
        }

        .sidebar-bottom {
            margin-top: auto;
            font-size: 11px;
            opacity: .7;
            text-align: center;
            padding-top: 8px;
        }

        /* ---------- MAIN AREA ---------- */
        .main-area {
            flex: 1;
        }

        /* ================= CONTENT ================= */
        .content {
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

        .page-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .page-header h2 {
            color: #102f76;
            font-size: 28px;
            font-weight: 800;
            margin: 0;
            display: inline-block;
            padding-bottom: 6px;
            position: relative;
        }

        .page-header h2::after {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            width: 60%;
            height: 4px;
            background: linear-gradient(90deg, #f9a01b, #ffbb56);
            border-radius: 20px;
        }

        .page-header p {
            margin-top: 12px;
            color: #555;
            font-size: 14px;
        }

        /* SUMMARY CARDS */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 26px;
        }

        .card {
            padding: 18px 20px;
            border-radius: 18px;
            box-shadow: 0 9px 20px rgba(0,0,0,0.14);
            color: #fff;
            background: radial-gradient(circle at top left, #f9a01b 0%, #b76b10 35%, #102f76 100%);
            background-size: 170% 170%;
            animation: cardGradient 7s ease infinite;
            position: relative;
            overflow: hidden;
        }

        .card::after {
            content: "";
            position: absolute;
            right: -40px;
            top: -40px;
            width: 110px;
            height: 110px;
            background: rgba(255,255,255,0.12);
            border-radius: 40px;
        }

        .card h3 {
            margin: 0 0 6px;
            font-size: 16px;
        }

        .card p {
            margin: 2px 0 0;
            font-size: 24px;
            font-weight: 800;
        }

        @keyframes cardGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* CHARTS */
        .chart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 26px;
            margin-top: 34px;
        }

        .chart-box {
            flex: 1;
            min-width: 320px;
            background: #ffffff;
            padding: 18px 20px 20px;
            border-radius: 18px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.12);
            height: 360px;
            display: flex;
            flex-direction: column;
        }

        .chart-box h3 {
            margin: 0;
            color: #102f76;
            font-size: 18px;
            font-weight: 700;
            text-align: center;
        }

        .chart-box small {
            color: #666;
            text-align: center;
            margin-top: 4px;
            margin-bottom: 10px;
            font-size: 12px;
        }

        .chart-box canvas {
            flex: 1;
        }

        /* ACTIVITY */
        .activity {
            margin-top: 34px;
        }

        .activity h3 {
            color: #102f76;
            margin-bottom: 12px;
            font-size: 18px;
        }

        .activity ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .activity li {
            background: #ffffff;
            margin-bottom: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
            font-size: 14px;
            color: #333;
        }

        /* FLOATING QUICK ACTIONS */
        .quick-actions {
            position: fixed;
            bottom: 28px;
            right: 32px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 5;
        }

        .quick-actions a {
            background: linear-gradient(135deg, #3562cdff , #142a46);
            color: #f6b24c;
            font-weight: 700;
            padding: 10px 20px;
            border-radius: 999px;
            text-decoration: none;
            box-shadow: 0 6px 14px rgba(0,0,0,0.25);
            font-size: 13px;
        }

        .quick-actions a:hover {
            background: #f9a01b;
            color: #102f76;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1100px) {
            .layout {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
            }
            .sidebar-menu {
                flex-direction: row;
                flex-wrap: nowrap;
            }
            .sidebar-section-title {
                display: none;
            }
        }

        /* ========== NOTIF MODAL ========== */
        #notifModal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        #notifBox {
            background: #fff;
            padding: 18px 22px;
            border-radius: 16px;
            width: 340px;
            max-height: 60%;
            overflow-y: auto;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
        }
    </style>
</head>
<body>

@php
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'User';
    $displayRole = ucfirst($user->role ?? 'Admin');
    $initial = strtoupper(mb_substr($displayName, 0, 1));
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
            <input type="text" placeholder="Cari menu atau data...">
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
        <a href="{{ route('admin.datamaster') }}" style="text-decoration: none; color: inherit;">
            <div class="sidebar-header">
                <div class="sidebar-header-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>
                <div>
                    <div class="sidebar-header-title">Data Master</div>
                    <div class="sidebar-header-sub">Menu administrasi sistem</div>
                </div>
            </div>
        </a>

        <hr class="sidebar-divider">

        <div class="sidebar-section-title">Dashboard</div>
        <div class="sidebar-menu">
            <a href="{{ route('interface.dashboard') }}" class="sidebar-link">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </div>

        <div class="sidebar-section-title">User &amp; Staff</div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.user.data') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i> <span>Data User</span>
            </a>
            <a href="{{ route('admin.dokter.index') }}" class="sidebar-link">
                <i class="bi bi-person-badge"></i> <span>Data Dokter</span>
            </a>
            <a href="{{ route('admin.perawat.index') }}" class="sidebar-link">
                <i class="bi bi-person-heart"></i> <span>Data Perawat</span>
            </a>
            <a href="{{ route('admin.resepsionis.index') }}" class="sidebar-link">
                <i class="bi bi-headset"></i> <span>Data Resepsionis</span>
            </a>
            <a href="{{ route('admin.role.manajemen') }}" class="sidebar-link">
                <i class="bi bi-shield-lock"></i> <span>Data Role</span>
            </a>
        </div>

        <div class="sidebar-section-title">Master Data</div>
        <div class="sidebar-menu">
            <a href="{{ route('dokter.jenis.data') }}" class="sidebar-link">
                <i class="bi bi-grid-3x3-gap-fill"></i> <span>Jenis Hewan</span>
            </a>
            <a href="{{ route('dokter.ras.data') }}" class="sidebar-link">
                <i class="bi bi-diagram-3"></i> <span>Ras Hewan</span>
            </a>
            <a href="{{ route('resepsionis.pemilik') }}" class="sidebar-link">
                <i class="bi bi-person-vcard"></i> <span>Data Pemilik</span>
            </a>
            <a href="{{ route('resepsionis.pet') }}" class="sidebar-link">
                <i class="bi bi-bag-heart"></i> <span>Data Pet</span>
            </a>
            <a href="{{ route('admin.kategori.data') }}" class="sidebar-link">
                <i class="bi bi-tag"></i> <span>Kategori</span>
            </a>
            <a href="{{ route('admin.kategoriklinis.data') }}" class="sidebar-link">
                <i class="bi bi-journal-medical"></i> <span>Kategori Klinis</span>
            </a>
            <a href="{{ route('admin.kodetindakan.data') }}" class="sidebar-link">
                <i class="bi bi-code-square"></i> <span>Kode Tindakan</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            &copy; {{ date('Y') }} Klinik Hewan
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="main-area">
        <div class="content">
            <div class="page-header">
                <h2>Halaman Data Master</h2>
                <p>Silakan pilih menu di sidebar untuk mengelola data.</p>
            </div>

            <!-- RINGKASAN DATA -->
            <div class="card-container">
                <div class="card">
                    <h3>Jumlah User</h3>
                    <p>{{ $totalUser }}</p>
                </div>
                <div class="card">
                    <h3>Jenis Hewan</h3>
                    <p>{{ $totalJenis }}</p>
                </div>
                <div class="card">
                    <h3>Ras Hewan</h3>
                    <p>{{ $totalRas }}</p>
                </div>
                <div class="card">
                    <h3>Data Pet</h3>
                    <p>{{ $totalPet }}</p>
                </div>
            </div>

            <!-- GRAFIK -->
            <div class="chart-container">
                <div class="chart-box">
                    <h3>Distribusi Jenis Hewan</h3>
                    <small>Perbandingan jumlah tiap jenis</small>
                    <canvas id="pieChart"></canvas>
                </div>
                <div class="chart-box">
                    <h3>Jumlah Ras Hewan</h3>
                    <small>Data Ras hewan oleh jenis hewan</small>
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <!-- AKTIVITAS TERBARU -->
            <div class="activity">
                <h3>Aktivitas Terbaru</h3>
                <ul>
                    @foreach($activities as $a)
                        <li>
                            {{ $a->activity }}
                            <br>
                            <small style="opacity:.6">{{ $a->created_at->diffForHumans() }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div><!-- /main-area -->

</div><!-- /layout -->

<!-- QUICK ACTION BUTTONS -->
<div class="quick-actions">
    <a href="{{ route('admin.user.create') }}">+ Tambah User</a>
    <a href="{{ route('dokter.jenis.create') }}">+ Jenis Hewan</a>
    <a href="{{ route('resepsionis.pet.create') }}">+ Tambah Pet</a>
</div>

<!-- NOTIF MODAL -->
<div id="notifModal">
    <div id="notifBox">
        <h3 style="margin-top:0;color:#102f76;">Notifikasi</h3>
        <ul style="padding-left:0;list-style:none;">
            @foreach($activities as $a)
                <li style="margin-bottom:8px;padding:8px 10px;background:#f4f4f4;border-radius:8px;">
                    {{ $a->activity }}
                    <br>
                    <small style="opacity:.6">{{ $a->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>

        <button onclick="document.getElementById('notifModal').style.display='none'"
            style="background:#102f76;color:#fff;padding:6px 14px;border:none;border-radius:8px;margin-top:10px;">
            Tutup
        </button>
    </div>
</div>

<script>
    // PIE CHART (Distribusi Jenis Hewan)
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: @json($jenisLabels),
            datasets: [{
                data: @json($jenisCounts),
                backgroundColor: [
                    '#f9a01b', '#102f76', '#142a46',
                    '#ffb84d', '#ffa726', '#3949ab'
                ],
                borderColor: '#fff',
                borderWidth: 3,
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // BAR CHART (Jumlah Ras per Jenis)
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: @json($barLabels),
            datasets: [{
                label: 'Jumlah Ras per Jenis',
                data: @json($barValues),
                backgroundColor: '#f9a01b'
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { display: false } }
        }
    });
</script>
</body>
</html>
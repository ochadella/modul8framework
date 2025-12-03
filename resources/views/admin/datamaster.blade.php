<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master</title>

    <!-- ICONS & CHART.JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* ================= GLOBAL ================= */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(
                180deg,
                #ffffff 0%,
                #fff7ef 20%,
                #ffe6bf 50%,
                #ffcf86 80%,
                #ffb74a 100%
            );
            background-attachment: fixed;
            color: #102f76;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: radial-gradient(
                circle at bottom,
                rgba(255,170,40,0.25),
                transparent 60%
            );
            pointer-events: none;
            z-index: -1;
        }

        a {
            text-decoration: none;
        }

        /* ================= TOPBAR ================= */
        .topbar {
            height: 70px;
            background: linear-gradient(135deg, #102f76 0%, #142a46 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            color: #fff;
            box-shadow: 0 4px 18px rgba(0,0,0,0.25);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .topbar-logo {
            width: 42px;
            height: 42px;
            border-radius: 16px;
            background: rgba(249,160,27,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .topbar-title {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .topbar-title span:first-child {
            font-weight: 700;
            letter-spacing: .5px;
        }

        .topbar-title span:last-child {
            font-size: 12px;
            opacity: .8;
        }

        .topbar-search {
            flex: 0 0 420px;
            max-width: 420px;
        }

        .topbar-search input {
            width: 100%;
            border-radius: 999px;
            border: none;
            padding: 10px 18px 10px 38px;
            outline: none;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
            background: #fefefe;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23102f76' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242.656a5 5 0 1 1 0-10 5 5 0 0 1 0 10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 12px center;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .topbar-right .notif {
            font-size: 18px;
            cursor: pointer;
        }

        .topbar-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(10,10,25,0.35);
            padding: 5px 12px;
            border-radius: 999px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.25);
        }

        .topbar-avatar {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            background: #f9a01b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #102f76;
            font-size: 16px;
        }

        .topbar-user {
            display: flex;
            flex-direction: column;
            font-size: 12px;
        }

        .topbar-user span:first-child {
            font-weight: 600;
        }

        .topbar-user span:last-child {
            opacity: .8;
        }

        .topbar-logout {
            margin-left: 6px;
            background: #ff4d4d;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
        }

        /* ================= LAYOUT WRAPPER ================= */
        .main-wrapper {
            display: flex;
            gap: 26px;
            padding: 24px 26px 40px;
        }

        /* ================= SIDEBAR (SAMA DGN DATA RESEPSIONIS) ================= */
        .sidebar {
            width: 260px;
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

        /* ================= CONTENT ================= */
        .content {
            flex: 1;
            background: rgba(255,255,255,0.82);
            border-radius: 26px;
            box-shadow: 0 18px 36px rgba(0,0,0,0.18);
            padding: 30px 32px 40px;
            backdrop-filter: blur(20px);
        }

        .page-header {
            text-align: center;
            margin-bottom: 10px;
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

        @media (max-width: 960px) {
            .main-wrapper {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
                padding: 16px;
            }
            .sidebar-section-title,
            .sidebar-bottom {
                display: none;
            }
            .sidebar-menu {
                flex-direction: row;
                flex-wrap: nowrap;
            }
            .sidebar-link {
                white-space: nowrap;
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

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-left">
            <div class="topbar-logo">
                <i class="bi bi-hospital"></i>
            </div>
            <div class="topbar-title">
                <span>Klinik Hewan</span>
                <span>Panel Administrator</span>
            </div>
        </div>

        <div class="topbar-search">
            <input type="text" placeholder="Cari menu atau data...">
        </div>

        <div class="topbar-right">
            <span class="notif"><i class="bi bi-bell-fill"></i></span>
            <div class="topbar-profile">
                <div class="topbar-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}
                </div>
                <div class="topbar-user">
                    <span>{{ auth()->user()->name ?? 'User' }}</span>
                    <span>{{ ucfirst(auth()->user()->role ?? 'admin') }}</span>
                </div>
                <a href="{{ route('logout') }}" class="topbar-logout">Logout</a>
            </div>
        </div>
    </div>

    <!-- MAIN LAYOUT -->
    <div class="main-wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-header-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>
                <div>
                    <div class="sidebar-header-title">Data Master</div>
                    <div class="sidebar-header-sub">Menu administrasi sistem</div>
                </div>
            </div>

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
                    <i class="bi bi-shield-lock"></i> <span>Manajemen Role</span>
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

        <!-- CONTENT -->
        <main class="content">
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
        </main>
    </div>

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

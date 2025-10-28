<!DOCTYPE html> 
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Global */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            background: #eef1f7;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #102f76, #142a46);
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
            box-shadow: 3px 0 10px rgba(0,0,0,0.2);
            position: relative;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 20px;
            font-weight: bold;
            color: #f9a01b;
            letter-spacing: 1px;
        }
        .sidebar a {
            padding: 14px 20px;
            margin: 4px 10px;
            border-radius: 6px;
            color: #fff;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background: #f9a01b;
            color: #102f76;
            font-weight: bold;
            transform: translateX(5px);
        }
        .sidebar a.active {
            background: #f9a01b;
            color: #102f76;
            font-weight: bold;
        }

        /* Logout Button */
        .sidebar a.logout {
            margin-top: auto;
            background: #f9a01b;
            color: #102f76;
            font-weight: bold;
            text-align: center;
        }
        .sidebar a.logout:hover {
            background: #fff;
            color: #102f76;
        }

        /* Content */
        .content {
            flex: 1;
            padding: 40px;
            background: #f4f6f9;
            overflow-y: auto;
        }

        /* Judul Tengah */
        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .page-header h2 {
            color: #102f76;
            font-size: 28px;
            font-weight: bold;
            margin: 0;
            margin-bottom: 8px;
            position: relative;
            display: inline-block;
            padding-bottom: 6px;
        }
        .page-header h2::after {
            content: "";
            display: block;
            width: 60%;
            height: 4px;
            background: #f9a01b;
            margin: 6px auto 0;
            border-radius: 2px;
        }
        .page-header p {
            margin-top: 12px;
            color: #333;
            font-size: 15px;
            letter-spacing: 0.3px;
        }

        /* Card */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .card {
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: 0.3s;
            text-align: center;
            color: #fff;
            font-weight: bold;
            background: linear-gradient(135deg, #142a46, #f9a01b, #102f76);
            background-size: 200% 200%;
            animation: gradientMove 6s ease infinite;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.2);
        }
        .card h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .card p {
            font-size: 22px;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Chart section */
        .chart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 40px;
        }
        .chart-box {
            flex: 1;
            min-width: 300px;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            height: 360px; 
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .chart-box h3 {
            margin: 0;
            color: #102f76;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        .chart-box small {
            color: #555;
            text-align: center;
            margin-bottom: 10px;
            font-size: 13px;
        }
        .chart-box canvas {
            flex: 1;
        }

        /* Recent Activity */
        .activity {
            margin-top: 40px;
        }
        .activity h3 {
            color: #102f76;
            margin-bottom: 15px;
        }
        .activity ul {
            list-style: none;
            padding: 0;
        }
        .activity li {
            background: #fff;
            margin-bottom: 10px;
            padding: 12px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            font-size: 14px;
            color: #333;
        }

        /* Quick Action Floating Button */
        .quick-actions {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .quick-actions a {
            background: linear-gradient(135deg, #3562cdff , #142a46, #102f76 , #3562cdff);
            color: #f6b24cff;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: 0.3s;
            text-align: center;
        }
        .quick-actions a:hover {
            background: #f9a01b;
            color: #102f76;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Data Master</h2>
        <a href="{{ route('interface.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.user.data') }}">Data User</a>
        <a href="{{ route('admin.role.manajemen') }}">Manajemen Role</a>
        <a href="{{ route('dokter.jenis.data') }}">Jenis Hewan</a>
        <a href="{{ route('dokter.ras.data') }}">Ras Hewan</a>
        <a href="{{ route('resepsionis.pemilik') }}">Data Pemilik</a>
        <a href="{{ route('resepsionis.pet') }}">Data Pet</a>
        <a href="{{ route('admin.kategori.data') }}">Kategori</a>
        <a href="{{ route('admin.kategoriklinis.data') }}">Kategori Klinis</a>
        <a href="{{ route('admin.kodetindakan.data') }}">Kode Tindakan</a>
        <a href="{{ route('logout') }}" class="logout">🚪 Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="page-header">
            <h2>Halaman Data Master</h2>
            <p>Silakan pilih menu di sidebar untuk mengelola data.</p>
        </div>

        <!-- Ringkasan Data -->
        <div class="card-container">
            <div class="card"><h3>Jumlah User</h3><p>120</p></div>
            <div class="card"><h3>Jenis Hewan</h3><p>15</p></div>
            <div class="card"><h3>Ras Hewan</h3><p>35</p></div>
            <div class="card"><h3>Data Pet</h3><p>250</p></div>
        </div>

        <!-- Grafik -->
        <div class="chart-container">
            <div class="chart-box">
                <h3>Distribusi Jenis Hewan</h3>
                <small>Perbandingan jumlah tiap jenis</small>
                <canvas id="pieChart"></canvas>
            </div>
            <div class="chart-box">
                <h3>Jumlah Pet per Bulan</h3>
                <small>Data Januari - Mei</small>
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="activity">
            <h3>Aktivitas Terbaru</h3>
            <ul>
                <li>✅ Admin menambahkan User baru (Budi Santoso)</li>
                <li>✏️ Data jenis hewan "Kucing" diperbarui</li>
                <li>❌ Ras Hewan "Beagle" dihapus oleh Staff</li>
                <li>🐶 Pet baru "Doggy" ditambahkan</li>
            </ul>
        </div>
    </div>

    <!-- Quick Action Buttons -->
    <div class="quick-actions">
        <a href="#">+ Tambah User</a>
        <a href="#">+ Jenis Hewan</a>
        <a href="#">+ Tambah Pet</a>
    </div>

    <!-- Chart.js Script -->
    <script>
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Kucing', 'Anjing', 'Burung'],
                datasets: [{
                    data: [40, 35, 25],
                    backgroundColor: ['#f9a01b', '#102f76', '#142a46'],
                    borderColor: '#fff',
                    borderWidth: 3,
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: { padding: { top: 25, bottom: 25 }},
                plugins: { legend: { position: 'bottom', labels: { font: { size: 14, weight: 'bold' }, padding: 18 }}}
            }
        });

        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
                datasets: [{ label: 'Jumlah Pet', data: [30, 45, 60, 50, 65], backgroundColor: '#f9a01b' }]
            },
            options: {
                scales: { y: { beginAtZero: true }},
                plugins: { legend: { display: false }}
            }
        });
    </script>
</body>
</html>

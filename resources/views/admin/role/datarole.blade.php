<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Role</title>

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

        /* ================= LAYOUT: SIDEBAR + MAIN ================= */
        .layout {
            max-width: 1420px;
            margin: 24px auto 40px;
            display: flex;
            gap: 22px;
        }

        /* ---------- SIDEBAR (SAMA PERSIS SEPERTI DATA MASTER) ---------- */
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

        .sidebar-header {
    border-radius: 14px; /* smooth */
    transition: 0.25s ease;
        }

        .sidebar-header:hover {
            background: rgba(255,255,255,0.08);
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
            display: inline-block;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(249,160,27,0.45);
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

        .btn-back:hover {
            background: #5a6268;
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
            text-align: center;
        }

        td {
            padding: 14px;
            background: rgba(255,255,255,0.82);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            text-align: center;
            vertical-align: middle;
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
            gap: 8px;
            align-items: center;
        }

        .icon-btn {
            font-size: 22px;
            color: #102f76;
            cursor: pointer;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .icon-btn:hover {
            color: #f9a01b;
            transform: translateY(-2px);
        }

        .icon-btn.delete:hover {
            color: #ff4d4d;
        }
        

        /* ================= MODAL ================= */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .modal.show {
            display: flex;
        }

        .modal-box {
            width: 420px;
            background: white;
            padding: 26px;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-box h2 {
            text-align: center;
            color: #102f76;
            margin-top: 0;
        }

        .modal-box label {
            font-weight: 600;
            color: #102f76;
            display: block;
            margin-top: 12px;
        }

        .required {
            color: #f5594b;
        }

        .modal-box input,
        .modal-box select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .modal-box input:disabled {
            background: #f5f5f5;
            cursor: not-allowed;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-cancel {
            padding: 10px 16px;
            background: #6c757d;
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

        .btn-submit {
            padding: 10px 16px;
            background: #f9a01b;
            border: none;
            color: #102f76;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #ffba4c;
        }

        .btn-save {
            background: linear-gradient(90deg, #f9a01b, #ffba4c);
            padding: 8px 14px;
            border-radius: 8px;
            border: none;
            font-weight: 700;
            color: #102f76;
            cursor: pointer;
            font-size: 13px;
            box-shadow: 0 2px 8px rgba(249,160,27,0.3);
            transition: 0.2s;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(249,160,27,0.4);
        }

        .btn-delete {
            background: #dc3545;
            padding: 8px 14px;
            border-radius: 8px;
            border: none;
            font-weight: 700;
            color: white;
            cursor: pointer;
            font-size: 13px;
            box-shadow: 0 2px 8px rgba(220,53,69,0.3);
            transition: 0.2s;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220,53,69,0.4);
        }

        select {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background: white;
            font-size: 13px;
            cursor: pointer;
        }

        select:focus {
            outline: none;
            border-color: #f9a01b;
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
            <input type="text" placeholder="Cari menu atau data role...">
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
            <a href="{{ route('admin.role.manajemen') }}" class="sidebar-link active">
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

        <!-- HEADER TENGAH -->
        <div class="page-header">
            <i class="bi bi-shield-lock-fill page-header-icon"></i>
            <h1>Data Role</h1>
            <p>Data semua Role yang ada di RSHP.</p>
        </div>

        <!-- KONTEN UTAMA -->
        <div class="container">

            <a href="javascript:void(0)" onclick="openTambahRoleModal()" class="btn-add">+ Tambah Role</a>
            <a href="{{ route('admin.datamaster') }}" class="btn-back">← Kembali</a>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Role</th>
                        <th>Nama Role</th>
                        <th>Jumlah User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @php $no = 1; @endphp
                    @foreach($roleData as $role)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $role['idrole'] }}</td>
                        <td>{{ $role['nama_role'] }}</td>

                        <td>
                            <span class="status-badge inactive-badge" style="background:#f7e8ff;color:#6e3fa8;border:1px solid #d2b7ff;">
                                {{ $role['jumlah_user'] }} user
                            </span>
                        </td>

                        <td>
                            <div class="action-icons">
                                <!-- Tombol Edit (Buka Modal) -->
                                <a href="javascript:void(0)"
                                onclick="openEditRoleModal({{ $role['idrole'] }}, '{{ $role['nama_role'] }}', 1)"
                                class="icon-btn"
                                title="Edit Role">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- Form Hapus -->
                                <form action="{{ route('admin.role.delete', $role['idrole']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="icon-btn delete" style="background:none; border:none; padding:0;"
                                        onclick="return confirm('Yakin hapus role ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div><!-- /container -->
    </div><!-- /main-area -->

</div><!-- /layout -->

<!-- ==================== MODAL TAMBAH ROLE ==================== -->
<div id="modalTambahRole" class="modal">
    <div class="modal-box">
        <h2>Tambah Role Baru</h2>

        <form id="formTambahRole" method="POST" action="{{ route('admin.role.store') }}">
            @csrf

            <div class="form-group">
                <label>Nama Role <span class="required">*</span></label>
                <input type="text" name="nama_role" id="nama_role" required placeholder="Contoh: Dokter, Perawat, Admin">
            </div>

            <div class="form-group">
                <label>Status Role <span class="required">*</span></label>
                <select name="status" id="status" required>
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeTambahRoleModal()">Batal</button>
                <button type="submit" class="btn-submit">Simpan</button>
            </div>

        </form>
    </div>
</div>

<!-- ==================== MODAL EDIT ROLE ==================== -->
<div id="modalEditRole" class="modal">
    <div class="modal-box">
        <h2>Edit Role</h2>

        <form id="formEditRole" method="POST">
            @csrf

            <input type="hidden" name="idrole" id="edit_idrole">

            <div class="form-group">
                <label>ID Role</label>
                <input type="text" id="edit_idrole_display" disabled>
            </div>

            <div class="form-group">
                <label>Nama Role <span class="required">*</span></label>
                <input type="text" name="nama_role" id="edit_nama_role" required placeholder="Contoh: Dokter, Perawat">
            </div>

            <div class="form-group">
                <label>Status Role <span class="required">*</span></label>
                <select name="status" id="edit_status" required>
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeEditRoleModal()">Batal</button>
                <button type="submit" class="btn-submit">Update</button>
            </div>

        </form>
    </div>
</div>

<script>
    // ========== MODAL TAMBAH ROLE ==========
    function openTambahRoleModal() {
        document.getElementById('modalTambahRole').classList.add('show');
    }

    function closeTambahRoleModal() {
        document.getElementById('modalTambahRole').classList.remove('show');
    }

    // ========== MODAL EDIT ROLE ==========
    function openEditRoleModal(idrole, nama_role, status) {
        // Isi form dengan data role yang dipilih
        document.getElementById('edit_idrole').value = idrole;
        document.getElementById('edit_idrole_display').value = idrole;
        document.getElementById('edit_nama_role').value = nama_role;
        document.getElementById('edit_status').value = status;

        // Set action form ke route update
        document.getElementById('formEditRole').action = '/admin/role/update/' + idrole;

        // Tampilkan modal
        document.getElementById('modalEditRole').classList.add('show');
    }

    function closeEditRoleModal() {
        document.getElementById('modalEditRole').classList.remove('show');
    }

    // ========== TUTUP MODAL JIKA KLIK DI LUAR ==========
    window.onclick = function(e) {
        let modalTambah = document.getElementById('modalTambahRole');
        let modalEdit = document.getElementById('modalEditRole');
        
        if (e.target === modalTambah) {
            modalTambah.classList.remove('show');
        }
        
        if (e.target === modalEdit) {
            modalEdit.classList.remove('show');
        }
    }
</script>

</body>
</html>
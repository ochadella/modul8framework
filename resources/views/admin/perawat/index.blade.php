<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* ---------- SIDEBAR ---------- */
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

        .modal-box input,
        .modal-box select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 6px;
            font-size: 14px;
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

        /* ================= STATUS BADGE (KHUSUS PERAWAT) ================= */
        .status-badge {
            padding: 6px 14px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 20px;
            display: inline-block;
        }

        .status-aktif {
            background: #c3f7c3;
            color: #1d7a1d;
            border: 1px solid #8be88b;
        }

        .status-nonaktif {
            background: #ffd3d3;
            color: #b71818;
            border: 1px solid #ff9a9a;
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
            <input
                type="text"
                id="searchInput"
                placeholder="Cari menu atau data perawat..."
                onkeyup="searchTable()">
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
            <a href="{{ route('admin.perawat.index') }}" class="sidebar-link active">
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

        <!-- HEADER TENGAH -->
        <div class="page-header">
            <i class="bi bi-person-heart page-header-icon"></i>
            <h1>Data Perawat</h1>
            <p>Daftar perawat yang terdaftar dalam sistem.</p>
        </div>

        <!-- KONTEN UTAMA -->
        <div class="container">

            <button onclick="openTambahModal()" class="btn-add">+ Tambah Perawat</button>
            <a href="{{ route('admin.datamaster') }}" class="btn-back">← Kembali</a>

            <table id="perawatTable">
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

                        <td>
                            @if($p->status === 'aktif')
                                <span class="status-badge status-aktif">Aktif</span>
                            @else
                                <span class="status-badge status-nonaktif">Nonaktif</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-icons">
                                <!-- EDIT (MODAL) -->
                                <a href="javascript:void(0)"
                                   onclick="openEditModal({{ $p->iduser }}, @json($p->nama), @json($p->email), @json($p->status))"
                                   class="icon-btn"
                                   title="Edit Perawat">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- RESET PASSWORD -->
                                <a href="{{ route('admin.perawat.reset', ['id' => $p->iduser]) }}"
                                   onclick="return confirm('Reset password perawat ini ke 123456?')"
                                   class="icon-btn"
                                   title="Reset Password">
                                    <i class="bi bi-key-fill"></i>
                                </a>

                                <!-- HAPUS -->
                                <a href="{{ route('admin.perawat.delete', ['id' => $p->iduser]) }}"
                                   onclick="return confirm('Hapus perawat ini?')"
                                   class="icon-btn"
                                   title="Hapus Perawat">
                                    <i class="bi bi-trash-fill" style="color:red;"></i>
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

<!-- ==================== MODAL TAMBAH PERAWAT ==================== -->
<div id="modalTambah" class="modal">
    <div class="modal-box">
        <h2>Tambah Perawat</h2>

        <form id="formTambahPerawat" method="POST">
            @csrf

            <label>Nama <span class="required">*</span></label>
            <input type="text" name="nama" id="tambah_nama" required>

            <label>Email <span class="required">*</span></label>
            <input type="email" name="email" id="tambah_email" required>

            <!-- PASSWORD -->
            <label>Password <span class="required">*</span></label>
            <input type="password" name="password" id="tambah_password" required minlength="3">

            <!-- KONFIRMASI PASSWORD -->
            <label>Konfirmasi Password <span class="required">*</span></label>
            <input type="password" name="password_confirmation" id="password_confirmation">

            <!-- STATUS -->
            <label>Status <span class="required">*</span></label>
            <select name="status" id="tambah_status" required>
                <option value="">Pilih Status</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeTambahModal()">Kembali</button>
                <button type="submit" class="btn-submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL EDIT PERAWAT ==================== -->
<div id="modalEdit" class="modal">
    <div class="modal-box">
        <h2>Edit Data Perawat</h2>

        <form id="formEditPerawat">
            @csrf
            <input type="hidden" name="edit_id" id="edit_id">

            <label>Nama <span class="required">*</span></label>
            <input type="text" name="nama" id="edit_nama" required>

            <label>Email <span class="required">*</span></label>
            <input type="email" name="email" id="edit_email" required>

            <label>Status <span class="required">*</span></label>
            <select name="status" id="edit_status" required>
                <option value="">Pilih Status</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">
                    Kembali
                </button>
                <button type="submit" class="btn-submit">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// FUNGSI SEARCH TABLE
function searchTable() {
    var input = document.getElementById("searchInput");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("perawatTable");
    var tr = table.getElementsByTagName("tr");

    for (var i = 1; i < tr.length; i++) {
        var tdNama = tr[i].getElementsByTagName("td")[1];
        var tdEmail = tr[i].getElementsByTagName("td")[2];
        var tdStatus = tr[i].getElementsByTagName("td")[3];
        
        if (tdNama || tdEmail || tdStatus) {
            var txtNama = tdNama.textContent || tdNama.innerText;
            var txtEmail = tdEmail.textContent || tdEmail.innerText;
            var txtStatus = tdStatus.textContent || tdStatus.innerText;
            
            if (txtNama.toUpperCase().indexOf(filter) > -1 || 
                txtEmail.toUpperCase().indexOf(filter) > -1 ||
                txtStatus.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// FUNGSI BUKA MODAL TAMBAH
function openTambahModal() {
    document.getElementById('modalTambah').style.display = 'flex';
}

// FUNGSI TUTUP MODAL TAMBAH
function closeTambahModal() {
    document.getElementById('modalTambah').style.display = 'none';
    document.getElementById('formTambahPerawat').reset();
}

// FUNGSI BUKA MODAL EDIT
function openEditModal(id, nama, email, status) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_status').value = status;
    document.getElementById('modalEdit').style.display = 'flex';
}

// FUNGSI TUTUP MODAL EDIT
function closeEditModal() {
    document.getElementById('modalEdit').style.display = 'none';
    document.getElementById('formEditPerawat').reset();
}

// HANDLE FORM TAMBAH PERAWAT
document.getElementById('formTambahPerawat').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch('{{ route("admin.perawat.store") }}', {
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Perawat berhasil ditambahkan!");
            closeTambahModal();
            location.reload();
        } else {
            alert("Gagal menambahkan perawat: " + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(err => {
        console.error(err);
        alert("Terjadi kesalahan saat menambahkan perawat");
    });
});

// HANDLE FORM EDIT PERAWAT
document.getElementById('formEditPerawat').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    fetch('/admin/datamaster/perawat/update/' + formData.get('edit_id'), {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Perawat berhasil diupdate!');
            closeEditModal();
            location.reload();
        } else {
            alert('Gagal mengupdate perawat: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate perawat');
    });
});

// TUTUP MODAL SAAT KLIK DI LUAR MODAL
window.onclick = function(event) {
    var modalTambah = document.getElementById('modalTambah');
    var modalEdit = document.getElementById('modalEdit');
    
    if (event.target == modalTambah) {
        closeTambahModal();
    }
    if (event.target == modalEdit) {
        closeEditModal();
    }
}
</script>

</body>
</html>

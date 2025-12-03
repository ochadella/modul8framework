<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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

        /* ================= MODAL TAMBAH USER ================= */
        #modalTambah {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            justify-content: center;
            align-items: center;
            z-index: 2000;
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

        /* ================= SIDEBAR ================= */
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
        }

        .icon-btn:hover {
            color: #f9a01b;
            transform: translateY(-2px);
        }

        /* ================= MODAL ================= */
        #modalTambah,
        #modalEdit {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .modal-box {
            width: 520px;
            max-width: 90%;
            background: white;
            padding: 28px 32px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            max-height: 85vh;
            overflow-y: auto;
        }

        .modal-box h2 {
            text-align: center;
            color: #102f76;
            margin-top: 0;
            margin-bottom: 24px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .modal-box label {
            font-weight: 600;
            color: #102f76;
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .modal-box label .required {
            color: #ff4d4d;
            margin-left: 2px;
        }

        .modal-box input[type="text"],
        .modal-box input[type="email"],
        .modal-box input[type="password"],
        .modal-box select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .modal-box input[type="text"]:focus,
        .modal-box input[type="email"]:focus,
        .modal-box input[type="password"]:focus,
        .modal-box select:focus {
            outline: none;
            border-color: #f9a01b;
        }

        .modal-box input::placeholder {
            color: #999;
            font-size: 13px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 8px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .checkbox-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .checkbox-item label {
            margin: 0;
            font-weight: 500;
            font-size: 13px;
            cursor: pointer;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
        }

        .modal-btn-cancel {
            padding: 10px 20px;
            background: #6c757d;
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .modal-btn-submit {
            padding: 10px 20px;
            background: #f9a01b;
            border: none;
            color: #102f76;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .modal-btn-cancel:hover {
            background: #5a6268;
        }

        .modal-btn-submit:hover {
            background: #ffb84d;
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
    </style>
</head>

<body>

@php
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'User';
    $displayRole = ucfirst($user->role ?? 'Admin');
    $initial = strtoupper(mb_substr($displayName, 0, 1));
@endphp

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
        <input type="text" id="searchInput" placeholder="Cari menu atau data..." onkeyup="searchTable()">
    </div>

    <div class="topbar-right">
        <span class="notif"><i class="bi bi-bell-fill"></i></span>
        <div class="topbar-profile">
            <div class="topbar-avatar">
                {{ $initial }}
            </div>
            <div class="topbar-user">
                <span>{{ $displayName }}</span>
                <span>{{ $displayRole }}</span>
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
            <a href="{{ route('admin.datamaster') }}" style="text-decoration: none; color: inherit;">
                <div>
                    <div class="sidebar-header-title">Data Master</div>
                    <div class="sidebar-header-sub">Menu administrasi sistem</div>
                </div>
            </a>
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
            <a href="{{ route('admin.user.data') }}" class="sidebar-link active">
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
            <h2>Data User</h2>
            <p>Daftar user yang terdaftar dalam sistem.</p>
        </div>

        <a href="javascript:void(0)" onclick="openTambahModal()" class="btn-add">+ Tambah User</a>
        <a href="{{ route('admin.datamaster') }}" class="btn-back">← Kembali</a>

        <table id="userTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->iduser }}</td>
                    <td>{{ $u->nama }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role ?? '-' }}</td>

                    <td>
                        <div class="action-icons">
                            <!-- EDIT -->
                            <a href="javascript:void(0)"
                               onclick="openEditModal('{{ $u->iduser }}','{{ $u->nama }}','{{ $u->email }}','{{ $u->role }}')"
                               class="icon-btn">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <!-- RESET PASSWORD -->
                            <a href="{{ url('admin/user/reset/'.$u->iduser) }}"
                               onclick="return confirm('Reset password user ini ke 123456?')"
                               class="icon-btn">
                                <i class="bi bi-key-fill"></i>
                            </a>

                            <!-- HAPUS -->
                            <a href="{{ url('admin/user/delete/'.$u->iduser) }}"
                                onclick="return confirm('Hapus user ini?')"
                                class="icon-btn">
                                <i class="bi bi-trash-fill" style="color:red;"></i>
                            </a>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </main>
</div>

<!-- ==================== MODAL TAMBAH ==================== -->
<div id="modalTambah" style="display:none;">
    <div class="modal-box">
        <h2>Tambah User</h2>

        <form id="formTambahUser" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama <span class="required">*</span></label>
                <input type="text" name="nama" id="tambah_nama" required>
            </div>

            <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <input type="email" name="email" id="tambah_email" required>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label>Password <span class="required">*</span></label>
                <input type="password" name="password" id="tambah_password" required minlength="3">
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="form-group">
                <label>Konfirmasi Password <span class="required">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>

            <!-- ROLE -->
            <div class="form-group">
                <label>Role <span class="required">*</span></label>
                <select name="role" id="tambah_role" required>
                    <option value="">Pilih Role</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->nama_role }}">{{ $r->nama_role }}</option>
                    @endforeach
                </select>
            </div>

            <div class="modal-buttons">
                <button type="button" class="modal-btn-cancel" onclick="closeTambahModal()">Kembali</button>
                <button type="submit" class="modal-btn-submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL EDIT ==================== -->
<div id="modalEdit">
    <div class="modal-box">
        <h2>Edit Data User</h2>

        <form id="formEditUser">
            @csrf
            <input type="hidden" name="edit_id" id="edit_id">

            <div class="form-group">
                <label>Nama <span class="required">*</span></label>
                <input type="text" name="nama" id="edit_nama" required>
            </div>

            <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <input type="email" name="email" id="edit_email" required>
            </div>

            <div class="form-group">
                <label>Role <span class="required">*</span></label>
                <select name="role" id="edit_role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="dokter">Dokter</option>
                    <option value="perawat">Perawat</option>
                    <option value="resepsionis">Resepsionis</option>
                </select>
            </div>

            <div class="modal-buttons">
                <button type="button" class="modal-btn-cancel" onclick="closeEditModal()">
                    Kembali
                </button>
                <button type="submit" class="modal-btn-submit">
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
    var table = document.getElementById("userTable");
    var tr = table.getElementsByTagName("tr");

    for (var i = 1; i < tr.length; i++) {
        var tdNama = tr[i].getElementsByTagName("td")[1];
        var tdEmail = tr[i].getElementsByTagName("td")[2];
        var tdRole = tr[i].getElementsByTagName("td")[3];
        
        if (tdNama || tdEmail || tdRole) {
            var txtNama = tdNama.textContent || tdNama.innerText;
            var txtEmail = tdEmail.textContent || tdEmail.innerText;
            var txtRole = tdRole.textContent || tdRole.innerText;
            
            if (txtNama.toUpperCase().indexOf(filter) > -1 || 
                txtEmail.toUpperCase().indexOf(filter) > -1 ||
                txtRole.toUpperCase().indexOf(filter) > -1) {
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
    document.getElementById('formTambahUser').reset();
}

// FUNGSI BUKA MODAL EDIT
function openEditModal(id, nama, email, role) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_role').value = role;
    document.getElementById('modalEdit').style.display = 'flex';
}

// FUNGSI TUTUP MODAL EDIT
function closeEditModal() {
    document.getElementById('modalEdit').style.display = 'none';
    document.getElementById('formEditUser').reset();
}


// HANDLE FORM TAMBAH USER
document.getElementById('formTambahUser').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch('{{ route("admin.user.store") }}', {
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("User berhasil ditambahkan!");
            closeTambahModal();
            location.reload();
        } else {
            alert("Gagal menambahkan user: " + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(err => {
        console.error(err);
        alert("Terjadi kesalahan saat menambahkan user");
    });
});

// HANDLE FORM EDIT USER
document.getElementById('formEditUser').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    fetch('{{ route("admin.user.update") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('User berhasil diupdate!');
            closeEditModal();
            location.reload(); // Reload halaman untuk menampilkan data terupdate
        } else {
            alert('Gagal mengupdate user: ' + (data.message || 'Terjadi kesalahan'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate user');
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
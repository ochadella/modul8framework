<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
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
        }
        h2 {
            margin-bottom: 20px;
            color: #102f76;
        }
        .btn {
            display: inline-block;
            padding: 8px 14px;
            margin: 0;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            color: white;
            transition: 0.3s;
        }
        .btn-back { background: #6c757d; }
        .btn-add { background: linear-gradient(to right, #f9a01b, #ff9554); }
        .btn-edit { background: #ffc107; color: black; }
        .btn-reset { background: #17a2b8; }
        .btn:hover { opacity: 0.9; }
        .table-container {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            overflow-x: auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 850px;
            table-layout: fixed;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        th:nth-child(1), td:nth-child(1) { width: 8%; }
        th:nth-child(2), td:nth-child(2) { width: 20%; }
        th:nth-child(3), td:nth-child(3) { width: 27%; }
        th:nth-child(4), td:nth-child(4) { width: 25%; }
        th:nth-child(5), td:nth-child(5) { width: 20%; }
        th {
            background: #102f76;
            color: #fff;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover td {
            background: rgba(249,160,27,0.08);
        }
        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <span>📋 Data User</span>
        <span>
            <a href="{{ url('dashboard') }}">Dashboard</a>
            <a href="{{ url('admin/datamaster') }}">Data Master</a>
            <a href="{{ url('logout') }}">Logout</a>
        </span>
    </div>

    <div class="content">
        <h2>Daftar User</h2>

        <div style="margin-bottom: 15px;">
            <a href="{{ url()->previous() }}" class="btn btn-back">← Kembali</a>
            <a href="{{ url('admin/user/tambahuser') }}" class="btn btn-add">+ Tambah User</a>
        </div>

        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>

                {{-- ✅ Ganti PHP native jadi Blade syntax --}}
                @if($users->count())
                    @foreach($users as $row)
                        <tr>
                            <td>{{ $row->iduser }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->role ?? '-' }}</td>
                            <td class="actions">
                                <button onclick="editUser({{ $row->iduser }}, '{{ $row->nama }}', '{{ $row->email }}', '{{ $row->role ?? '' }}')" class="btn btn-edit">✏ Edit</button>
                                <a href="{{ url('admin/user/reset/'.$row->iduser) }}" class="btn btn-reset" onclick="return confirm('Reset password user ini ke 123456?')">🔑 Reset</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align:center; color:#666;">Belum ada data user</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    <!-- Form Edit (hidden) -->
    <form method="POST" id="editForm" style="display:none;">
        @csrf
        <input type="hidden" name="edit_id" id="edit_id">
        <input type="hidden" name="nama" id="edit_nama">
        <input type="hidden" name="email" id="edit_email">
        <input type="hidden" name="role" id="edit_role">
    </form>

    <script>
        function editUser(id, nama, email, role) {
            const newNama = prompt("Ubah Nama:", nama);
            if (newNama === null) return;
            const newEmail = prompt("Ubah Email:", email);
            if (newEmail === null) return;
            const newRole = prompt("Ubah Role:", role);
            if (newRole === null) return;

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama').value = newNama;
            document.getElementById('edit_email').value = newEmail;
            document.getElementById('edit_role').value = newRole;

            document.getElementById('editForm').submit();
        }
    </script>
</body>
</html>

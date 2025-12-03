@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Tambah Perawat</h2>

    <form action="{{ route('admin.perawat.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Perawat</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email Perawat</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Non Aktif</option>
            </select>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.perawat.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection

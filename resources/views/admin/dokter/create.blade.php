@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Tambah Dokter</h2>

    <form action="{{ route('admin.dokter.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Dokter</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email Dokter</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Non Aktif</option>
            </select>
        </div>

        <p class="text-muted">Password default: <strong>password123</strong></p>

        <button class="btn btn-success" type="submit">Simpan</button>
        <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection

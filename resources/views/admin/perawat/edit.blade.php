@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Edit Perawat</h2>

    <form action="{{ route('admin.perawat.update', $perawat->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Perawat</label>
            <input type="text" name="name" class="form-control" value="{{ $perawat->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email Perawat</label>
            <input type="email" name="email" class="form-control" value="{{ $perawat->email }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="aktif" {{ $perawat->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $perawat->status == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.perawat.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection

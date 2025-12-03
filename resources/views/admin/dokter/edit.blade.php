@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Edit Data Dokter</h2>

    <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Dokter</label>
            <input type="text" name="name" class="form-control" value="{{ $dokter->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email Dokter</label>
            <input type="email" name="email" class="form-control" value="{{ $dokter->email }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="aktif" {{ $dokter->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $dokter->status == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
            </select>
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection

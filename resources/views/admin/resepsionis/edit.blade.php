@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Edit Resepsionis</h2>

    <form action="{{ route('admin.resepsionis.update', $resepsionis->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Resepsionis</label>
            <input type="text" name="name" class="form-control" value="{{ $resepsionis->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email Resepsionis</label>
            <input type="email" name="email" class="form-control" value="{{ $resepsionis->email }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="aktif" {{ $resepsionis->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $resepsionis->status == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.resepsionis.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection

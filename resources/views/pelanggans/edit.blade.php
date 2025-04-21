@extends('home')
@section('content')


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center mb-4">Edit Pelanggan</h1>

    <form action="{{ route('pelanggans.update', $pelanggan->PelangganID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="namapelanggan" name="namapelanggan" value="{{ $pelanggan->namapelanggan }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pelanggan->alamat }}" required>
        </div>

        <div class="mb-3">
            <label for="no_tlp" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" id="no_tlp" name="no_tlp" value="{{ $pelanggan->no_tlp }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                <option value="Laki-laki" {{ $pelanggan->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $pelanggan->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


@endsection
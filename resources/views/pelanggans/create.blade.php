@extends('home')
@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center mb-4">Tambah Pelanggan</h1>

    <form action="{{ route('pelanggans.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" name="namapelanggan" id="namapelanggan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="no_tlp" class="form-label">No. Telepon</label>
            <input type="number" name="no_tlp" id="no_tlp" class="form-control" required>
        </div>

        <div class="mb-3">
    <label class="form-label">Jenis Kelamin</label>
    <select name="jenis_kelamin" class="form-control" required>
        <option value="" disabled selected>Pilih Jenis Kelamin</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>
</div>


        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection
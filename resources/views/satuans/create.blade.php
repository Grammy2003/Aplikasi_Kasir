@extends('home')
@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kategori</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center mb-4 border-bottom border-danger pb-2">Tambah Kategori Baru</h1>

    <!-- Form Tambah Satuan -->
    <form action="{{ route('satuans.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_satuan" class="form-label">Nama Kategori</label>
            <input type="text" name="nama_satuan" id="nama_satuan" class="form-control" value="{{ old('nama_satuan') }}" required>
            @error('nama_satuan')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Kategori
            </button>
            <a href="{{ route('satuans.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
@endsection
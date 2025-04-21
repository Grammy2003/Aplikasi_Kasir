@extends('home')
@section('content')

<!-- Add Bootstrap CDN link to the <head> section of your layout -->
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<!-- Your form below -->
<form action="{{ route('satuans.update', $satuan->satuanID) }}" method="POST" class="container mt-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nama_satuan" class="form-label">Nama Kategori:</label>
        <input type="text" name="nama_satuan" satuanID="nama_satuan" class="form-control" 
               value="{{ old('nama_satuan', $satuan->nama_satuan) }}" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi:</label>
        <input type="text" name="deskripsi" satuanID="deskripsi" class="form-control" 
               value="{{ old('deskripsi', $satuan->deskripsi) }}">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<!-- Add Bootstrap JS CDN link before closing </body> tag -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection
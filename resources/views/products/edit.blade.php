@extends('home')
@section('content')


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center mb-4">Edit Produk</h1>

    <!-- Tampilkan pesan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Produk -->
    <form action="{{ route('products.update', $product->produkID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_produk" class="form-label fw-bold">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="{{ old('nama_produk', $product->nama_produk) }}" required>
        </div>

        <div class="mb-3">
            <label for="categoryID" class="form-label fw-bold">Kategori</label>
            <select name="categoryID" id="categoryID" class="form-select" required>
                <option value="" disabled>Pilih kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->categoryID }}" 
                        {{ old('categoryID', $product->categoryID) == $category->categoryID ? 'selected' : '' }}>
                        {{ $category->nama_category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label fw-bold">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $product->harga) }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label fw-bold">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', $product->stok) }}" required>
        </div>

        <div class="mb-3">
            <label for="satuanID" class="form-label fw-bold">Satuan</label>
            <select name="satuanID" id="satuanID" class="form-select" required>
                <option value="" disabled>Pilih Satuan</option>
                @foreach ($satuans as $satuan)
                    <option value="{{ $satuan->satuanID }}" 
                        {{ old('satuanID', $product->satuanID) == $satuan->satuanID ? 'selected' : '' }}>
                        {{ $satuan->nama_satuan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="supplierID" class="form-label fw-bold">Supplier</label>
            <select name="supplierID" id="supplierID" class="form-select" required>
                <option value="" disabled>Pilih supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->supplierID }}" 
                        {{ old('supplierID', $product->supplierID) == $supplier->supplierID ? 'selected' : '' }}>
                        {{ $supplier->nama_supplier }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>

    <!-- Tombol Hapus Produk -->
    <form action="{{ route('products.destroy', $product->produkID) }}" method="POST" class="text-center mt-3">
        @csrf
        @method('DELETE')
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

@endsection
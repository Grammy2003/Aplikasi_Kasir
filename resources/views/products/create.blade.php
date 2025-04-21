
@extends('home')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produk</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Warna merah wine */
        h1 {
            color: #800020;
            font-weight: bold;
        }
        .btn-wine {
            background-color: #800020;
            color: white;
            border: none;
        }
        .btn-wine:hover {
            background-color: #600016;
        }
        .form-control {
            border: 1px solid #800020;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Produk</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <!-- Nama Produk -->
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Masukkan Nama Produk" required>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="categoryID" class="form-label">Nama Kategori</label>
                    <select name="categoryID" class="form-control" id="categoryID" required>
                        <option value="">Pilih Nama Kategori</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->categoryID }}">{{ $category->nama_category }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" step="0.01" name="harga" id="harga" class="form-control" placeholder="Masukkan Harga" required min="0">
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" placeholder="Masukkan jumlah stok" required min="0">
                </div>

            <!-- <Satuan> -->
                <div class="mb-3">
                    <label for="satuanID" class="form-label">Nama Satuan</label>
                    <select name="satuanID" class="form-control" id="satuanID" required>
                        <option value="">Pilih Nama Satuan</option>
                        @foreach ($satuans as $satuan)
                            <option value="{{ $satuan->satuanID }}">{{ $satuan->nama_satuan }}</option>
                        @endforeach

                    </select>
                </div>

                <!-- Supplier -->
                <div class="mb-3">
                    <label for="supplierID" class="form-label">Nama Supplier</label>
                    <select name="supplierID" class="form-control" id="supplierID" required>
                        <option value="">Pilih Nama Supplier</option>
                        @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->supplierID }}">{{ $supplier->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Simpan dan Kembali -->
                <div class="text-center">
                    <button type="submit" class="btn btn-wine">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

@endsection
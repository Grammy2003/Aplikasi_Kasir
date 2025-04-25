@extends('home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-wine fw-bold">Tambah Produk</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
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
                    <label for="categoryID" class="form-label">Kategori</label>
                    <select name="categoryID" id="categoryID" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->categoryID }}">{{ $category->nama_category }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukkan Harga" required min="0" step="0.01">
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" placeholder="Masukkan jumlah stok" required min="0">
                </div>

                <!-- Satuan -->
                <div class="mb-3">
                    <label for="satuanID" class="form-label">Satuan</label>
                    <select name="satuanID" id="satuanID" class="form-control" required>
                        <option value="">Pilih Satuan</option>
                        @foreach ($satuans as $satuan)
                            <option value="{{ $satuan->satuanID }}">{{ $satuan->nama_satuan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Supplier -->
                <div class="mb-3">
                    <label for="supplierID" class="form-label">Supplier</label>
                    <select name="supplierID" id="supplierID" class="form-control" required>
                        <option value="">Pilih Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->supplierID }}">{{ $supplier->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol -->
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

{{-- Custom style --}}
<style>
    h1.text-wine {
        color: #800020;
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
@endsection

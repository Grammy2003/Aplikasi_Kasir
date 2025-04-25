@extends('home')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4 font-bold text-3xl text-gray-800">
            🛒 Daftar Produk
        </h2>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('products.index') }}" class="d-flex mb-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="🔍 Cari supplier...">
            <button type="submit" class="btn btn-info text-white">Search</button>
        </form>

        <!-- Tombol Tambah Produk -->
        @if(Auth::user()->role !== 'kasir')
            <div class="d-flex justify-content-start my-4">
                <a href="{{ route('products.create') }}" class="btn btn-success shadow">
                    ➕ Tambah Produk
                </a>
            </div>
        @endif

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success bg-success text-white">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger bg-danger text-white">
                ❌ {{ session('error') }}
            </div>
        @endif

        <!-- Tabel Produk -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Supplier</th>
                        @if(Auth::user()->role !== 'kasir')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->nama_produk }}</td>
                            <td>{{ optional($product->category)->nama_category ?? 'Tanpa Kategori' }}</td>
                            <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td>{{ $product->stok }}</td>
                            <td>{{ $product->satuan ? $product->satuan->nama_satuan : 'No Satuan' }}</td>
                            <td>{{ optional($product->supplier)->nama_supplier ?? '-' }}</td>
                            @if(Auth::user()->role !== 'kasir')
                                <td>
                                    <div class="d-flex justify-content-center gap-3">
                                        <!-- Tombol Edit (biru muda) -->
                                        <a href="{{ route('products.edit', $product->produkID) }}"
                                           class="d-flex align-items-center justify-content-center"
                                           style="width: 35px; height: 35px; font-size: 18px; background-color: #3498db; color: white; border: none; border-radius: 5px;"
                                           title="Edit">
                                            ✏️
                                        </a>

                                        <!-- Tombol Hapus (merah terang) -->
                                        <form action="{{ route('products.destroy', $product->produkID) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="d-flex align-items-center justify-content-center"
                                                    style="width: 35px; height: 35px; font-size: 18px; background-color: #e74c3c; color: white; border: none; border-radius: 5px;"
                                                    title="Hapus">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-800 py-4">
                                📭 Tidak ada data produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination dengan ukuran yang lebih kecil -->
        <div class="d-flex justify-content-center mt-3">
            <div class="pagination-sm">
                {{ $products->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom pagination style */
    .pagination-sm .pagination {
        margin-bottom: 0;
    }
    
    .pagination-sm .page-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .pagination-sm .page-item {
        line-height: 1;
    }
</style>
@endsection
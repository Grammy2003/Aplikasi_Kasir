@extends('home')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4 font-bold text-3xl text-gray-800">
            📂 Daftar Kategori
        </h2>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('categories.index') }}" class="d-flex mb-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="🔍 Cari kategori...">
            <button type="submit" class="btn btn-info text-white">Search</button>
        </form>

        <!-- Tombol Tambah Kategori -->
        <div class="d-flex justify-content-start my-4">
            <a href="{{ route('categories.create') }}" class="btn btn-success shadow">
                ➕ Tambah Kategori
            </a>
        </div>

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

        <!-- Tabel Kategori -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->nama_category }}</td>
                            <td>{{ $category->deskripsi }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('categories.edit', $category->categoryID) }}"
                                       class="d-flex align-items-center justify-content-center"
                                       style="width: 35px; height: 35px; font-size: 18px; background-color: #3498db; color: white; border: none; border-radius: 5px;"
                                       title="Edit">
                                        ✏️
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('categories.destroy', $category->categoryID) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-800 py-4">
                                📭 Tidak ada data kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            <div class="pagination-sm">
                {{ $categories->appends(request()->input())->links('pagination::bootstrap-4') }}
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

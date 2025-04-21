@extends('home')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4 font-bold text-3xl text-gray-800">
            📂 Daftar Satuan
        </h2>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('satuans.index') }}" class="d-flex mb-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="🔍 Cari satuan...">
            <button type="submit" class="btn btn-info text-white">Search</button>
        </form>

        <!-- Tombol Tambah Satuan -->
        <div class="d-flex justify-content-start my-4">
            <a href="{{ route('satuans.create') }}" class="btn btn-success shadow">
                ➕ Tambah Satuan
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

        <!-- Tabel Satuan -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Satuan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($satuans as $satuan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $satuan->nama_satuan }}</td>
                            <td>{{ $satuan->deskripsi }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('satuans.edit', $satuan->satuanID) }}"
                                       class="d-flex align-items-center justify-content-center"
                                       style="width: 35px; height: 35px; font-size: 18px; background-color: #3498db; color: white; border: none; border-radius: 5px;"
                                       title="Edit">
                                        ✏️
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('satuans.destroy', $satuan->satuanID) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                                📭 Tidak ada data satuan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            <div class="pagination-sm">
                {{ $satuans->appends(request()->input())->links('pagination::bootstrap-4') }}
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

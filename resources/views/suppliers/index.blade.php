@extends('home')

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4 font-bold text-3xl text-gray-800">
            🏬 Daftar Supplier
        </h2>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('suppliers.index') }}" class="d-flex mb-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="🔍 Cari supplier...">
            <button type="submit" class="btn btn-info text-white">Search</button>
        </form>

        <!-- Tombol Tambah Supplier -->
        @if(Auth::user()->role !== 'kasir')
            <div class="d-flex justify-content-start my-4">
                <a href="{{ route('suppliers.create') }}" class="btn btn-success shadow">
                    ➕ Tambah Supplier
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

        <!-- Tabel Supplier -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        @if(Auth::user()->role !== 'kasir')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $supplier->nama_supplier }}</td>
                            <td>{{ $supplier->no_tlp }}</td>
                            <td>{{ $supplier->email_supplier }}</td>
                            @if(Auth::user()->role !== 'kasir')
                                <td>
                                    <div class="d-flex justify-content-center gap-3">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('suppliers.edit', $supplier->supplierID) }}"
                                           class="d-flex align-items-center justify-content-center"
                                           style="width: 35px; height: 35px; font-size: 18px; background-color: #3498db; color: white; border: none; border-radius: 5px;"
                                           title="Edit">
                                            ✏️
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('suppliers.destroy', $supplier->supplierID) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                            <td colspan="5" class="text-center text-gray-800 py-4">
                                📭 Tidak ada data supplier.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            <div class="pagination-sm">
                {{ $suppliers->appends(request()->input())->links('pagination::bootstrap-4') }}
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

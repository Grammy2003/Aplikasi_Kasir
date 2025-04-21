@extends('home')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4 font-bold text-3xl text-gray-800">
            📜 Daftar Transaksi Penjualan
        </h2>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('transaksi_penjualans.index') }}" class="d-flex mb-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="🔍 Cari transaksi...">
            <button type="submit" class="btn btn-info text-white">Search</button>
        </form>

        <!-- Tombol Tambah Transaksi -->
        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'kasir')
            <div class="d-flex justify-content-start my-4">
                <a href="{{ route('transaksi_penjualans.create') }}" class="btn btn-success shadow-lg">
                    ➕ Tambah Transaksi
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

        <!-- Tabel Transaksi Penjualan -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Produk</th>
                        <th>Kuantitas</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Uang Bayar</th>
                        <th>Kembali</th>
                        <th>Struk</th>
                        @if(auth()->user()->role == 'admin')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi_penjualans as $index => $transaksi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $transaksi->pelanggan->namapelanggan ?? 'Tidak Ada' }}</td>
                            <td>
                                @if ($transaksi->details->isNotEmpty())
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($transaksi->details as $detail)
                                            <li>{{ $detail->product->nama_produk ?? 'Produk tidak ditemukan' }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-danger">Tidak ada produk</span>
                                @endif
                            </td>
                            <td>
                                @if ($transaksi->details->isNotEmpty())
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($transaksi->details as $detail)
                                            <li>{{ $detail->kuantitas }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-danger">Tidak ada kuantitas</span>
                                @endif
                            </td>
                            <td>{{ $transaksi->TglPenjualan }}</td>
                            <td>Rp {{ number_format($transaksi->TotalHarga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($transaksi->UangBayar, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($transaksi->Kembali, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('transaksi_penjualans.struk', $transaksi->PenjualanID) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-print"></i> Cetak Struk
                                </a>
                            </td>
                            @if(auth()->user()->role == 'admin')
                                <td>
                                     <!-- Tombol Hapus -->
                                     <form action="{{ route('transaksi_penjualans.destroy', $transaksi->PenjualanID) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                            <td colspan="10" class="text-center text-gray-800 py-4">
                                📭 Tidak ada data Transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            <div class="pagination-sm">
                {{ $transaksi_penjualans->appends(request()->input())->links('pagination::bootstrap-4') }}
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

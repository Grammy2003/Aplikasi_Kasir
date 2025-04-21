
@extends('home')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Transaksi Penjualan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transaksi_penjualans.store') }}" method="POST">
        @csrf

        <!-- Pilihan pelanggan -->
        <div class="form-group">
            <label for="PelangganID">Pilih Pelanggan</label>
            <select name="PelangganID" id="PelangganID" class="form-control select2">
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->PelangganID }}">{{ $pelanggan->namapelanggan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal Penjualan -->
        <div class="mb-3">
            <label for="TglPenjualan" class="form-label">Tanggal Penjualan</label>
            <input type="date" id="TglPenjualan" name="TglPenjualan" class="form-control" required>
        </div>

        <!-- Produk dan Detail -->
        <div class="mb-3">
            <label class="form-label">Produk</label>
            <table class="table table-bordered" id="productTable">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="productRows">
                    <tr>
                        <td>
                            <select class="form-control select2 product-select" name="DetailID[0][produkID]" required>
                                <option value="">Pilih Produk</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->produkID }}" data-harga="{{ $product->harga }}">
                                        {{ $product->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control harga" readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control kuantitas" name="DetailID[0][kuantitas]" min="1" value="1" required>
                        </td>
                        <td>
                            <input type="number" class="form-control subtotal" name="DetailID[0][subtotal]" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="addRow" class="btn btn-primary">Tambah Produk</button>
        </div>

        <!-- Total Harga -->
        <div class="mb-3">
            <label for="TotalHarga" class="form-label">Total Harga</label>
            <input type="number" id="TotalHarga" name="TotalHarga" class="form-control" readonly>
        </div>

        <!-- Uang Bayar -->
        <div class="mb-3">
            <label for="UangBayar" class="form-label">Uang Bayar</label>
            <input type="number" class="form-control" id="UangBayar" name="UangBayar" required>
        </div>

        <!-- Kembalian -->
        <div class="mb-3">
            <label for="Kembali" class="form-label">Kembali</label>
            <input type="number" class="form-control" id="Kembali" name="Kembali" readonly>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan Penjualan</button>
            <a href="{{ route('transaksi_penjualans.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<!-- JavaScript untuk Dinamika Produk -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const productTable = document.getElementById('productRows');
    const totalHargaInput = document.getElementById('TotalHarga');
    const uangBayarInput = document.getElementById('UangBayar');
    const kembaliInput = document.getElementById('Kembali');

    // Tambahkan baris produk baru
    document.getElementById('addRow').addEventListener('click', () => {
        const rowCount = productTable.children.length;
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select class="form-control select2 product-select" name="DetailID[${rowCount}][produkID]" required>
                    <option value="">Pilih Produk</option>
                    {!! json_encode($products->map(function($product) {
                        return "<option value='{$product->produkID}' data-harga='{$product->harga}'>{$product->nama_produk}</option>";
                    })->implode('')) !!}
                </select>
            </td>
            <td>
                <input type="number" class="form-control harga" readonly>
            </td>
            <td>
                <input type="number" class="form-control kuantitas" name="DetailID[${rowCount}][kuantitas]" min="1" value="1" required>
            </td>
            <td>
                <input type="number" class="form-control subtotal" name="DetailID[${rowCount}][subtotal]" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-danger remove-row">Hapus</button>
            </td>
        `;
        productTable.appendChild(newRow);
        $('.select2').select2();
    });

    // Hapus baris produk
    productTable.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-row')) {
            event.target.closest('tr').remove();
            calculateTotal();
        }
    });

    // Perbarui harga dan subtotal saat produk dipilih
    productTable.addEventListener('change', (event) => {
        if (event.target.classList.contains('product-select')) {
            const row = event.target.closest('tr');
            const harga = parseFloat(event.target.selectedOptions[0].getAttribute('data-harga')) || 0;
            row.querySelector('.harga').value = harga;
            updateSubtotal(row);
        }
    });

    // Perbarui subtotal saat kuantitas berubah
    productTable.addEventListener('input', (event) => {
        if (event.target.classList.contains('kuantitas')) {
            const row = event.target.closest('tr');
            updateSubtotal(row);
        }
    });

    // Hitung total harga
    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach((input) => {
            total += parseFloat(input.value || 0);
        });
        totalHargaInput.value = total.toFixed(0);
    }

    // Hitung subtotal
    function updateSubtotal(row) {
        const harga = parseFloat(row.querySelector('.harga').value || 0);
        const kuantitas = parseInt(row.querySelector('.kuantitas').value || 0);
        const subtotal = harga * kuantitas;
        row.querySelector('.subtotal').value = subtotal;
        calculateTotal();
    }

    // Hitung kembalian
    uangBayarInput.addEventListener('input', () => {
        const totalHarga = parseFloat(totalHargaInput.value || 0);
        const uangBayar = parseFloat(uangBayarInput.value || 0);
        kembaliInput.value = uangBayar ? (uangBayar - totalHarga).toFixed(0) : 0;
    });
});
</script>

@endsection

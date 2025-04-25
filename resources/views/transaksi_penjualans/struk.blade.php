
@extends('home')

@section('content')
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }

    .receipt {
        width: 320px;
        background: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-size: 14px;
    }

    .receipt h5 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        y8h
        text-align: center;
    }

    .shopping-icon {
        font-size: 50px;
        color:rgb(199, 38, 21);
        margin-bottom: 12px;
    }

    .hr-clean {
        border: none;
        border-top: 1px solid #ddd;
        margin: 15px 0;
    }

    .float-right {
        float: right;
    }

    .product-details td {
        font-size: 14px;
    }

    .kuantitas {
        font-weight: bold;
    }
    
    .price-column {
        width: 100px;
        text-align: right;
    }
    
    .quantity-value {
        width: 100px;
        text-align: right;
        padding-right: 30px; /* Add padding to move the number more to the left */
    }
    
    .product-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }
    
    .subtotal {
        margin-top: 5px;
        font-weight: bold;
    }

    @media print {
        body {
            visibility: hidden;
        }

        .receipt, .receipt * {
            visibility: visible;
        }

        .receipt {
            position: absolute;
            left: 50%;
            top: 10px;
            transform: translateX(-50%);
            width: 320px;
            box-shadow: none;
            border: none;
        }

        .btn {
            display: none;
        }
    }
</style>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="receipt p-4">
        <div class="text-center">
            <!-- Shopping Cart Icon (Keranjang Dorong) -->
            <i class="fas fa-shopping-cart shopping-icon"></i>
            <h5><strong>The Grammy Store</strong></h5>
            <p>Jl. MH Thamrin No.10, Jakarta Pusat</p>
            <p><strong>Telp:</strong> 0812-3456-7890</p>
            <hr class="hr-clean">
        </div>

        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->TglPenjualan)->format('d-m-Y') }}</p>
        <p><strong>Pelanggan:</strong> {{ $transaksi->pelanggan->namapelanggan ?? 'Non Member' }}</p>
        <p><strong>No. Struk:</strong> {{ $transaksi->PenjualanID }}</p>
        <hr class="hr-clean">

        <div class="product-details">
            @foreach ($transaksi->details as $detail)
            <div class="mb-3">
                <div class="product-row">
                    <strong>{{ $detail->product->nama_produk ?? 'Produk Tidak Ditemukan' }}</strong>
                    <span class="price-column">Rp {{ number_format($detail->product->harga, 0, ',', '.') }}</span>
                </div>
                <div class="product-row">
                    <div class="kuantitas">Kuantitas:</div>
                    <span class="quantity-value">{{ $detail->kuantitas }}</span>
                </div>
                <div class="product-row">
                    <div class="subtotal">Subtotal:</div>
                    <span class="price-column">Rp {{ number_format($detail->kuantitas * $detail->product->harga, 0, ',', '.') }}</span>
                </div>
            </div>
            <hr class="hr-clean">
            @endforeach
        </div>

        <p><strong>Total:</strong> <span class="float-right">Rp {{ number_format($transaksi->TotalHarga, 0, ',', '.') }}</span></p>
        <p><strong>Bayar:</strong> <span class="float-right">Rp {{ number_format($transaksi->UangBayar, 0, ',', '.') }}</span></p>
        <p><strong>Kembali:</strong> <span class="float-right">Rp {{ number_format($transaksi->Kembali, 0, ',', '.') }}</span></p>
        <hr class="hr-clean">

        <p class="text-center" style="font-style:;">Thank you & see you soon 👋</p>

        <div class="text-center">
            <button onclick="window.print()" class="btn btn-danger mt-3">
                <i class="fas fa-print"></i> Cetak Struk
            </button>
            <a href="{{ route('transaksi_penjualans.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection



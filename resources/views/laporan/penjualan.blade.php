<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - The Grammy Store</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 800px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .title, .store-name {
            margin-bottom: 10px;
        }
        .store-name {
            font-size: 22px;
            font-weight: bold;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: rgb(194, 18, 65);
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .periode {
            font-size: 14px;
            margin-bottom: 15px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="store-name">The Grammy Store</div>
        <div class="title">Laporan Penjualan</div>
        <p class="periode">Periode: {{ $startDate }} - {{ $endDate }}</p>
        @if ($transaksis->isEmpty())
            <p>Tidak ada transaksi untuk periode ini.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Produk</th>
                        <th>Total Harga</th>
                        <th>Uang Bayar</th>
                        <th>Kembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $key => $transaksi)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $transaksi->TglPenjualan }}</td>
                            <td>{{ $transaksi->pelanggan->namapelanggan ?? 'Non Member' }}</td>
                            <td>
                                @foreach ($transaksi->details as $item) <!-- Changed detail to details -->
                                    {{ $item->product->nama_produk }} x{{ $item->kuantitas }}<br> <!-- Changed produk to product -->
                                @endforeach
                            </td>
                            <td>Rp {{ number_format($transaksi->TotalHarga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($transaksi->UangBayar, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($transaksi->Kembali, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>

@extends('home')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Periode Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        form {
            display: inline-block;
            text-align: left;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, button {
            padding: 8px;
            margin: 5px 0;
            width: 100%;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <h2>Pilih Periode Laporan</h2>
    <form action="{{ route('laporan.penjualan') }}" method="GET" target="_blank">
        <label for="start_date">Dari Tanggal:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">Sampai Tanggal:</label>
        <input type="date" id="end_date" name="end_date" required>

        <button type="submit">Cetak Laporan</button>
    </form>
</body>
</html>
@endsection
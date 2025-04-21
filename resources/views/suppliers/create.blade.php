@extends('home')
@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Supplier</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Warna merah wine */
        h1 {
            color: #800020;
            font-weight: bold;
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
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Supplier</h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf

                <!-- Nama Supplier -->
                <div class="mb-3">
                    <label for="nama_supplier" class="form-label">Nama Supplier</label>
                    <input type="text" name="nama_supplier" ID="nama_supplier" class="form-control" placeholder="Masukkan Nama Supplier" required>
                </div>

                <!-- No. Telepon -->
                <div class="mb-3">
                    <label for="no_tlp" class="form-label">No. Telepon</label>
                    <input type="tel" name="no_tlp" ID="no_tlp" class="form-control" placeholder="Masukkan No. Telepon" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email_supplier" class="form-label">Email</label>
                    <input type="email" name="email_supplier" ID="email_supplier" class="form-control" placeholder="Masukkan Email" required>
                </div>

                <!-- Tombol Simpan dan Kembali -->
                <div class="text-center">
                    <button type="submit" class="btn btn-wine">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

@endsection
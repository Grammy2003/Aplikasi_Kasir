@extends('home')
@section('content')



<!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="container mt-4">
    <h2 class="text-center">Edit Supplier</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="card shadow p-4">
        <form action="{{ route('suppliers.update', $supplier->supplierID) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="nama_supplier" class="form-label">Nama Supplier:</label>
                <input type="text" name="nama_supplier" id="nama_supplier" class="form-control" value="{{ old('nama_supplier', $supplier->nama_supplier) }}" required>
            </div>
    
            <div class="mb-3">
                <label for="no_tlp" class="form-label">No. Telepon:</label>
                <input type="text" name="no_tlp" id="no_tlp" class="form-control" value="{{ old('no_tlp', $supplier->no_tlp) }}" required>
            </div>
    
            <div class="mb-3">
                <label for="email_supplier" class="form-label">Email Supplier:</label>
                <input type="email" name="email_supplier" id="email_supplier" class="form-control" value="{{ old('email_supplier', $supplier->email_supplier) }}" required>
            </div>
    
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
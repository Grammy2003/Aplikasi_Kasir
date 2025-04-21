<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Sesuaikan dengan tabel database
    protected $primaryKey = 'produkID';

    protected $fillable = [
        'nama_produk',
        'categoryID',
        'harga',
        'stok',
        'satuanID',
        'supplierID',
    ];

    // Relasi ke Supplier (One to Many)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplierID', 'supplierID');
    }

    // Relasi ke Category (One to Many)
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID', 'categoryID');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuanID', 'satuanID');
    }
}


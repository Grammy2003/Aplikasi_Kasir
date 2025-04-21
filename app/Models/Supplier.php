<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $primaryKey = 'supplierID';
    protected $fillable = [
        'nama_supplier',
        'no_tlp',
        'email_supplier'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'productID');
    }
}


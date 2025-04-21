<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'categoryID';

    protected $fillable = [
        'nama_category','deskripsi'
    ];

    // Relasi ke Produk (One to Many)
    public function products()
    {
        return $this->hasMany(Product::class, 'productID', 'productID');
    }
}
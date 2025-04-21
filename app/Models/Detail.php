<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'detail'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'DetailID';
    public $timestamps = true;

    protected $fillable = [
        'PenjualanID',
        'produkID',
        'kuantitas',
        'subtotal',
    ];

    // Relasi ke TransaksiPenjualan
    public function transaksiPenjualan()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'PenjualanID', 'PenjualanID');
    }

    // Relasi ke Produk
    public function product()
{
    return $this->belongsTo(Product::class, 'produkID');
}

}

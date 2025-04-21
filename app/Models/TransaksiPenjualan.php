<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penjualans';
    protected $primaryKey = 'PenjualanID';
    public $timestamps = false;

    protected $fillable = [
        'PelangganID', // Tambahkan ini
        'TglPenjualan',
        'TotalHarga',
        'UangBayar',
        'Kembali'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID');
    }

    public function details()
    {
        return $this->hasMany(Detail::class,  'PenjualanID');
    }
}

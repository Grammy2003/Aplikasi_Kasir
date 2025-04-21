<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans'; // Pastikan ini sesuai dengan nama tabel di database
    protected $primaryKey = 'PelangganID'; // Sesuaikan dengan primary key di tabel

    protected $fillable = ['namapelanggan', 'alamat', 'no_tlp', 'jenis_kelamin'];

    public function penjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'PelangganID', 'PelangganID');
    }
}

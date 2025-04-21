<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuans';
    protected $primaryKey = 'satuanID';
    protected $fillable = [
        'nama_satuan',
        'deskripsi'
    ];

    public function satuan()
    {
        return $this->hasMany(Satuan::class, 'satuanID');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dvd extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'judul',
        'genre',
        'stok',
        'tahun_rilis',
        'harga_sewa',
        'bahasa',
        'cover',
    ];
}


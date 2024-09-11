<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';
    protected $dates = ['tanggal_meminjam'];
    protected $fillable = [
        'kode',
        'jumlah',
        'nama_peminjam',
        'alamat_peminjam',
        'no_kontak_peminjam',
        'lama_meminjam',
        'tanggal_meminjam',
        'metode_pembayaran',
    ];

    public function dvd()
    {
        return $this->belongsTo(Dvd::class, 'kode', 'kode');
    }
}


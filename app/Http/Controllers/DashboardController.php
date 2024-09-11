<?php

namespace App\Http\Controllers;
use App\Models\Dvd;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all peminjaman data
        $peminjaman = Peminjaman::with('dvd')->get();

        $genreCounts = Peminjaman::join('dvds', 'peminjamans.kode', '=', 'dvds.kode')
            ->select('dvds.genre', \DB::raw('SUM(peminjamans.jumlah) as total'))
            ->groupBy('dvds.genre')
            ->get();

        return view('dashboard', compact('peminjaman', 'genreCounts'));
    }
}



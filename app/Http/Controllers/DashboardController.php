<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all peminjaman data
        $peminjaman = Peminjaman::with('dvd')->get();
        return view('dashboard', compact('peminjaman'));
    }
}



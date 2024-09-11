<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Dvd;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function create()
    {
        $dvds = Dvd::all();
        return view('peminjaman.create', compact('dvds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman.*.kode' => 'required|exists:dvds,kode',
            'peminjaman.*.jumlah' => 'required|integer',
            'peminjaman.*.nama_peminjam' => 'required|string',
            'peminjaman.*.alamat_peminjam' => 'required|string',
            'peminjaman.*.no_kontak_peminjam' => 'required|string',
            'peminjaman.*.lama_meminjam' => 'required|integer',
            'peminjaman.*.tanggal_meminjam' => 'required|date',
            'peminjaman.*.metode_pembayaran' => 'required|string',
        ]);

        $peminjamanData = $request->input('peminjaman');
        $totalPrice = 0;
        $uniqueGenres = [];

        foreach ($peminjamanData as $item) {
            $dvd = Dvd::where('kode', $item['kode'])->first();

            if ($dvd) {
                // Calculate the price for this peminjaman
                $price = $item['lama_meminjam'] * $dvd->harga_sewa * $item['jumlah'];
                $totalPrice += $price;

                // Save the peminjaman
                Peminjaman::create([
                    'kode' => $item['kode'],
                    'jumlah' => $item['jumlah'],
                    'nama_peminjam' => $item['nama_peminjam'],
                    'alamat_peminjam' => $item['alamat_peminjam'],
                    'no_kontak_peminjam' => $item['no_kontak_peminjam'],
                    'lama_meminjam' => $item['lama_meminjam'],
                    'tanggal_meminjam' => $item['tanggal_meminjam'],
                    'metode_pembayaran' => $item['metode_pembayaran'],
                ]);

                // Collect unique genres
                $uniqueGenres[] = $dvd->genre;
            }
        }

        // Apply discount if applicable
        $uniqueGenres = array_unique($uniqueGenres);
        if (count($uniqueGenres) >= 3) {
            // Apply 20% discount
            $discount = 0.20;
            $totalPrice *= (1 - $discount);
            $discountMessage = 'Diskon 20% telah diterapkan. Total transaksi: Rp ' . number_format($totalPrice, 0, ',', '.');
        } else {
            $discountMessage = 'Tidak ada diskon yang diterapkan. Total transaksi: Rp ' . number_format($totalPrice, 0, ',', '.');
        }

        return redirect()->route('dashboard')->with('success', $discountMessage);
    }
}


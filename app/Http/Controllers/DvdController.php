<?php

namespace App\Http\Controllers;

use App\Models\Dvd;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DvdController extends Controller
{
    public function index()
    {
        $dvds = Dvd::all();
        return view('dvd.index', compact('dvds'));
    }

    private function generateKode()
    {
        // Generate unique code, for example, using a combination of letters and numbers
        return 'DVD-' . Str::upper(Str::random(6));
    }

    public function create()
    {
        return view('dvd.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tahun_rilis' => 'required|integer',
            'harga_sewa' => 'required|integer',
            'bahasa' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();

        $kode = $this->generateKode();
        $input['kode'] = $kode;

        // Handle cover file upload
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $input['cover'] = $coverPath;
        }
        $kode = $this->generateKode();

        Dvd::create($input);

        return redirect()->route('manajemen-dvd.index')->with('success', 'DVD created successfully');
    }

    public function edit($kode)
    {
        $dvd = Dvd::where('kode', $kode)->firstOrFail();
        return view('dvd.edit', compact('dvd'));
    }


    public function update(Request $request, $kode)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tahun_rilis' => 'required|integer',
            'harga_sewa' => 'required|integer',
            'bahasa' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dvd = Dvd::findOrFail($kode);
        $input = $request->all();

        // Handle cover file upload
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $input['cover'] = $coverPath;
        }

        $dvd->update($input);

        return redirect()->route('manajemen-dvd.index')->with('success', 'DVD updated successfully');
    }

    public function destroy($kode)
    {
        $dvd = Dvd::where('kode', $kode)->firstOrFail();
        $dvd->delete();

        return redirect()->route('manajemen-dvd.index')->with('success', 'DVD berhasil dihapus');
    }

}

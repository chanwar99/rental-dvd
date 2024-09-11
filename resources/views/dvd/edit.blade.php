@extends('layouts.app')

@section('title', 'Edit DVD')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit DVD</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('manajemen-dvd.update', $dvd->kode) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control"
                        value="{{ old('judul', $dvd->judul) }}" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" name="genre" id="genre" class="form-control"
                        value="{{ old('genre', $dvd->genre) }}" required>
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control"
                        value="{{ old('stok', $dvd->stok) }}" required>
                </div>

                <div class="form-group">
                    <label for="tahun_rilis">Tahun Rilis</label>
                    <input type="number" name="tahun_rilis" id="tahun_rilis" class="form-control"
                        value="{{ old('tahun_rilis', $dvd->tahun_rilis) }}" required>
                </div>

                <div class="form-group">
                    <label for="harga_sewa">Harga Sewa</label>
                    <input type="number" name="harga_sewa" id="harga_sewa" class="form-control"
                        value="{{ old('harga_sewa', $dvd->harga_sewa) }}" required>
                </div>

                <div class="form-group">
                    <label for="bahasa">Bahasa</label>
                    <input type="text" name="bahasa" id="bahasa" class="form-control"
                        value="{{ old('bahasa', $dvd->bahasa) }}" required>
                </div>

                <div class="form-group">
                    <label for="cover">Cover</label>
                    <input type="file" name="cover" id="cover" class="form-control">
                    @if ($dvd->cover)
                        <img src="{{ asset('storage/' . $dvd->cover) }}" alt="Cover" width="100">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update DVD</button>
            </form>
        </div>
    </div>
@endsection

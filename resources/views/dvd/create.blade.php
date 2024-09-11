@extends('layouts.app')

@section('title', 'Tambah DVD')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah DVD</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('manajemen-dvd.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="tahun_rilis">Tahun Rilis</label>
                    <input type="number" name="tahun_rilis" id="tahun_rilis" class="form-control"
                        value="{{ old('tahun_rilis') }}" required>
                </div>

                <div class="form-group">
                    <label for="harga_sewa">Harga Sewa</label>
                    <input type="number" name="harga_sewa" id="harga_sewa" class="form-control"
                        value="{{ old('harga_sewa') }}" required>
                </div>

                <div class="form-group">
                    <label for="bahasa">Bahasa</label>
                    <input type="text" name="bahasa" id="bahasa" class="form-control" value="{{ old('bahasa') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="cover">Cover</label>
                    <input type="file" name="cover" id="cover" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Simpan DVD</button>
            </form>
        </div>
    </div>
@endsection

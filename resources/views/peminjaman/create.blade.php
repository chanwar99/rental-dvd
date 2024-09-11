@extends('layouts.app')

@section('title', 'Peminjaman DVD')

@section('content_header')
    <h1>Peminjaman DVD</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Peminjaman</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('peminjaman.store') }}">
                @csrf
                <div id="form-container">
                    <!-- Template for new form fields -->
                    <div class="form-row template">
                        <div class="form-group col-md-3">
                            <label for="kode">Kode DVD</label>
                            <select name="peminjaman[0][kode]" class="form-control" required>
                                @foreach ($dvds as $dvd)
                                    <option value="{{ $dvd->kode }}">{{ $dvd->judul }} ({{ $dvd->kode }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="peminjaman[0][jumlah]" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nama_peminjam">Nama Peminjam</label>
                            <input type="text" name="peminjaman[0][nama_peminjam]" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="alamat_peminjam">Alamat Peminjam</label>
                            <input type="text" name="peminjaman[0][alamat_peminjam]" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="no_kontak_peminjam">No Kontak Peminjam</label>
                            <input type="text" name="peminjaman[0][no_kontak_peminjam]" class="form-control" required>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="lama_meminjam">Lama Meminjam (dalam hari)</label>
                            <input type="number" name="peminjaman[0][lama_meminjam]" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="tanggal_meminjam">Tanggal Meminjam</label>
                            <input type="date" name="peminjaman[0][tanggal_meminjam]" class="form-control" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="metode_pembayaran">Metode Pembayaran</label>
                            <input type="text" name="peminjaman[0][metode_pembayaran]" class="form-control" required>
                        </div>

                        <div class="form-group col-md-1">
                            <button type="button" class="btn btn-danger remove-form"
                                style="margin-top: 32px;">Remove</button>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-success" id="add-form">Add More</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let formIndex = 1;

            document.getElementById('add-form').addEventListener('click', function() {
                let container = document.getElementById('form-container');
                let template = document.querySelector('.template').cloneNode(true);

                template.classList.remove('template');
                template.querySelectorAll('input, select').forEach(function(input) {
                    input.name = input.name.replace(/\[\d\]/, `[${formIndex}]`);
                    input.value = '';
                });

                container.appendChild(template);
                formIndex++;
            });

            document.getElementById('form-container').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-form')) {
                    e.target.closest('.form-row').remove();
                }
            });
        });
    </script>
@endsection
@stop

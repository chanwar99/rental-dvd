@extends('layouts.app')

@section('title', 'Laporan')

@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Peminjaman</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    'Kode DVD',
                    'Nama Peminjam',
                    'Alamat Peminjam',
                    'Kontak',
                    'Jumlah',
                    'Lama Peminjaman (Hari)',
                    'Tanggal Peminjaman',
                    'Metode Pembayaran',
                    'Total Harga (Rp)',
                ];

                $config = [
                    'data' => $peminjaman->map(function ($peminjaman) {
                        $totalHarga = number_format(
                            $peminjaman->lama_meminjam * $peminjaman->dvd->harga_sewa * $peminjaman->jumlah,
                            0,
                            ',',
                            '.',
                        );
                        return [
                            $peminjaman->dvd->kode,
                            $peminjaman->nama_peminjam,
                            $peminjaman->alamat_peminjam,
                            $peminjaman->no_kontak_peminjam,
                            $peminjaman->jumlah,
                            $peminjaman->lama_meminjam,
                            // Ubah format tanggal
                            $peminjaman->tanggal_meminjam,
                            $peminjaman->metode_pembayaran,
                            'Rp ' . $totalHarga,
                            // Hapus tombol Details
                        ];
                    }),
                    'order' => [[1, 'asc']],
                    'columns' => [null, null, null, null, null, null, null, null, ['orderable' => false]],
                    'dom' => 'Bfrtip', // Add export buttons
                    'buttons' => [
                        ['extend' => 'excel', 'text' => 'Export to Excel'],
                        ['extend' => 'pdf', 'text' => 'Export to PDF'],
                    ],
                ];
            @endphp

            {{-- DataTable Component --}}
            <x-adminlte-datatable id="peminjaman-table" :heads="$heads" head-theme="dark" :config="$config" striped
                hoverable bordered compressed with-buttons />

        </div>
    </div>
@endsection

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugins', true) {{-- Enable buttons extension --}}

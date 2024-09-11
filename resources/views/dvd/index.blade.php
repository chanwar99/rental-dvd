@extends('layouts.app')

@section('title', 'Manajemen DVD')

@section('content_header')
    <h1>Manajemen DVD</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('manajemen-dvd.create') }}" class="btn btn-primary">Tambah DVD</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    'Kode DVD',
                    'Judul',
                    'Genre',
                    'Stok',
                    'Tahun Rilis',
                    'Harga Sewa',
                    'Bahasa',
                    ['label' => 'Cover', 'width' => 10],
                    ['label' => 'Aksi', 'no-export' => true, 'width' => 10],
                ];

                $config = [
                    'data' => $dvds->map(function ($dvd) {
                        $btnEdit =
                            '<a href="' .
                            route('manajemen-dvd.edit', $dvd->kode) .
                            '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i> Update
                        </a>';
                        $btnDelete =
                            '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete"
     onclick="event.preventDefault(); if(confirm(\'Are you sure you want to delete this DVD?\')) { document.getElementById(\'delete-form-' .
                            $dvd->kode .
                            '\').submit(); }">
     <i class="fa fa-lg fa-fw fa-trash"></i> Delete
 </button>
 <form id="delete-form-' .
                            $dvd->kode .
                            '" action="' .
                            route('manajemen-dvd.destroy', $dvd->kode) .
                            '" method="POST" style="display:none;">
     ' .
                            csrf_field() .
                            '
     ' .
                            method_field('DELETE') .
                            '
 </form>';

                        return [
                            $dvd->kode,
                            $dvd->judul,
                            $dvd->genre,
                            $dvd->stok,
                            $dvd->tahun_rilis,
                            $dvd->harga_sewa,
                            $dvd->bahasa,
                            '<img src="' . asset('storage/' . $dvd->cover) . '" width="50">',
                            '<nobr>' . $btnEdit . $btnDelete . '</nobr>',
                        ];
                    }),
                    'order' => [[1, 'asc']],
                    'columns' => [null, null, null, null, null, null, null, null, ['orderable' => false]],
                ];
            @endphp

            {{-- DataTable Component --}}
            <x-adminlte-datatable id="dvd-table" :heads="$heads" head-theme="dark" :config="$config" striped hoverable
                bordered compressed />

        </div>
    </div>
@endsection

@section('plugins.Datatables', true)

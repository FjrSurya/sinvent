<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent | Detail {{ $rsetBarang->merk }}</title>
</head>
<body>
@extends('layouts.adm_main')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('/storage/foto_barang/'.$rsetBarang->foto) }}" class="rounded" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="col-md-7">
               <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Merk</td>
                                <td>{{ $rsetBarang->merk }}</td>
                            </tr>
                            <tr>
                                <td>Seri</td>
                                <td>{{ $rsetBarang->seri }}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>{{ $rsetBarang->spesifikasi }}</td>
                            </tr>   
                            @foreach($rsetKategori as $kategori)
                            <tr>
                                <td>Kategori</td>
                                <td>{{ $kategori->kategori->kategori }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>Keterangan</td>
                                <td>{{ $rsetBarang->kategori->deskripsi }}</td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td>{{ $rsetBarang->stok }}</td>
                            </tr>
                        </table>

                    </div>
               </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12  text-left">
                <a href="{{ route('v_barang.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection
</body>
</html>
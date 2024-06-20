<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent | {{ $rsetBrmasuk->barang->merk }}</title>
</head>
<body>
@extends('layouts.adm_main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Merk</td>
                                <td>{{ $rsetBrmasuk->barang->merk }}</td>
                            </tr>
                            <tr>
                                <td>Seri</td>
                                <td>{{ $rsetBrmasuk->barang->seri }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>
                                @foreach($rsetKategori as $kategori)
                                {{ $kategori->deskripsi }}
                                @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td>{{ $rsetBrmasuk->barang->stok }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Masuk</td>
                                <td>{{ $rsetBrmasuk->tgl_masuk }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Barang Masuk</td>
                                <td>{{ $rsetBrmasuk->qty_masuk }}</td>
                            </tr>
                        </table>
                    </div>
               </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12  text-left">
                <a href="{{ route('brmasuk.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection
</body>
</html>
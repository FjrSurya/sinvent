<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent | Detail {{ $rsetKategori->deskripsi }}</title>
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
                                <td>Kategori</td>
                                <td>{{ $rsetKategori->ketkategori }}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>{{ $rsetKategori->deskripsi }}</td>
                            </tr>
                        </table>
                    </div>
               </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12  text-left">
                <a href="{{ route('v_kategori.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection
</body>
</html>
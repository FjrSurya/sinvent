<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent | Dashboard</title>
    <style>
        .card-deck {
            margin-top: 50px;
        }
        .card {
            width: 250px;
            height: 150px; 
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-body {
            text-align: center;
        }
        p{
            font-size: 50px;
        }
    </style>
</head>
<body>
@extends('layouts.adm_main') 
 
@section('content') 
    <br><br>
    <div class="welcome text-center">
        <p>WELCOME TO SINVENT</p>
        <p>SIJA INVENTORY APPLICATION</p>
    </div>
    <div class="container">
        <div class="row col-lg-12 justify-content-center">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">KATEGORI</h5><br>
                        <a href="{{ route('v_kategori.index') }}" class="btn btn-md btn-primary mb-3">Lihat</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">BARANG</h5><br>
                        <a href="{{ route('v_barang.index') }}" class="btn btn-md btn-primary mb-3">Lihat</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">BARANG MASUK</h5><br>
                        <a href="{{ route('brmasuk.index') }}" class="btn btn-md btn-primary mb-3">Lihat</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">BARANG KELUAR</h5><br>
                        <a href="{{ route('brkeluar.index') }}" class="btn btn-md btn-primary mb-3">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent | Create Kategori</title>
</head>
<body>
@extends('layouts.adm_main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('v_kategori.store') }}" method="POST" enctype="multipart/form-data">                    
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">NAMA KATEGORI</label>
                                <div class="form-check">
                                    <select class="form-select" name="kategori" aria-label="Default select example">
                                        <option value="blank" selected>Pilih Kategori</option>
                                        <option value="A">A - Alat</option>
                                        <option value="M">M - Barang Modal</option>
                                        <option value="BHP">BHP - Barang Habis Pakai</option>
                                        <option value="BTHP">BTHP - Barang Tidak Habis Pakai</option>
                                    </select>
                                <!-- error message untuk kategori -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <br><br>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">DESKRIPSI</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('kategori') }}" placeholder="Masukkan kategori">

                                <!-- error message untuk kategori -->
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>               
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{route('v_kategori.index')}}" class="btn btn-md btn-success">BACK</a>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>
</html>
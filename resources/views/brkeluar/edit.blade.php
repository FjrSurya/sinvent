<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent  {{ $rsetBrkeluar->barang->merk }}</title>
</head>
<body>
@extends('layouts.adm_main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('brkeluar.update',$rsetBrkeluar->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">MERK</label>
                                <!-- <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ old('merk',$rsetBrkeluar->barang->merk) }}" placeholder="Masukkan Merk"> -->

                                <input type="text" class="form-control" value="{{ $rsetBrkeluar->barang->merk }}" readonly>
                                
                                <!-- Input hidden untuk menyimpan nilai barang_id -->
                                <input type="hidden" name="barang_id" value="{{ $rsetBrkeluar->barang_id }}">


                                <!-- error message untuk merk -->
                                @error('merk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- <div class="form-group">
                                <label class="font-weight-bold">SERI</label>
                                <input type="text" class="form-control @error('seri') is-invalid @enderror" name="seri" value="{{ old('seri',$rsetBrkeluar->barang->seri) }}" placeholder="Masukkan Spesifikasi"> -->

                                <!-- error message untuk nis -->
                                <!-- @error('seri')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> -->
<!-- 
                            <div class="form-group">
                                <label class="font-weight-bold">STOK</label>
                                <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok', $rsetBrkeluar->barang->stok) }}" placeholder="Masukkan stok"> -->

                                <!-- error message untuk stok -->
                                <!-- @error('stok')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> -->


                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL KELUAR</label>
                                <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar', $rsetBrkeluar->tgl_keluar) }}" placeholder="Masukkan Tanggal">
                                <!-- error message untuk tanggal keluar -->
                                @error('tgl_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
<?php
    use App\Models\Barang;
    
?>
                            <div class="form-group">
                                <label class="font-weight-bold">JUMLAH KELUAR</label>
                                <input type="number" max="{{$rsetBrkeluar->stok}}" class="form-control @error('qty_keluar') is-invalid @enderror" name="qty_keluar" value="{{ old('qty_keluar', $rsetBrkeluar->qty_keluar) }}" placeholder="Masukkan Jumlah Barang Masuk">
                                <!-- error message untuk tanggal keluar -->
                                @error('qty_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{route('brkeluar.index')}}" class="btn btn-md btn-success">BACK</a>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
</body>
</html>
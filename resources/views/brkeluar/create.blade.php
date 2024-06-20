<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent | Create Barang Keluar</title>
</head>
<body>
@extends('layouts.adm_main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('brkeluar.store') }}" method="POST" enctype="multipart/form-data">                    
                            @csrf
                            
                            <div class="form-group"> 
                                <label class="font-weight-bold">PILIH BARANG</label>
                                <div class="form-check">
                                    <select class="form-select" name="barang_id" aria-label="Default select example">
                                        <option value="blank" selected>Pilih Barang</option>
                                        @foreach ($brcr as $barang)
                                            <option value="{{ $barang->id }}">{{ $barang->merk }} - {{ $barang->seri }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- error message untuk barang keluar -->
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL KELUAR</label>
                                <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar') }}" placeholder="Masukkan Tanggal">
                                <!-- error message untuk tanggal keluar -->
                                @error('tgl_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
		            
			                <div class="form-group">
                                <label class="font-weight-bold">JUMLAH KELUAR</label>
                                <input type="number" min="1" class="form-control @error('qty_keluar') is-invalid @enderror" name="qty_keluar" value="{{ old('qty_keluar') }}" placeholder="Masukkan Jumlah Barang Keluar">
                                <!-- error message untuk qty keluar -->
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
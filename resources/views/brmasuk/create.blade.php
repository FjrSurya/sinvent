<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent | Create Barang Masuk</title>
</head>
<body>
@extends('layouts.adm_main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('brmasuk.store') }}" method="POST" enctype="multipart/form-data">                    
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
                                <!-- error message untuk barang masuk -->
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL MASUK</label>
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('tgl_masuk') }}" placeholder="Masukkan Tanggal">
                                <!-- error message untuk tanggal masuk -->
                                @error('tgl_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
		            
			    <div class="form-group">
                                <label class="font-weight-bold">JUMLAH MASUK</label>
                                <input type="number" min="1" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk" value="{{ old('qty_masuk') }}" placeholder="Masukkan Jumlah Barang Masuk">
                                <!-- error message untuk tanggal masuk -->
                                @error('qty_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

				
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{route('brmasuk.index')}}" class="btn btn-md btn-success">BACK</a>

                        </form> 
                    </div>
                </div>

 

            </div>
        </div>
    </div>
@endsection
</body>
</html>
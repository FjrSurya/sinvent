<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang KELUAR</title>
</head>

<body>
    @extends('layouts.adm_main')

    @section('content')
    <div class="container">
        <h1>Daftar Barang Keluar</h1>
        <div class="card">
             
            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
            @endif
        
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
            @endif

            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('brkeluar.create') }}" class="btn btn-md btn-success">KURANGI STOK BARANG</a>
                    <form class="form-inline" action="{{ route('brkeluar.search') }}" method="GET">
                        <input class="form-control bg-light border-0 small mr-2" type="text" name="query" placeholder="Cari Barang Keluar...">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>MERK</th>
                    <th>TANGGAL KELUAR</th>
                    <th>QTY KELUAR</th>
                    <th style="width: 15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rsetBrkeluar as $rowbrkeluar)
                <tr>
                    <td>{{ $rowbrkeluar->barang->merk  }} {{ $rowbrkeluar->barang->seri  }}</td>
                    <td>{{ $rowbrkeluar->tgl_keluar }}</td>                    
                    <td>{{ $rowbrkeluar->qty_keluar }}</td>
                    <td class="text-center">  
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('brkeluar.destroy', $rowbrkeluar->id) }}" method="POST"> 
                             <a href="{{ route('brkeluar.show', $rowbrkeluar->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a> 
                             <a href="{{ route('brkeluar.edit', $rowbrkeluar->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a> 
                                 @csrf 
                                 @method('DELETE') 
                             <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> 
                         </form> 
                    </td> 
                                  
                </tr> 
                @empty 
                    <div class="alert"> 
                        Data barang belum tersedia 
                    </div> 
                @endforelse
            </tbody>
        </table>
        {{ $rsetBrkeluar->links() }}
    </div>
    @endsection
</body>
</html>
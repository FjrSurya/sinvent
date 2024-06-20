<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent | Kategori</title>
</head>
<body>
    @extends('layouts.adm_main')
    @section('content')
    <div class="container" title="kategori">
        <h1>Daftar Kategori</h1>
        <div class="card">
            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
            @endif

            <div class="row card-body">
                <a href="{{ route('v_kategori.create') }}" class="btn btn-md btn-success mb-3">TAMBAH KATEGORI</a>
                <form class="d-none d-sm-inline-block form-inline mr-md-3 ml-auto my-2 my-md-0 mw-100 navbar-search" action="{{ route('kategori.search') }}" method="GET">
                    <input class="form-control bg-light border-0 small" type="text" name="query" placeholder="Cari Kategori...">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th style="width: 15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rsetKategori as $rowkategori)
                <tr>
                    <td>{{ $rowkategori->id }}</td>
                    <td>{{ $rowkategori->kategori}}</td>                    
                    <td>{{ $rowkategori->deskripsi }}</td>
                    <td class="text-center">  
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('v_kategori.destroy', $rowkategori->id) }}" method="POST"> 
                             <a href="{{ route('v_kategori.show', $rowkategori->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a> 
                             <a href="{{ route('v_kategori.edit', $rowkategori->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a> 
                                 @csrf 
                                 @method('DELETE') 
                             <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> 
                         </form> 
                    </td>               
                </tr> 
                @empty 
                    <div class="alert"> 
                        Data kategori belum tersedia 
                    </div> 
                @endforelse
            </tbody>
        </table>
        {{ $rsetKategori->links() }}
    </div>
    @endsection
</body>
</html>
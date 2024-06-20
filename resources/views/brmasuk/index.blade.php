<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent | Barang Masuk</title>
</head>

<body>
    @extends('layouts.adm_main')

    @section('content')
    <div class="container">
        <h1>Daftar Barang Masuk</h1>
        <div class="card">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
            @endif

            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('brmasuk.create') }}" class="btn btn-md btn-success">KURANGI STOK BARANG</a>
                    <form class="form-inline" action="{{ route('brmasuk.search') }}" method="GET">
                        <input class="form-control bg-light border-0 small mr-2" type="text" name="query" placeholder="Cari Barang Masuk...">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>MERK</th>
                    <th>TANGGAL MASUK</th>
                    <th>QTY MASUK</th>
                    <th style="width: 15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rsetBrmasuk as $rowbrmasuk)
                <tr>
                    <td>{{ $rowbrmasuk->barang->merk  }} {{ $rowbrmasuk->barang->seri  }}</td>
                    <td>{{ $rowbrmasuk->tgl_masuk }}</td>                    
                    <td>{{ $rowbrmasuk->qty_masuk }}</td>
                    <td class="text-center">  
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('brmasuk.destroy', $rowbrmasuk->id) }}" method="POST"> 
                             <a href="{{ route('brmasuk.show', $rowbrmasuk->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a> 
                             <a href="{{ route('brmasuk.edit', $rowbrmasuk->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a> 
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
        {{ $rsetBrmasuk->links() }}
    </div>
    @endsection
</body>

</html>
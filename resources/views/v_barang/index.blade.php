<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinvent | Barang</title>
</head>

<body>
    @extends('layouts.adm_main')

    @section('content')
    <div class="container">
        <h1>Daftar Barang</h1>
        <div class="card">
            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
            @endif

            <div class="row card-body">
                <a href="{{ route('v_barang.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG</a>
                <form class="d-none d-sm-inline-block form-inline mr-md-3 ml-auto my-2 my-md-0 mw-100 navbar-search" action="{{ route('barang.search') }}" method="GET">
                    <input class="form-control bg-light border-0 small" type="text" name="query" placeholder="Cari Barang...">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Merk</th>
                    <th>Seri</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Gambar</th>
                    <th style="width: 15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rsetBarang as $rowbarang)
                <tr>
                    <td>{{ $rowbarang->id }}</td>
                    <td>{{ $rowbarang->merk }}</td>
                    <td>{{ $rowbarang->seri }}</td>
                    <td>{{ $rowbarang->kategori->kategori}}</td>                    
                    <td>{{ $rowbarang->kategori->deskripsi }}</td>
                    <td class="text-center">
                                            <img src="{{ asset('/storage/foto_barang/'.$rowbarang->foto) }}" class="rounded" style="width: 150px">
                    </td>

                    <td class="text-center">  
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('v_barang.destroy', $rowbarang->id) }}" method="POST"> 
                             <a href="{{ route('v_barang.show', $rowbarang->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a> 
                             <a href="{{ route('v_barang.edit', $rowbarang->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a> 
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
        {{ $rsetBarang->links() }}
    </div>
    @endsection

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>

</body>

</html>
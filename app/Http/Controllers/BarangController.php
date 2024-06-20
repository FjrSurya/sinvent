<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Brmasuk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
     use ValidatesRequests;

    public function index()
    {
        $rsetBarang = Barang::select()->paginate(100);
        return view('v_barang.index',compact('rsetBarang'));
    }

    public function create()
    {
        $aKategori = Kategori::all();
        return view('v_barang.create',compact('aKategori'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'merk'              => 'required',
            'seri'              => 'required|unique:barang',
            'spesifikasi'       => 'required|unique:barang',
            'kategori_id'       => 'required',
            'foto'              => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // //upload image
        $foto = $request->file('foto');
        $foto->storeAs('public/foto_barang', $foto->hashName());

        Barang::create([
            'merk'          => $request->merk,
            'seri'          => $request->seri,
            'spesifikasi'   => $request->spesifikasi,
            'kategori_id'   => $request->kategori_id,
            'foto'          => $foto->hashName()
        ]);

        return redirect()->route('v_barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(Request $request, string $id)
    {
        $rsetKategori = Barang::with('kategori')->where('id', '=', $id)->paginate(100);
        $rsetBarang = Barang::findOrFail($id);
        return view('v_barang.show', compact('rsetBarang', 'rsetKategori'));
    }

    public function edit(string $id)
    {
        $aKategori = Kategori::all();
        $rsetBarang = Barang::findOrFail($id);
        return view('v_barang.edit', compact('rsetBarang','aKategori'));

    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'merk'              => 'required',
            'seri'              => 'required',
            'spesifikasi'       => 'required',
            'kategori_id'       => 'required',
            'foto'              => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $rsetBarang = Barang::findOrFail($id);
        // check if image is uploaded
        if ($request->hasFile('foto')) {

            //upload new image
            $foto = $request->file('foto');
            $foto->storeAs('public/foto_barang', $foto->hashName());

            //delete old image
            Storage::delete('public/foto_barang/'.$rsetBarang->foto);

            //update post with new image
            $rsetBarang->update([
                'merk'          => $request->merk,
                'seri'          => $request->seri,
                'spesifikasi'   => $request->spesifikasi,
                'kategori_id'   => $request->kategori_id,
                'foto'          => $foto->hashName(),
            ]);
        }else {
            //update post without image
            $rsetBarang->update([
                'merk'          => $request->merk,
                'seri'          => $request->seri,
                'spesifikasi'   => $request->spesifikasi,
                'kategori_id'   => $request->kategori_id,
            ]);
        }
        return redirect()->route('v_barang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $rsetBarang = Barang::where('merk', 'like', "%{$query}%")   
                            ->orWhere('seri', 'like', "%{$query}%")
                            ->orWhere('spesifikasi', 'like', "%{$query}%")
                            ->paginate(100);
        return view('v_barang.index', compact('rsetBarang'));
    }

    public function destroy(string $id)
    {
        if (DB::table('barangmasuk')->where('barang_id', $id)->exists()) {
            return redirect()->route('v_barang.index')->with(['error' => 'Data gagal dihapus! Stok Barang masih ada.']);
        } else {
            $rsetBarang = Barang::find($id);
            //delete image
            Storage::delete('public/foto_barang/'. $rsetBarang->foto);
            $rsetBarang->delete();
            return redirect()->route('v_barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}   
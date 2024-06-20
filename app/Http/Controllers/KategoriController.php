<?php
namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Barang;

class KategoriController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        // $rsetKategori = Kategori::find($id);

        // $rsetKategori = Kategori::select('id','kategori','deskripsi',
        //     \DB::raw('(CASE
        //         WHEN deskripsi = "M" THEN "Modal"
        //         WHEN deskripsi = "A" THEN "Alat"
        //         WHEN deskripsi = "BHP" THEN "Bahan Habis Pakai"
        //         ELSE "Bahan Tidak Habis Pakai"
        //         END) AS ketKategori'))
        //     ->paginate(100);
        $rsetKategori = Kategori::getKategoriAll();
        return view('v_kategori.index', compact('rsetKategori'));

    }

    public function create()
    {
        return view('v_kategori.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|in:A,M,BHP,BTHP',
            'deskripsi' => 'required|unique:kategori',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            //Mulai transaction
            DB::beginTransaction();
            //masukkan data kedalam tabel kategori
            Kategori::create([
                'kategori' => $request->kategori,
                'deskripsi' => $request->deskripsi,
            ]);
            DB::commit();
            return redirect()->route('v_kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }catch (\Exception $a){
            report($a);
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Data Gagal Disimpan!']);
        }

        // $this->validate($request, [
        //     'kategori'   => 'required',
        //     'deskripsi'  => 'required|unique:kategori',
        // ]);

        // //create post
        // Kategori::create([
        //     'kategori'  => $request->kategori,
        //     'deskripsi' => $request->deskripsi,
        // ]);

        // //redirect to index
        // return redirect()->route('v_kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        // $rsetKategori = Kategori::find($id);
        // $rsetKategori = Kategori::select('id','kategori','deskripsi',
        //     \DB::raw('(CASE
        //         WHEN kategori = "M" THEN "Modal"
        //         WHEN kategori = "A" THEN "Alat"
        //         WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
        //         ELSE "Bahan Tidak Habis Pakai"
        //         END) AS ketKategori'))
        //         ->where('id', '=', $id)
        //         ->first();
        $rsetKategori = Kategori::getKategoriAll()->where('id', '=', $id)->first();
        return view('v_kategori.show', compact('rsetKategori'));
    }

    public function edit(string $id)
    {
        $rsetKategori = Kategori::find($id);
        $aaa = Kategori::all();
        $aKategori = array('blank'=>'Pilih Kategori',
                        'M'=>'Barang Modal',
                        'A'=>'Alat',
                        'BHP'=>'Bahan Habis Pakai',
                        'BTHP'=>'Bahan Tidak Habis Pakai'
        );
        return view('v_kategori.edit', compact('aKategori','rsetKategori', 'aaa'));

    }

    public function update(Request $request, string $id)
    {
            $rsetKategori = Kategori::find($id);
            $rsetKategori->update([
                'kategori'  => $request->kategori,
                'deskripsi' =>$request->deskripsi,
            ]);
        return redirect()->route('v_kategori.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $rsetKategori = Kategori::where('kategori', 'like', "%{$query}%")
                                ->orWhere('deskripsi', 'like', "%{$query}%")
                                ->paginate(100);
        return view('v_kategori.index', compact('rsetKategori'));
    }

    public function destroy($id): RedirectResponse
    {
        $rsetKategori = Kategori::findOrFail($id);
        if (DB::table('barang')->where('kategori_id', $id)->exists()) {
            return redirect()->route('v_kategori.index')->with(['error' => 'Data gagal dihapus! Kategori sedang digunakan.']);
        } else {
            $rsetKategori->delete();
            return redirect()->route('v_kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }

    function updateAPIKategori(Request $request, $kategori_id){
        $kategori = Kategori::find($kategori_id);
        if (null == $kategori){
            return response()->json(['status'=>"kategori tidak ditemukan"]);
        }
         $kategori->kategori= $request->kategori;
         $kategori->deskripsi = $request->deskripsi;
         $kategori->save();
        return response()->json(["status"=>"kategori berhasil diubah"]);
    }

    function showAPIKategori(Request $request){
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    function detailAPIKategori($id){
        $detail_kategori = Kategori::findOrFail($id);
        return response()->json($detail_kategori);
    }

    function createAPIKategori(Request $request){
        $request->validate([
            'kategori' => 'required|in:M,A,BHP,BTHP',
            'deskripsi' => 'required|string|max:100',
        ]);
        $kat = Kategori::create([
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ]);
        return response()->json(["status"=>"data berhasil dibuat"]);
    }

    function deleteAPIKategori($kategori_id){
        $del_kategori = Kategori::findOrFail($kategori_id);
        $del_kategori -> delete();
        return response()->json(["status"=>"data berhasil dihapus"]);
    }
} 
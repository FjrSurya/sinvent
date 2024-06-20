<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use App\Models\Brkeluar;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BrkeluarController extends Controller
{
    use ValidatesRequests;

    public function index(){
    $rsetBrkeluar = Brkeluar::latest()->paginate(100);
    return view('brkeluar.index', compact('rsetBrkeluar'));
    }

    public function create(){
        $brcr = Barang::all();
        return view('brkeluar.create', compact('brcr'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'tgl_keluar'     => 'required',
            'qty_keluar'     => 'required',
            'barang_id'     => 'required',
        ]);
        $barang = Barang::find($request->barang_id);
        if ($barang->brmasuk()->count() == 0) {
            return redirect()->back()->withInput()->withErrors(['barang_id' => 'Stok Barang tidak tersedia, tidak bisa mengurangi barang!']);
        }

        //Validasi jika jumlah qty_keluar lebih besar dari stok saat itu maka muncul pesan eror
        if ($request->qty_keluar > $barang->stok) {
            return redirect()->back()->withInput()->withErrors(['qty_keluar' => 'Jumlah barang keluar melebihi stok!']);
        }
        $barangMasukTerakhir = $barang->brmasuk()->latest('tgl_masuk')->first();
        if ($barangMasukTerakhir && $request->tgl_keluar < $barangMasukTerakhir->tgl_masuk) {
            return redirect()->back()->withErrors(['tgl_keluar' => 'Barang Keluar tidak boleh mendahului Barang Masuk.'])->withInput();
        }

        Brkeluar::create ([
            'tgl_keluar'        => $request->tgl_keluar,
            'qty_keluar'        => $request->qty_keluar,
            'barang_id'        => $request->barang_id,
        ]);
        return redirect()->route('brkeluar.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        $rsetKategori = Kategori::all();
        $rsetBrkeluar = Brkeluar::find($id);
        return view('brkeluar.show', compact('rsetBrkeluar', 'rsetKategori'));
    }

    public function edit(string $id)
    {
        $rsetBrkeluar = Brkeluar::find($id);
        $aBarang = Barang::find($rsetBrkeluar->barang_id);
        //return $rsetBarang;
        return view('brkeluar.edit', compact('rsetBrkeluar','aBarang'));
    }

    public function update(Request $request, string $id){
        $validate = Validator::make($request->all(), [
            'tgl_keluar' => 'required',
            'qty_keluar' => 'required',
            'barang_id'  => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $rsetBrkeluar = Brkeluar::find($id);
        $barang = Barang::findOrFail($request->barang_id);
        $barangMasukTerakhir = $barang->brmasuk()->latest('tgl_masuk')->first();
        if ($barangMasukTerakhir && $request->tgl_keluar < $barangMasukTerakhir->tgl_masuk) {
            return redirect()->back()->withErrors(['tgl_keluar' => 'Tanggal barang keluar tidak boleh mendahului tanggal barang masuk terakhir.'])->withInput();
        }

    // Hitung stok baru setelah pengeditan
    $stokSetelahEdit = ($barang->stok + $rsetBrkeluar->qty_keluar) - $request->qty_keluar;
    // Validasi stok baru tidak boleh kurang dari 0
    if ($stokSetelahEdit < 0) {
        return redirect()->back()->withErrors(['qty_keluar' => 'Jumlah barang keluar melebihi stok yang tersedia!'])->withInput();
    }
        $barang->stok = $stokSetelahEdit;
            $rsetBrkeluar->update([
                'tgl_keluar' => $request->tgl_keluar,
                'qty_keluar' => $request->qty_keluar,
                'baranf_id'  => $request->barang_id,
            ]);
        return redirect()->route('brkeluar.index')->with(['success' => 'Data berhasil diubah!']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $rsetBrkeluar = Brkeluar::whereHas('barang', function ($q) use ($query) {
                                    $q->where('merk', 'like', "%{$query}%")
                                      ->orWhere('seri', 'like', "%{$query}%")
                                      ->orWhere('spesifikasi', 'like', "%{$query}%");
                                })
                                ->orWhere('tgl_keluar', 'like', "%{$query}%")
                                ->paginate(100);
        return view('brkeluar.index', compact('rsetBrkeluar'));
    }

    public function destroy($id){
        Brkeluar::findOrFail($id)->delete();
        return redirect()->route('brkeluar.index')->with(['success'=>'Data barang berhasil dihapus.']);
    }
}
<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use App\Models\Brmasuk;
use App\Models\Brkeluar;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BrmasukController extends Controller
{
    use ValidatesRequests;

    public function index(){
    $rsetBrmasuk = Brmasuk::latest()->paginate(100);
    return view('brmasuk.index', compact('rsetBrmasuk'));
    }

    public function create(){
        $brcr = Barang::all();
        return view('brmasuk.create', compact('brcr'));
    }

    public function store(Request $request){
        $request->validate([
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required',
            'barang_id' => 'required',
        ]);

        Brmasuk::create([
            'tgl_masuk' => $request->tgl_masuk,
            'qty_masuk' => $request->qty_masuk,
            'barang_id' => $request->barang_id,
        ]);   
        return redirect()->route('brmasuk.index')->with('success', 'Data barang berhasil masukkan');
    }

    public function show(Request $request, string $id)
    {
        $rsetBrmasuk = Brmasuk::findOrFail($id);
        $rsetKategori = Kategori::all();

       return view('brmasuk.show', compact('rsetBrmasuk', 'rsetKategori'));
    }

    public function edit(string $id)
    {
        $rsetBrmasuk = Brmasuk::findOrFail($id);
        $aBarang = Barang::all();
        //return $rsetBarang;
        return view('brmasuk.edit', compact('rsetBrmasuk','aBarang'));
    }

    public function update(Request $request, string $id){
        $validate = Validator::make($request->all(), [
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required',
            'barang_id' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $rsetBrmasuk = Brmasuk::findOrFail($id);
        $barang = Barang::findOrFail($request->barang_id);
        $totalBrkeluar = Brkeluar::where('barang_id', $request->barang_id)->sum('qty_keluar');

        // Hitung stok baru setelah pengeditan
        $stokSetelahEdit = ($barang->stok - $rsetBrmasuk->qty_masuk) + $request->qty_masuk;
    
        // Validasi stok baru tidak boleh kurang dari jumlah barang keluar
        if ($stokSetelahEdit < $totalBrkeluar) {
            return redirect()->back()->withErrors(['qty_masuk' => 'Jumlah stok tidak boleh kurang dari jumlah barang yang sudah keluar!'])->withInput();
        }
        $barang->stok = $stokSetelahEdit;
        
        $rsetBrmasuk->update([
            'tgl_masuk' => $request->tgl_masuk,
            'qty_masuk' => $request->qty_masuk,
            'barang_id' => $request->barang_id,
        ]);
        return redirect()->route('brmasuk.index')->with(['success' => 'Data berhasil diubah!']);
    }

    public function search(Request $request)
    {
    $query = $request->input('query');
    // Query untuk mencari barang masuk berdasarkan merk atau tanggal masuk
    $rsetBrmasuk = Brmasuk::whereHas('barang', function ($q) use ($query) {
                            $q->where('merk', 'like', "%{$query}%");
                        })
                        ->orWhere('tgl_masuk', 'like', "%{$query}%")
                        ->paginate(10); // Sesuaikan dengan jumlah yang diinginkan
    return view('brmasuk.index', compact('rsetBrmasuk'));
    }

    public function destroy($id){
        $rsetBrmasuk = Brmasuk::findOrFail($id);
        $brkeluar = Brkeluar::where('barang_id', $rsetBrmasuk->barang_id)->first();
        if ($brkeluar) {
            return redirect()->route('brmasuk.index')->withErrors(['error' => 'Data barang masuk tidak dapat dihapus karena barang tersebut sudah digunakan dalam barang keluar.']);
        }
        $rsetBrmasuk->delete();
        return redirect()->route('brmasuk.index')->with('success', 'Data barang berhasil dihapus.');
    }
}
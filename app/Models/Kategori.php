<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = ['kategori','deskripsi'];
    protected $primaryKey = 'id';
    
    public static function getKategoriAll(){
        return Kategori::with('barang')
            ->select('id','kategori','deskripsi',DB::raw('ketKategoriko(kategori) as ketkategori'))
            ->paginate(100);
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kategori_id', 'id');
    }
}
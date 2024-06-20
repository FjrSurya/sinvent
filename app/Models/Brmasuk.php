<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Brmasuk extends Model
{
    use HasFactory;
    protected $table = 'barangmasuk';
    protected $fillable = ['tgl_masuk', 'qty_masuk', 'barang_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function barang(){
        return $this->belongsTo('App\Models\Barang', 'barang_id', 'id');
        return $this->belongsTo(Barang::class);
    }
}
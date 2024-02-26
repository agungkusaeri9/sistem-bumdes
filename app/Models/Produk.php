<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $guarded = ['id'];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function galeri()
    {
        return $this->hasMany(GaleriProduk::class, 'produk_id', 'id');
    }

    public function gambar()
    {
        return asset('storage/' . $this->gambar);
    }

    public function ulasan()
    {
        return $this->hasMany(ProdukUlasan::class,'produk_id','id');
    }
}

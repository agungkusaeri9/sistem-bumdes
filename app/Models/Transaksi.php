<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->status;
    }

    public function metode_pembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }
}

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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        if ($this->status === 'PENDING') {
            return '<span class="badge badge-warning">PENDING</span>';
        } elseif ($this->status === 'DIKIRIM') {

            return '<span class="badge badge-info">DIKIRIM</span>';
        } elseif ($this->status === 'SELESAI') {
            return '<span class="badge badge-success">SELESAI</span>';
        } else {
            return '<span class="badge badge-danger">GAGAL</span>';
        }
    }

    public function metode_pembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ProdukUlasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function store(){
        request()->validate([
            'produk_id' => ['required'],
            'nilai' => ['required']
        ]);

        ProdukUlasan::create([
            'transaksi_id' => request('transaksi_id'),
            'detail_transaksi_id' => request('detail_transaksi_id'),
            'produk_id' => request('produk_id'),
            'nilai' => request('nilai'),
            'ulasan' => request('ulasan'),
            'user_id' => auth()->id()
        ]);

        return redirect()->back()->with('success','Anda berhasil membuat ulasan.');
    }
}

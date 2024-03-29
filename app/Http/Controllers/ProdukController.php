<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $keyword = request('keyword');
        $produk = Produk::latest();
        if($keyword)
        {
            $produk->where('nama','LIKE','%' . $keyword . '%');
        }else{
            $produk->whereNotNull('id');
        }
        $items = $produk->paginate(8);
        $data_jenis = Jenis::orderBy('nama', 'ASC')->get();
        return view('pages.produk.index', [
            'title' => 'Semua Produk',
            'items' => $items,
            'data_jenis' => $data_jenis
        ]);
    }

    public function jenis($slug)
    {
        $items = Produk::whereHas('jenis', function($q) use ($slug){
            $name = str_replace("-"," ", $slug);
            $q->where('nama',$name);
        })->latest()->paginate(8);
        $data_jenis = Jenis::orderBy('nama', 'ASC')->get();
        return view('pages.produk.jenis', [
            'title' => 'Jenis Produk ',
            'items' => $items,
            'data_jenis' => $data_jenis
        ]);
    }

    public function show($slug)
    {
        $item = Produk::where('slug', $slug)->firstOrFail();
        return view('pages.produk.show', [
            'title' => 'Semua Produk',
            'item' => $item
        ]);
    }
}

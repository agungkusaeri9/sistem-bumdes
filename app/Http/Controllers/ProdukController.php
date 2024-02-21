<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('pages.produk.index', [
            'title' => 'Semua Produk'
        ]);
    }

    public function show()
    {
        return view('pages.produk.show', [
            'title' => 'Semua Produk'
        ]);
    }
}

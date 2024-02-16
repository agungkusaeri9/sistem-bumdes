<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriProdukController extends Controller
{
    public function index($produk_id)
    {
        $title = 'Galeri Produk';
        $items = GaleriProduk::where('produk_id', $produk_id)->get();
        $produk = Produk::findOrFail($produk_id);
        return view('admin.pages.galeri-produk.index', compact('title', 'items', 'produk'));
    }

    public function store($produk_id)
    {
        request()->validate([
            'gambar' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);

        GaleriProduk::create([
            'produk_id' => $produk_id,
            'gambar' => request()->file('gambar')->store('galeri-produk', 'public')
        ]);

        return redirect()->back()->with('success', 'Galeri Produk berhasil disimpan.');
    }

    public function destroy($id)
    {
        $item = GaleriProduk::findOrFail($id);
        if ($item->gambar)
            Storage::disk("public")->delete($item->gambar);
        $item->delete();
        return redirect()->back()->with('success', 'Galeri Produk berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use App\Models\Produk;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Js;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Produk::orderBy('nama', 'ASC')->get();
        return view('admin.pages.produk.index', [
            'title' => 'Data Produk',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_jenis = Jenis::get();
        $data_satuan = Satuan::get();
        return view('admin.pages.produk.create', [
            'title' => 'Tambah Produk',
            'data_jenis' => $data_jenis,
            'data_satuan' => $data_satuan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nama' => ['required'],
            'jenis_id' => ['required'],
            'satuan_id' => ['required'],
            'stok_awal' => ['required'],
            'harga' => ['required'],
            'deskripsi' => ['required'],
            'berat' => ['required'],
            'gambar' => ['required', 'image', 'mimes:jpg,png,jpeg,svg', 'max:2048'],
        ]);
        $data = request()->except(['gambar']);
        $data['slug'] = \Str::slug(request('nama')) . rand(100, 200);
        $data['stok'] = request('stok_awal');
        $data['gambar'] = request()->file('gambar')->store('produk', 'public');
        Produk::create($data);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Produk::findOrFail($id);
        $data_jenis = Jenis::get();
        $data_satuan = Satuan::get();
        return view('admin.pages.produk.edit', [
            'title' => 'Edit Produk',
            'item' => $item,
            'data_jenis' => $data_jenis,
            'data_satuan' => $data_satuan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'nama' => ['required'],
            'jenis_id' => ['required'],
            'satuan_id' => ['required'],
            'harga' => ['required'],
            'deskripsi' => ['required'],
            'gambar' => ['image', 'mimes:jpg,png,jpeg,svg', 'max:2048'],
            'berat' => ['required']
        ]);
        $item = Produk::findOrFail($id);
        $data = request()->except(['gambar']);
        if (request()->file('gambar')) {
            if ($item->gambar)
                Storage::disk("public")->delete($item->gambar);
            $data['gambar'] = request()->file('gambar')->store('produk', 'public');
        }
        $item->update($data);
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Produk::findOrFail($id);
        if ($item->gambar)
            Storage::disk("public")->delete($item->gambar);
        $item->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}

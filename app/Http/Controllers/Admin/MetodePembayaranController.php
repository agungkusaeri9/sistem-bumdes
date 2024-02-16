<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = MetodePembayaran::orderBy('nama', 'ASC')->get();
        return view('admin.pages.metode-pembayaran.index', [
            'title' => 'Data Metode Pembayaran',
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
        return view('admin.pages.metode-pembayaran.create', [
            'title' => 'Tambah Metode Pembayaran'
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
            'nama' => ['required']
        ]);
        $data = request()->all();
        MetodePembayaran::create($data);
        return redirect()->route('admin.metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil ditambahkan.');
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
        $item = MetodePembayaran::findOrFail($id);
        return view('admin.pages.metode-pembayaran.edit', [
            'title' => 'Edit Metode Pembayaran',
            'item' => $item
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
            'nama' => ['required']
        ]);

        $data = request()->all();
        $item = MetodePembayaran::findOrFail($id);
        $item->update($data);
        return redirect()->route('admin.metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = MetodePembayaran::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.metode-pembayaran.index')->with('success', 'Metode Pembayaran berhasil dihapus.');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
}

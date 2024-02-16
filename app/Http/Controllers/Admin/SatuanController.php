<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Satuan::orderBy('nama', 'ASC')->get();
        return view('admin.pages.satuan.index', [
            'title' => 'Data Satuan',
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
        return view('admin.pages.satuan.create', [
            'title' => 'Tambah Satuan'
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
        Satuan::create($data);
        return redirect()->route('admin.satuan.index')->with('success', 'Satuan berhasil ditambahkan.');
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
        $item = Satuan::findOrFail($id);
        return view('admin.pages.satuan.edit', [
            'title' => 'Edit Satuan',
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
        $item = Satuan::findOrFail($id);
        $item->update($data);
        return redirect()->route('admin.satuan.index')->with('success', 'Satuan berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Satuan::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.satuan.index')->with('success', 'Satuan berhasil dihapus.');
    }
}

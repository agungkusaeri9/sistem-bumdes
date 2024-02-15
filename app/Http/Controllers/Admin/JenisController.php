<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Jenis::orderBy('nama', 'ASC')->get();
        return view('admin.pages.jenis.index', [
            'title' => 'Data Jenis',
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
        return view('admin.pages.jenis.create', [
            'title' => 'Tambah Jenis'
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
        Jenis::create($data);
        return redirect()->route('admin.jenis.index')->with('success', 'Jenis berhasil ditambahkan.');
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
        $item = Jenis::findOrFail($id);
        return view('admin.pages.jenis.edit', [
            'title' => 'Edit Jenis',
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
        $item = Jenis::findOrFail($id);
        $item->update($data);
        return redirect()->route('admin.jenis.index')->with('success', 'Jenis berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Jenis::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.jenis.index')->with('success', 'Jenis berhasil dihapus.');
    }
}

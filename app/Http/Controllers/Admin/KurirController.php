<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurir;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Kurir::orderBy('nama', 'ASC')->get();
        return view('admin.pages.kurir.index', [
            'title' => 'Data Kurir',
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
        return view('admin.pages.kurir.create', [
            'title' => 'Tambah Kurir'
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
            'kode' => ['required', 'unique:kurir,kode'],
            'nama' => ['required']
        ]);
        $data = request()->all();
        Kurir::create($data);
        return redirect()->route('admin.kurir.index')->with('success', 'Kurir berhasil ditambahkan.');
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
        $item = Kurir::findOrFail($id);
        return view('admin.pages.kurir.edit', [
            'title' => 'Edit Kurir',
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
            'kode' => ['required', 'unique:kurir,kode'],
            'nama' => ['required']
        ]);

        $data = request()->all();
        $item = Kurir::findOrFail($id);
        $item->update($data);
        return redirect()->route('admin.kurir.index')->with('success', 'Kurir berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Kurir::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.kurir.index')->with('success', 'Kurir berhasil dihapus.');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
}

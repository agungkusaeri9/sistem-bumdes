<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Keuangan::latest()->get();
        return view('admin.pages.keuangan.index', [
            'title' => 'Data Keuangan',
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
        return view('admin.pages.keuangan.create', [
            'title' => 'Tambah Keuangan'
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
            'jenis' => ['required'],
            'nominal' => ['required']
        ]);
        $data = request()->all();
        $cekData = Keuangan::latest()->first();
        if ($cekData) {
            // cek pengeluaran ajtau pemasukan
            if (request('jenis') === 'pemasukan') {
                $data['saldo_sebelumnya'] = $cekData->saldo_saat_ini;
                $data['saldo_saat_ini'] = $cekData->saldo_saat_ini + request('nominal');
            } else {
                $data['saldo_sebelumnya'] = $cekData->saldo_saat_ini;
                $data['saldo_saat_ini'] = $cekData->saldo_saat_ini - request('nominal');
            }
        } else {
            if (request('jenis') === 'pengeluaran') {
                return redirect()->back()->with('error', 'Saldo anda tidak mencukupi');
            }
            $data['saldo_sebelumnya'] = 0;
            $data['saldo_saat_ini'] = request('nominal');
        }
        Keuangan::create($data);
        $data = request()->all();
        return redirect()->route('admin.keuangan.index')->with('success', 'Keuangan berhasil ditambahkan.');
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
        $item = Keuangan::findOrFail($id);
        return view('admin.pages.keuangan.edit', [
            'title' => 'Edit Keuangan',
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
        $item = Keuangan::findOrFail($id);
        $item->update($data);
        return redirect()->route('admin.keuangan.index')->with('success', 'Keuangan berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Keuangan::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.keuangan.index')->with('success', 'Keuangan berhasil dihapus.');
    }
}

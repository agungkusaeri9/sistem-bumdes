<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Pengurus::orderBy('nama', 'ASC')->get();
        return view('admin.pages.pengurus.index', [
            'title' => 'Data Pengurus',
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
        return view('admin.pages.pengurus.create', [
            'title' => 'Tambah Pengurus',
            'data_jabatan' => Jabatan::orderBy('nama', 'ASC')->get()
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
            'jabatan_id' => ['required'],
            'jenis_kelamin' => ['required'],
            'nomor_hp' => ['required'],
            'mulai_jabatan' => ['required'],
            'akhir_jabatan' => ['required'],
            'gambar' => ['image', 'mimes:jpg,jpeg,png']
        ]);

        $data = request()->all();
        if (request()->file('gambar')) {
            $data['gambar'] = request()->file('gambar')->store('pengurus', 'public');
        } else {
            $data['gambar'] = NULL;
        }
        Pengurus::create($data);
        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil ditambahkan.');
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
        $item = Pengurus::findOrFail($id);
        return view('admin.pages.pengurus.edit', [
            'title' => 'Edit Pengurus',
            'item' => $item,
            'data_jabatan' => Jabatan::orderBy('nama', 'ASC')->get()
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
            'jabatan_id' => ['required'],
            'jenis_kelamin' => ['required'],
            'nomor_hp' => ['required'],
            'mulai_jabatan' => ['required'],
            'akhir_jabatan' => ['required'],
            'gambar' => ['image', 'mimes:jpg,jpeg,png']
        ]);

        $data = request()->all();
        $item = Pengurus::findOrFail($id);
        if (request()->file('gambar')) {
            if ($item->gambar) {
                Storage::disk('public')->delete($item->gambar);
            }
            $data['gambar'] = request()->file('gambar')->store('pengurus', 'public');
        }


        $item->update($data);
        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Pengurus::findOrFail($id);
        if ($item->gambar) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();
        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus berhasil dihapus.');
    }
}

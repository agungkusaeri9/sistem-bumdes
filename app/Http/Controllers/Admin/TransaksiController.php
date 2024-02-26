<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $items = Transaksi::latest()->get();
        return view('admin.pages.transaksi.index', [
            'title' => 'Data Tranaksi',
            'items' => $items
        ]);
    }

    public function show($uuid)
    {
        $item = Transaksi::where('uuid', $uuid)->firstOrFail();
        return view('admin.pages.transaksi.show', [
            'title' => 'Detail Tranaksi',
            'item' => $item
        ]);
    }

    public function edit($uuid)
    {
        $item = Transaksi::where('uuid', $uuid)->firstOrFail();
        return view('admin.pages.transaksi.edit', [
            'title' => 'Edit Tranaksi',
            'item' => $item
        ]);
    }

    public function update($uuid)
    {
        request()->validate([
            'status' => ['required']
        ]);

        $item = Transaksi::where('uuid', $uuid)->firstOrFail();
        $status_awal = $item->status;
        $item->update([
            'status' => request('status'),
            'nomor_resi' => request('nomor_resi')
        ]);

        // if (request('status') === 'SELESAI' && $status_awal !== 'SELESAI') {
        //     foreach ($item->details as $detail) {
        //         // kurangi stok produk
        //         $detail->produk->decrement('stok', $detail->jumlah);
        //     }
        // }
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function destroy($uuid)
    {
        $item = Transaksi::where('uuid', $uuid)->firstOrFail();
        $item->delete();

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}

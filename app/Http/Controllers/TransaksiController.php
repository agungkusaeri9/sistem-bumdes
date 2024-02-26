<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $items = Transaksi::where('user_id', auth()->id())->latest()->get();
        return view('pages.transaksi.index', [
            'title' => 'Riwayat Transaksi',
            'items' => $items
        ]);
    }

    public function show($uuid)
    {
        $item = Transaksi::where('uuid', $uuid)->firstOrFail();
        return view('pages.transaksi.show', [
            'title' => 'Detail Transaksi',
            'item' => $item
        ]);
    }

    public function upload_bukti($uuid)
    {
        request()->validate([
            'bukti_pembayaran' => ['required','image','mimes:png,jpg,jpeg','max:2048']
        ]);

        $item = Transaksi::where('uuid',$uuid)->firstOrFail();
        $item->update([
            'bukti_pembayaran' => request()->file('bukti_pembayaran')->store('bukti-pembayaran','public')
        ]);

        return redirect()->back()->with('success','Bukti Pembayaran berhasil diupload.');
    }
}

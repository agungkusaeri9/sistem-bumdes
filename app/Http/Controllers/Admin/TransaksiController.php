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
}

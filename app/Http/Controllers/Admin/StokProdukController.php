<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\StokProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokProdukController extends Controller
{
    public function index()
    {
        $title = 'Stok Produk';
        $items = StokProduk::latest()->get();
        $data_produk = Produk::orderBy('nama', 'ASC')->get();
        return view('admin.pages.stok-produk.index', compact('title', 'items', 'data_produk'));
    }

    public function store()
    {
        request()->validate([
            'produk_id' => ['required'],
            'jenis' => ['required'],
            'jumlah' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $data = request()->all();
            $produk = Produk::findOrFail(request('produk_id'));
            // cek produk ketika barang keluar
            if (request('jenis') === 'keluar' && $produk->stok < request('jumlah')) {
                return redirect()->back()->with('error', 'Jumlah melebihi stok produk yang tersedia.');
            }
            $item  = StokProduk::create($data);
            $stok_awal = $produk->stok;
            if ($item->jenis === 'masuk') {
                // update stok produk
                $stok_akhir = $stok_awal + request('jumlah');
            } else {
                $stok_akhir = $stok_awal - request('jumlah');
            }
            $produk->update([
                'stok' => $stok_akhir
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Stok Produk Produk berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $item = StokProduk::findOrFail($id);
            $stok_awal = $item->produk->stok;
            $stok_akhir = $stok_awal - $item->jumlah;
            $item->produk()->update([
                'stok' => $stok_akhir
            ]);
            $item->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Galeri Produk berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}

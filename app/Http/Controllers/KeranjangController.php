<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Kurir;
use App\Models\MetodePembayaran;
use App\Models\Produk;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function index()
    {
        $items = keranjang::where('user_id', auth()->id())->get();
        $data_provinsi = Provinsi::orderBy('name', 'ASC')->get();
        $data_metode_pembayaran = MetodePembayaran::orderBy('nama', 'ASC')->get();
        $data_kurir = Kurir::orderBy('nama', 'ASC')->get();
        return view('pages.keranjang', [
            'title' => 'Keranjang',
            'items' => $items,
            'data_provinsi' => $data_provinsi,
            'data_kurir' => $data_kurir,
            'data_metode_pembayaran' => $data_metode_pembayaran
        ]);
    }

    public function store()
    {
        request()->validate([
            'produk_id' => ['required'],
            'jumlah' => ['required', 'numeric']
        ]);

        DB::beginTransaction();

        try {
            $produk = Produk::findOrFail(request('produk_id'));

            if($produk->stok < request('jumlah'))
            {
                return redirect()->back()->with('warning','Stok produk tidak mencukupi.');
            }
            keranjang::create([
                'produk_id' => $produk->id,
                'user_id' => auth()->id(),
                'harga' => $produk->harga,
                'jumlah' => request('jumlah'),
                'total_harga' => $produk->harga * request('jumlah')
            ]);

            DB::commit();

            return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dimasukan kekeranjang.');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return redirect()->route('keranjang.index')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $item = Keranjang::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success','Produk berhasil dihapus dari keranjang.');
        }
}

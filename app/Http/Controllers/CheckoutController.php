<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __invoke()
    {

        request()->validate([
            'nama' => ['required'],
            'alamat' => ['required'],
            'nomor_hp' => ['required'],
            'ongkos_kirim' => ['required'],
            'kurir' => ['required'],
            'provinsi_id' => ['required'],
            'kota_id' => ['required'],
            'metode_pembayaran_id' => ['required']
        ]);


        DB::beginTransaction();
        try {
            $carts = Keranjang::where('user_id', auth()->id())->get();
            $transaction = auth()->user()->transaksi()->create([
                'uuid' => \Str::uuid(),
                'nama' => request('nama'),
                'nomor_hp' => request('nomor_hp'),
                'alamat' => request('alamat'),
                'total_bayar' => request('total_bayar'),
                'kurir' => request('kurir'),
                'ongkos_kirim' => request('ongkos_kirim'),
                'metode_pembayaran_id' => request('metode_pembayaran_id'),
                'province_id' => request('provinsi_id'),
                'city_id' => request('kota_id'),
                'status' => 'PENDING',
            ]);

            foreach ($carts as $cart) {
                $transaction->details()->create([
                    'produk_id' => $cart->produk_id,
                    'jumlah' => $cart->jumlah,
                    'harga' => $cart->harga,
                    'keterangan' => $cart->keterangan,
                    'total_harga' => $cart->harga * $cart->jumlah
                ]);
                $cart->produk->decrement('stok', $cart->jumlah);
            }

            // $transaction->notify(new NewCheckout);
            auth()->user()->keranjang()->delete();
            DB::commit();

            return redirect()->route('transaksi.show', $transaction->uuid)->with('success', 'Transaksi berhasil dilakukan, Silahkan lakukan pembayaran');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}

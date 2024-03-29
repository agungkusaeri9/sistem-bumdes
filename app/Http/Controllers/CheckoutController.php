<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{

    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

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
            'jenis_pembayaran' => ['required'],
            'metode_pembayaran_id' => [Rule::when(request('jenis_pembayaran') === 'manual', ['required'])]
        ]);


        DB::beginTransaction();
        try {
            $carts = Keranjang::where('user_id', auth()->id())->get();
            $kode = 'TRX' . time();
            $transaction = auth()->user()->transaksi()->create([
                'uuid' => \Str::uuid(),
                'kode' => $kode,
                'nama' => request('nama'),
                'nomor_hp' => request('nomor_hp'),
                'alamat' => request('alamat'),
                'total_bayar' => request('total_bayar'),
                'kurir' => request('kurir'),
                'sub_total' => $carts->sum('total_harga'),
                'ongkos_kirim' => request('ongkos_kirim'),
                'metode_pembayaran_id' => request('metode_pembayaran_id'),
                'province_id' => request('provinsi_id'),
                'city_id' => request('kota_id'),
                'status' => 'PENDING',
                'jenis_pembayaran' => request('jenis_pembayaran')
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

            // jika otomatis
            if (request('jenis_pembayaran') === 'otomatis') {
                $payload = [
                    'transaction_details' => [
                        'order_id'     => $kode,
                        'gross_amount' => request('total_bayar'),
                    ],
                    'customer_details' => [
                        'first_name' => request('nama'),
                        'email'      => auth()->user()->email,
                    ]
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($payload);
                $transaction->update([
                    'snap_token' => $snapToken
                ]);
            }

            DB::commit();

            return redirect()->route('transaksi.show', $transaction->uuid)->with('success', 'Transaksi berhasil dilakukan, Silahkan lakukan pembayaran');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Kecamatan;
use App\Models\Keranjang;
use App\Models\Kota;
use App\Models\Kurir;
use App\Models\Produk;
use App\Services\OngkirService;
use Dipantry\Rajaongkir\Constants\RajaongkirCourier;
use Dipantry\Rajaongkir\Rajaongkir;
use Dipantry\Rajaongkir\RajaongkirService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $ongkirService;

    public function __construct(OngkirService $ongkirService)
    {
        $this->ongkirService = $ongkirService;
    }

    public function home()
    {
        $keyword = request('keyword');
        $items = Produk::latest()->paginate(16);
        $data_jenis = Jenis::orderBy('nama', 'ASC')->get();
        return view('pages.home', [
            'title' => 'Selamat datang di website kami',
            'items' => $items,
            'data_jenis' => $data_jenis
        ]);
    }
    public function contact()
    {
        return view('pages.contact', [
            'title' => 'Contact'
        ]);
    }
    public function about()
    {
        return view('pages.about', [
            'title' => 'About'
        ]);
    }

    public function cek_ongkir()
    {
        $destination = request('destination');
        $weight = request('weight');
        $courier = request('courier');
        $result = $this->ongkirService->checkOngkir(
            $destination,
            $weight,
            $courier
        );

        return response()->json($result);
    }

    public function getKotaByProvinsiId()
    {
        $items = Kota::where('province_id', request('provinsi_id'))->orderBy('name', 'ASC')->get();
        return response()->json($items, 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Keranjang;
use App\Models\Kota;
use App\Models\Kurir;
use App\Services\OngkirService;
use Dipantry\Rajaongkir\Constants\RajaongkirCourier;
use Dipantry\Rajaongkir\Rajaongkir;
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
        return view('pages.home', [
            'title' => 'Home'
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
        $origin = 456;
        $destination = request('kota_id');
        $weight = 1000;
        $courier = 'jne';
        $result = \Dipantry\Rajaongkir\Rajaongkir::getOngkirCost(
            $origin = 1,
            $destination = 200,
            $weight = 300,
            $courier = 'jne'
        );

        return response()->json($result);
    }

    public function getKotaByProvinsiId()
    {
        $items = Kota::where('province_id', request('provinsi_id'))->orderBy('name', 'ASC')->get();
        return response()->json($items, 200);
    }
}

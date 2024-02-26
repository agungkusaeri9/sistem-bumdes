<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Services\TrackingService;
use Illuminate\Http\Request;

class TrackingController extends Controller
{

    protected $tracking;

    public function __construct()
    {
        $this->tracking = new TrackingService();
    }

    public function tracking($uuid)
    {
        $item = Transaksi::where('uuid', $uuid)->firstOrFail();

        $tracking = $this->tracking->track($item->kurir, $item->nomor_resi);
        // dd($tracking);
        if ($tracking['status'] != 200) {

            return redirect()->route('transaksi.index')->with('error', 'Tracking Error!');
        }

        $data = $tracking['data'];

        return view('pages.tracking.index', [
            'title' => 'Tracking Pengiriman',
            'data' => $data
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function transaksi_index()
    {
        return view('admin.pages.laporan.transaksi.index',[
            'title' => 'Laporan Transaksi'
        ]);
    }

    public function transaksi_print()
    {
        $transaksi = Transaksi::latest();
        $tanggal_awal = request('tanggal_awal');
        $tanggal_akhir = request('tanggal_akhir');

        if($tanggal_awal && $tanggal_akhir)
        {
            $transaksi->whereBetween('created_at',[$tanggal_awal,$tanggal_akhir]);
        }elseif($tanggal_awal)
        {
            $transaksi->whereDate('created_at',$tanggal_awal);
        }else{
            $transaksi->whereNotNull('id');
        }

        $data = $transaksi->get();
        if($data->count() < 1)
        {
            return redirect()->back()->with('warning','Data tidak ada');
        }
        $pdf = Pdf::loadView('admin.pages.laporan.transaksi.print',[
            'title' => 'Laporan Transaksi',
            'data' => $data,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ]);
        $nama = 'Laporan-transaksi-' . time() . '.pdf';
        return $pdf->stream($nama);
    }
}

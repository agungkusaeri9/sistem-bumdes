<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function callback(Request $req)
    {
        try {
            $notification_body = json_decode($req->getContent(), true);
            $kode = $notification_body['order_id'];
            $status_code = $notification_body['status_code'];
            $transaksi = Transaksi::where('kode', $kode)->first();
            if (!$transaksi)
                return ['code' => 0, 'messgae' => 'Terjadi kesalahan | Pembayaran tidak valid'];
            switch ($status_code) {
                case '200':
                    $transaksi->status = "SUCCESS";
                    break;
                case '201':
                    $transaksi->status = "PENDING";
                    break;
                case '202':
                    $transaksi->status = "CANCEL";
                    break;
            }
            $transaksi->save();
            return response('Ok', 200)->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            return response('Error', 404)->header('Content-Type', 'text/plain');
        }
    }
}

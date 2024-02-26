<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count = [
            'pengurus' => User::where('role', 'pengurus')->count(),
            'transaksi' => Transaksi::count(),
            'pembeli' => User::where('role', 'pembeli')->count(),
            'produk' => Produk::count()
        ];
        return view('admin.pages.dashboard', [
            'title' => 'Dashboard',
            'count' => $count
        ]);
    }
}

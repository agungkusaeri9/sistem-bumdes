<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
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
    public function keranjang()
    {
        return view('pages.keranjang', [
            'title' => 'Keranjang'
        ]);
    }
}

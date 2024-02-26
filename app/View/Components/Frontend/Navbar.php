<?php

namespace App\View\Components\Frontend;

use App\Models\Keranjang;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $keranjang = Keranjang::where('user_id', auth()->id())->count();
        return view('components.frontend.navbar', [
            'keranjang' => $keranjang
        ]);
    }
}

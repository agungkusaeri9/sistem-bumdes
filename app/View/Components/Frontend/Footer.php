<?php

namespace App\View\Components\Frontend;

use App\Models\Jenis;
use Illuminate\View\Component;

class Footer extends Component
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
        $data_jenis = Jenis::orderBy('nama', 'ASC')->get();
        return view('components.frontend.footer', [
            'data_jenis' => $data_jenis
        ]);
    }
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Absensicard extends Component
{
   public $judul, $content, $daftarKelasId;
    public function __construct($judul, $content, $daftarKelasId)
    {
        $this->judul = $judul;
        $this->content = $content;
        $this->daftarKelasId = $daftarKelasId;

    }


    public function render()
    {
        return view('components.absensicard');
    }
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Absensicard extends Component
{
   public $judul, $content;
    public function __construct($judul, $content)
    {
        $this->judul = $judul;
        $this->content = $content;
    }


    public function render()
    {
        return view('components.absensicard');
    }
}

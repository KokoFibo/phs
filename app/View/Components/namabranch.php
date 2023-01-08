<?php

namespace App\View\Components;

use App\Models\Branch;
use Illuminate\View\Component;

class namabranch extends Component
{
   
    public $kode;
    // public $kode;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($kode)
    {
        $this->kode = $kode;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if($this->kode == null) {
            $nama = "Welcome";
        } else {
        $branch = Branch::find($this->kode);
        $nama = $branch->nama_branch;
        }
        return view('components.namabranch', compact('nama'));
    }
}

<?php

namespace App\View\Components;

use App\Models\Branch;
use Illuminate\View\Component;

class namabranch extends Component
{
   
    public $KodeBranch;
    // public $kode;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($KodeBranch)
    {
        $this->KodeBranch = $KodeBranch;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if($this->KodeBranch == null) {
            $nama = "Welcome";
        } else {
        $branch = Branch::find($this->KodeBranch);
        $NamaCetya = $branch->nama_branch;
        }
        return view('components.namabranch')->with('NamaCetya', $NamaCetya)
        ->extends('layouts.app')
        ->section('content');
    }
}
 
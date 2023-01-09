<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NamaCetya extends Component
{
    public $Kodebranch;
    
    public function __construct($Kodebranch)
    {
        $this->Kodebranch = $Kodebranch;
    }

    
    public function render()
    {
        if($this->Kodebranch == null) {
            $nama = "Welcome";
        } else {
        $branch = Branch::find($this->Kodebranch);
        $Namaft = $branch->nama_branch;
        }
        return view('components.nama-cetya')->with('Namaft', $Namaft);
    }
}

<?php
 
namespace App\Http\Livewire;

use App\Models\Branch;
use Livewire\Component;

class Getbranchname extends Component
{
    public $kode;

    public function mount ($kode) {
        $this->kode = $kode;
    }

   
    public function render()
    {
        if($this->kode == null) {
            $nama = "Welcome";
        } else {
        $branch = Branch::find($this->kode);
        $nama = $branch->nama_branch;
        }
        return view('livewire.getbranchname', compact('nama'))
        ->extends('layouts.app')
        ->section('content');
    }
}

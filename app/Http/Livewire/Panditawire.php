<?php

namespace App\Http\Livewire;

use App\Models\Pandita;
use Livewire\Component;

class Panditawire extends Component
{
    public $nama;

    protected $rules = [
        'nama' => 'unique:panditas,nama',
    ];

    public function store () {
        $this->validate();
        $data = new Pandita();
        $data->nama = $this->nama;
        $data->save();
    }

    public function delete ($id) {
        $data = Pandita::find($id);
        $data->delete();
    }
    public function render()
    { 
        $pandita = Pandita::orderBy('nama', 'asc')->paginate(10);
        return view('livewire.panditawire', compact('pandita'));
    }
}

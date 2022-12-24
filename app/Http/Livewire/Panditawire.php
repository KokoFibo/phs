<?php

namespace App\Http\Livewire;

use App\Models\Pandita;
use Livewire\Component;

class Panditawire extends Component
{
    public $nama_pandita;

    protected $rules = [
        'nama_pandita' => 'unique:panditas,nama_pandita',
    ];
 
    public function store () {
        $this->validate();
        $data = new Pandita();
        $data->nama_pandita = $this->nama_pandita;
        $data->save();
    }

    public function delete ($id) {
        $data = Pandita::find($id);
        $data->delete();
    }
    public function render()
    { 
        $pandita = Pandita::orderBy('nama_pandita', 'asc')->paginate(10);
        return view('livewire.panditawire', compact('pandita'));
    }
}

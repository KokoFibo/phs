<?php

namespace App\Http\Livewire;

use App\Models\Pandita;
use Livewire\Component;

class Panditawire extends Component
{
    public $nama_pandita;
    public $id_pandita;
    public $nama_lama;

    protected $rules = [
        'nama_pandita' => 'required',
    ];
 
    public function store () {
        $this->validate();
        $data = new Pandita();
        $data->nama_pandita = $this->nama_pandita;
        $data->save();
        $this->redirect(route('adddata'));
    }

    public function delete ($id) {
        $data = Pandita::find($id);
        $data->delete();
    }

    public function edit ($id) {
        $this->id_pandita = $id;
        $nama = Pandita::find($id);
        $this->nama_pandita = $nama->nama_pandita;
    }

    public function update() {

        $nama = Pandita::find($this->id_pandita);
        $nama->nama_pandita = $this->nama_pandita;
        $nama->save();
    }
    public function render()
    { 
        $pandita = Pandita::orderBy('nama_pandita', 'asc')->paginate(10);
        return view('livewire.panditawire', compact('pandita'));
    }
}

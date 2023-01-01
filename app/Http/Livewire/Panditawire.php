<?php

namespace App\Http\Livewire;

use App\Models\Pandita;
use Livewire\Component;
use Livewire\WithPagination;

class Panditawire extends Component
{
    public $nama_pandita;
    public $id_pandita;
    public $nama_lama;
    public $is_edit = 'false';
    public $is_add = 'false';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nama_pandita' => 'required',
    ];
 
    public function store () {
        $this->validate();
        $data = new Pandita();
        $data->nama_pandita = $this->nama_pandita;
        $data->save();
        // $this->redirect(route('adddata'));
    }

    public function delete ($id) {
        $data = Pandita::find($id);
        $data->delete();
    }

    public function edit ($id) {
        $this->id_pandita = $id;
        $nama = Pandita::find($id);
        $this->nama_pandita = $nama->nama_pandita;
        $this->is_edit=true;
        $this->is_add=false;
    }
    public function clear_fields() {
        $this->nama_pandita='';
    }
    public function new () {
        $this->clear_fields();   
        $this->is_edit=false;
        $this->is_add=true; 
    }
    public function update() {

        $nama = Pandita::find($this->id_pandita);
        $nama->nama_pandita = $this->nama_pandita;
        $nama->save();
        $this->is_edit=false;
        $this->is_add=false; 
    }
    public function render()
    { 
        $pandita = Pandita::orderBy('nama_pandita', 'asc')->paginate(5);
        return view('livewire.panditawire', compact('pandita'));
    }
}

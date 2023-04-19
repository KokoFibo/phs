<?php

namespace App\Http\Livewire;

use App\Models\Pandita;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Redirect;

class Panditawire extends Component
{
    public $nama_pandita;
    // public $id_pandita;
    public $is_add = 'true';
    use WithPagination;
    protected $listeners = ['delete'];



    public function cancel () {
        $this->is_add = 'true';
    }
    public function close () {
        return redirect()->route('adddata');
    }

    public function store () {
        $this->validate([
            'nama_pandita' => 'required|unique:panditas',
        ]);
        // ================
        $data = new Pandita();

        $data->nama_pandita = Str::title($this->nama_pandita);
        $data->save();
        $this->clear_fields();
        // $this->redirect(route('adddata'));
        // session()->flash('message', 'Data Pandita Sudah di Simpan');
        $this->dispatchBrowserEvent('success', ['message' => 'Data Pandita Sudah di Simpan']);


    }

    public function deleteConfirmation ($id) {
        $data = Pandita::find($id);
        $nama = $data->nama_pandita;
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
            //  'text' => "You won't be able to revert this!",
              'text' => "Data Pandita : " . $nama,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }

    public function delete ($id) {
        $data = Pandita::find($id);
        if( $data->pandita_is_used != '1'){
            $data->delete();
            $this->dispatchBrowserEvent('deleted');
        } else {
            session()->flash('message', 'Data TIDAK di Delete');

        }


    }



    public function edit ($id) {


        $this->id_pandita = $id;
        $nama = Pandita::find($id);
        $this->nama_pandita = $nama->nama_pandita;
        $this->is_add=false;
    }
    public function clear_fields() {
        $this->nama_pandita='';
    }

    public function update() {
        $this->validate([
            'nama_pandita' => 'required|unique:panditas,nama_pandita,'.$this->id_pandita
        ]);
        $nama = Pandita::find($this->id_pandita);
        $nama->nama_pandita = Str::title($this->nama_pandita);

        $nama->save();
        // $this->is_edit=false;
        $this->clear_fields();
        $this->is_add=true;
        // session()->flash('message', 'Data Pandita Sudah di Update');
        $this->dispatchBrowserEvent('success', ['message' => 'Data Pandita Sudah di Update']);


    }
    public function render()
    {
        $pandita = Pandita::orderBy('id', 'desc')->paginate(5);
        return view('livewire.panditawire', compact('pandita'))
        ->extends('layouts.main')
        ->section('content');
    }
}

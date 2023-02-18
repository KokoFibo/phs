<?php

namespace App\Http\Livewire;

use App\Models\Kelas;
use Livewire\Component;
use Livewire\WithPagination;

class Tambahkelaswire extends Component
{
    public $nama_kelas;
    public $id_kelas;
    public $nama_lama;
    // public $is_edit = 'false';
    public $is_add = 'true';
    use WithPagination;
    protected $listeners = ['delete'];

    public function close () {
        return redirect()->route('dashboard');
    }

    public function store () {
        $this->validate([
            'nama_kelas' => 'required|unique:kelas',
        ]);
        // ================
        $data = new Kelas();
        $data->nama_kelas = smartCapitalize($this->nama_kelas);

        $data->save();
        $this->clear_fields();
        session()->flash('message', 'Data Kelas Sudah di Simpan');

    }

    public function cancel () {
        $this->clear_fields();
        $this->is_add=true;
        $this->render();
    }

    public function deleteConfirmation ($id) {
        $data = Kelas::find($id);
        $nama = $data->nama_kelas;
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
            //  'text' => "You won't be able to revert this!",
              'text' => "Data Kelas : " . $nama,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }

    public function delete ($id) {
        $data = Kelas::find($id);
        if( $data->kelas_is_used != '1'){
            $data->delete();
            $this->dispatchBrowserEvent('deleted');
        } else {
            session()->flash('message', 'Data TIDAK di Delete');

        }


    }



    public function edit ($id) {


        $this->id_kelas = $id;
        $nama = Kelas::find($id);
        $this->nama_kelas = $nama->nama_kelas;
        $this->is_add=false;
    }
    public function clear_fields() {
        $this->nama_kelas='';
    }

    public function update() {
        $this->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,'.$this->id_kelas
        ]);
        $nama = Kelas::find($this->id_kelas);
        $nama->nama_kelas = smartCapitalize($this->nama_kelas);
        $nama->save();
        // $this->is_edit=false;
        $this->clear_fields();
        $this->is_add=true;
        session()->flash('message', 'Data Kelas Sudah di Update');

    }

    public function render()
    {
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->paginate(5);

        return view('livewire.tambahkelaswire', compact('kelas'))
        ->extends('layouts.main')
        ->section('content');
    }
}

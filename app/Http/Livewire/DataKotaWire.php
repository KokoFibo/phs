<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Kota;
use Livewire\Component;
use App\Models\Province;
use Illuminate\Support\Str;
use Livewire\WithPagination;


class DataKotaWire extends Component
{
    public  $namakota;
    public $nama_kota;
    use WithPagination;
    public $is_add = true;
    protected $listeners = ['delete_kota', 'render'];

    public function mount  () {

        $this->resetPage();
    }

    public function close () {
        return redirect()->route('adddata');
    }

    public function  clear_fields() {
        $this->nama_kota='';
    }

    public function store () {
         $this->validate([
            'nama_kota' => 'required|unique:kotas,nama_kota',
        ]);
        $data_kota = new Kota();
        $data_kota->nama_kota = Str::title($this->nama_kota);
        $data_kota->save();
        $this->clear_fields();
        session()->flash('message', 'Data Kota Sudah di Simpan');
    }


    public function edit ($id) {
        $data = Kota::find($id);
        $this->current_id = $id;
        $this->nama_kota = $data->nama_kota;
         $this->is_add=false;
    }

    public function update () {
        $this->validate([
            'nama_kota' => 'unique:kotas,nama_kota,'.$this->current_id,
        ]);
        $data = Kota::find($this->current_id);
        $data->nama_kota = Str::title($this->nama_kota);

        $data->save();
        $this->clear_fields();
        session()->flash('message', 'Data Kota Sudah di Update');
        $this->is_add = true;
    }

    public function delete_confirmation_kota ($id) {
        $data = Kota::find($id);
        $nama = $data->nama_kota;
        $this->dispatchBrowserEvent('delete_confirmation_aja', [
            'title' => 'Yakin Untuk Hapus Data kota',
            //  'text' => "You won't be able to revert this!",
              'text' => "Data Kota : " . $nama,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }

    public function deleteConfirmation ($id) {
        $data = Kota::find($id);
        $nama = $data->nama_kota;
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
            //  'text' => "You won't be able to revert this!",
              'text' => "Data Kota : " . $nama,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }
    public function delete_kota ($id) {
        $data = Kota::find($id);
        if($data->kota_is_used != '1'){

            $data->delete();
            $this->dispatchBrowserEvent('deleted');
        }else {
            session()->flash('message', 'Data Tidak di Delete');
        }
    }

    public function render()
    {
        $kota = Kota::orderBy('id', 'desc')->paginate(5);
        return view('livewire.data-kota-wire', compact('kota'))
        ->extends('layouts.secondMain')
        ->section('content');

    }
}

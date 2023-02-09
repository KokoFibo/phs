<?php

namespace App\Http\Livewire;

use App\Models\Kelas;
use App\Models\Branch;
use Livewire\Component;
use App\Models\Daftarkelas;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Daftarkelaswire extends Component
{
    public $nama_kelas;
    public $id_kelas;
    public $nama_lama;
    public $is_add = 'true';
    use WithPagination;
    protected $listeners = ['delete'];
    public $kelas_id, $branch_id;

    public function close () {
        return redirect()->route('main');
    }

    public function checkDuplicate(){
        $data = Daftarkelas::where('kelas_id',$this->kelas_id)->where('branch_id', $this->branch_id)->first();
        if($data==null){
            return false;
        }
        else {
            return true;
        }
    }

    public function updateKelas() {
        $data_kelas = Kelas::find($this->kelas_id);
        $data_kelas->kelas_is_used = true;
        $data_kelas->save();
    }
    public function store () {
        if($this->checkDuplicate() == false){
            $data = new Daftarkelas();
            $data->kelas_id = $this->kelas_id;
            $data->branch_id = $this->branch_id;
            $data->save();
            $this->updateKelas();
            $this->clear_fields();
            session()->flash('message', 'Data Kelas Sudah di Simpan');
        } else {
            session()->flash('message', 'Data Sudah Ada');
        }

    }

    public function deleteConfirmation ($id) {
        $data = Daftarkelas::find($id);
        $namakelas = getKelas($data->kelas_id);
        $namacetya = getBranch($data->branch_id);
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
            //  'text' => "You won't be able to revert this!",
              'text' => "Data Kelas : " . $namakelas . ", di Cetya : " . $namacetya,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }

    public function delete ($id) {
        $data = Daftarkelas::find($id);
        if( $data->kelas_is_used != '1'){
            $data->delete();
            $this->dispatchBrowserEvent('deleted');
        } else {
            session()->flash('message', 'Data TIDAK di Delete');

        }


     }



    // public function edit ($id) {


    //     $this->id_kelas = $id;
    //     $nama = Kelas::find($id);
    //     $this->nama_kelas = $nama->nama_kelas;
    //     $this->is_add=false;
    // }
    public function clear_fields() {
        $this->reset();
    }

    // public function update() {
    //     $this->validate([
    //         'nama_kelas' => 'required|unique:kelas,nama_kelas,'.$this->id_kelas
    //     ]);
    //     $nama = Kelas::find($this->id_kelas);
    //     $nama->nama_kelas = $this->nama_kelas;
    //     $nama->save();
    //     // $this->is_edit=false;
    //     $this->clear_fields();
    //     $this->is_add=true;
    //     session()->flash('message', 'Data Kelas Sudah di Update');

    // }


    public function render()
    {
        $daftarkelas = Daftarkelas::orderBy('id', 'asc')->paginate(5);
        $kelas = Kelas::all();
        $branch = Branch::all();

        return view('livewire.daftarkelaswire', compact(['daftarkelas', 'branch', 'kelas']))
        ->extends('layouts.main')
        ->section('content');
    }
}

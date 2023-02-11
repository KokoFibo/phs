<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Models\Absensi;
use Livewire\Component;
use App\Models\Daftarkelas;
use Livewire\WithPagination;
use Auth;

class Absensiwire extends Component
{
    use WithPagination;
    public $branch_id, $kelas_id, $kelas, $daftarkelas_id, $tgl_kelas, $jumlah_peserta, $branch, $id_absensi ;
    public $selectedBranch = null;
    public $selectedKelas = null;
    public $is_add = 'true';
    protected $listeners = ['delete'];


    public function edit ($id) {
        $this->id_absensi = $id;
        $data = Absensi::find($id);
        // $this->kelas_id = $data->kelas_id;
        // $this->branch_id = $data->branch_id;
        $this->daftarkelas_id = $data->daftarkelas_id;
        $this->selectedBranch = $data->branch_id;
        $this->tgl_kelas = $data->tgl_kelas;
        $this->jumlah_peserta = $data->jumlah_peserta;
        $this->is_add=false;
    }

    public function mount() {
        if(Auth::user()->role == '3'){

            $this->branch = Branch::orderBy('nama_branch', 'asc')->get();
            $this->kelas = collect();
            // $this->kelas = Daftarkelas::orderBy('id', 'desc')->where('branch_id', Auth::user()->branch_id)->get();
        }
        $this->resetPage();
    }
    public function deleteConfirmation ($id) {
        $data = Absensi::find($id);
        // $namakelas = getKelas($data->kelas_id);
        // $namacetya = getBranch($data->branch_id);
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
             'text' => "You won't be able to revert this!",
            //   'text' => "Data Kelas : " . $namakelas . ", di Cetya : " . $namacetya,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }

    public function delete ($id) {
        $data = Absensi::find($id);
        if( $data->daftarkelas_is_used != '1'){
            $data->delete();
            $this->dispatchBrowserEvent('deleted');
        } else {
            session()->flash('message', 'Data TIDAK di Delete');

        }


     }

    public function clear_fields() {
         $this->selectedBranch = null;
     $this->selectedKelas = null;
     $this->kelas = '';
     $this->branch = '';
     $this->tgl_kelas='';
    $this->jumlah_peserta=null;


     $this->branch = Branch::orderBy('nama_branch', 'asc')->get();
     $this->kelas = collect();
    }
    public function updatedSelectedBranch($id) {
        $this->kelas = collect();

        $this->kelas = Daftarkelas::orderBy('id', 'desc')->where('branch_id', $id)->get();


    }
    public function updateDaftarKelas() {
        $data_kelas = Daftarkelas::find($this->daftarkelas_id);
        $data_kelas->daftarkelas_is_used = true;
        $data_kelas->save();
    }



    public function store () {
            $data = new Absensi();
            $data->daftarkelas_id = $this->daftarkelas_id;
            $data->tgl_kelas = $this->tgl_kelas;
            $data->jumlah_peserta = $this->jumlah_peserta;
            $data->save();
            $this->updateDaftarKelas();
            $this->clear_fields();
            session()->flash('message', 'Absensi Kelas Sudah di Simpan');

    }



    public function render()
    {
        $absensi = Absensi::orderBy('id', 'desc')->paginate(5);
        if(Auth::user()->role != '3'){

            $this->kelas = Daftarkelas::orderBy('id', 'desc')->where('branch_id', Auth::user()->branch_id)->get();
        }
        $this->resetPage();


        return view('livewire.absensiwire', compact(['absensi']))
        ->extends('layouts.main')
        ->section('content');
    }
}

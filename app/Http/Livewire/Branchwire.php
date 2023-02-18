<?php

namespace App\Http\Livewire;

use App\Models\Kota;
use App\Models\Branch;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Branchwire extends Component
{
    public $kota_id, $nama_branch, $kode_branch, $current_id;
    public $is_add = true;

    use WithPagination;
    protected $listeners = ['delete_branch'];



    public function rules () {

        return [
            'kota_id' => ['required'],
            'nama_branch' => ['required'],
            'kode_branch' => ['required'],
        ];

    }

    public function  clear_fields() {

        $this->kota_id= '';
        $this->nama_branch='';
        $this->kode_branch='';

    }

    public function updated($fields) {
        $this->validateOnly($fields);
    }

    public function store () {
        $validatedData = $this->validate();
        session()->flash('message', '');

        $data = new Branch();

        $data->kota_id = $this->kota_id;
        $data->nama_branch = $this->nama_branch;
        $data->kode_branch = $this->kode_branch;
        $data->save();

        session()->flash('message', 'Data Branch Sudah di tambah');

        $this->clear_fields();
        $this->is_add=true;

        // hiding the Modal after run Add Data
        // $this->dispatchBrowserEvent('close-modal');

    }

    public function edit ($id) {
        $data = Branch::find($id);
        $this->current_id = $id;
        $this->kota_id = $data->kota_id;
        $this->nama_branch = $data->nama_branch;
        $this->kode_branch = $data->kode_branch;
        $this->is_add=false;
    }
    public function update () {
        $validatedData = $this->validate();
        session()->flash('message', '');

        $data = new Branch();
        $data = Branch::find($this->current_id);

        $data->kota_id = $this->kota_id;
        $data->nama_branch = $this->nama_branch;
        $data->kode_branch = $this->kode_branch;
        $data->save();
        $this->is_add=true;

        session()->flash('message', 'Data Branch Sudah di Update');

        $this->clear_fields();


        // hiding the Modal after run Add Data
        // $this->dispatchBrowserEvent('close-modal');

    }

    public function close () {
        return redirect()->route('main');
    }

    public function delete_confirmation ($id) {
        $data = Branch::find($id);
        $nama_cetya = $data->nama_branch;
        $kode_cetya = $data->kode_branch;
        $this->dispatchBrowserEvent('delete_confirmation_branch', [
            'title' => 'Yakin Untuk Hapus Data kota',
            //  'text' => "You won't be able to revert this!",
              'text' => "Data Cetya : " . $nama_cetya . " & Kode : " . $kode_cetya,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }

    public function delete_branch ($id) {
        $data = Branch::find($id);
        if($data->branch_is_used != '1'){

            $data->delete();
            $this->dispatchBrowserEvent('deleted');
        }else {
            session()->flash('message', 'Data Tidak di Delete');
        }
    }



    public function render()
    {
        $branch = DB::table('branches')
        ->join('kotas', 'branches.kota_id', '=', 'kotas.id')
        ->select('branches.*',  'kotas.nama_kota')
        ->orderBy('kotas.id', 'desc')
        ->paginate(5);;

        $kota = Kota::orderBy('nama_kota', 'asc')->get();
        return view('livewire.branchwire', compact(['kota', 'branch']))
        ->extends('layouts.main')
        ->section('content');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Kota;
use App\Models\Branch;
use Livewire\Component;
use App\Models\Groupvihara;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Branchwire extends Component
{
    public $nama_branch, $groupvihara_id, $current_id;
    public $is_add = true;

    use WithPagination;
    protected $listeners = ['delete_branch'];



    public function rules () {

        return [
            'groupvihara_id' => ['required'],
            'nama_branch' => ['required'],
        ];

    }

    public function  clear_fields() {

        $this->groupvihara_id= '';
        $this->nama_branch='';

    }

    public function updated($fields) {
        $this->validateOnly($fields);
    }

    public function store () {
        $validatedData = $this->validate();
        session()->flash('message', '');

        $data = new Branch();

        $data->groupvihara_id = $this->groupvihara_id;
        $data->nama_branch = $this->nama_branch;
        $data->save();
        $this->updateGroupVihara ();

        session()->flash('message', 'Data Branch Sudah di tambah');


        $this->clear_fields();
        $this->is_add=true;

        // hiding the Modal after run Add Data
        // $this->dispatchBrowserEvent('close-modal');

    }

    public function edit ($id) {
        $data = Branch::find($id);
        $this->current_id = $id;
        $this->groupvihara_id = $data->groupvihara_id;
        $this->nama_branch = $data->nama_branch;
        $this->is_add=false;
    }

    public function updateGroupVihara () {
        $data = Groupvihara::find($this->groupvihara_id);
        $data->group_is_used = 1;
        $data->save();
    }
    public function update () {
        $validatedData = $this->validate();
        session()->flash('message', '');

        $data = new Branch();
        $data = Branch::find($this->current_id);

        $data->groupvihara_id = $this->groupvihara_id;
        $data->nama_branch = $this->nama_branch;
        $data->save();

        // update data group vihara




        $this->updateGroupVihara ();
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
        $this->dispatchBrowserEvent('delete_confirmation_branch', [
            'title' => 'Yakin Untuk Hapus Data kota',
            //  'text' => "You won't be able to revert this!",
              'text' => "Data Cetya : " . $nama_cetya,
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

        $groupvihara = Groupvihara::all();

        $branch = Branch::orderBy('nama_branch', 'asc')
        ->paginate(5);

        return view('livewire.branchwire', compact(['groupvihara', 'branch']))
        ->extends('layouts.main')
        ->section('content');
    }
}

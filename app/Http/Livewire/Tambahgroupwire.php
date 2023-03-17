<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Groupvihara;
use Illuminate\Support\Str;

use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class Tambahgroupwire extends Component
{
    public $nama_group;
    public $id_group;
    public $nama_lama;
    // public $is_edit = 'false';
    public $is_add = true;
    use WithPagination;
    protected $listeners = ['delete'];
    public $pswd;
    public $open;

    public function cancel () {
        $this->is_add = true;
    }

    public function checkPassword()
    {
        if (Hash::check($this->pswd, Auth::user()->password)) {
                $this->open = 1;
        } else {
                $this->open = 0;
        }
    }
    public function close () {
        return redirect()->route('main');
    }

    public function store () {
        $this->validate([
            'nama_group' => 'required|unique:groupviharas',
        ]);
        // ================
        $data = new Groupvihara();

        // $data->nama_group = trim(Str::title($this->nama_group));
        $data->nama_group = Str::title(trim($this->nama_group));
        $data->save();
        $this->clear_fields();
        // $this->redirect(route('adddata'));
        // session()->flash('message', 'Data Group Vihara Sudah di Simpan');
        $this->dispatchBrowserEvent('success', ['message' => 'Data Group Vihara Sudah di Simpan']);


    }

    public function deleteConfirmation ($id) {
        $data = Groupvihara::find($id);
        $nama = $data->nama_group;
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
              'text' => "Data group : " . $nama,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }

    public function delete ($id) {
        $data = Groupvihara::find($id);
        if( $data->group_is_used != '1'){
            $data->delete();
            $this->dispatchBrowserEvent('deleted');
        } else {
            session()->flash('message', 'Data TIDAK di Delete');

        }


    }



    public function edit ($id) {


        $this->id_group = $id;
        $nama = Groupvihara::find($id);
        $this->nama_group = $nama->nama_group;
        $this->is_add=false;
    }
    public function clear_fields() {
        $this->nama_group='';
    }

    public function update() {
        $this->validate([
            'nama_group' => 'required|unique:groupviharas,nama_group,'.$this->id_group
        ]);
        $nama = Groupvihara::find($this->id_group);
        $nama->nama_group = Str::title($this->nama_group);

        $nama->save();
        // $this->is_edit=false;
        $this->clear_fields();
        $this->is_add=true;
        // session()->flash('message', 'Data Group Vihara Sudah di Update');
        $this->dispatchBrowserEvent('success', ['message' => 'Data Group Vihara Sudah di Update']);


    }

    public function render()
    {
        $groupvihara = Groupvihara::orderBy('nama_group', 'asc')->paginate(5);
        return view('livewire.tambahgroupwire', compact('groupvihara'))->extends('layouts.main')
        ->section('content');
    }
}

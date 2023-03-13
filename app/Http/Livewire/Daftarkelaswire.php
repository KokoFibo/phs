<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\Kelas;
use App\Models\Branch;
use App\Models\Absensi;
use Livewire\Component;
use App\Models\Daftarkelas;
use App\Models\Groupvihara;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Daftarkelaswire extends Component
{
    public $nama_kelas;
    public $id_daftarkelas;
    public $nama_lama;
    public $is_add = 'true';
    use WithPagination;
    protected $listeners = ['delete'];
    public $kelas_id;
    public $selectedGroup, $groupvihara_id;


    public function close () {
        return redirect()->route('main');
    }

    public function checkDuplicate(){
        $data = Daftarkelas::where('kelas_id',$this->kelas_id)->where('groupvihara_id', $this->groupvihara_id)->first();
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
            if(Auth::user()->role != 3) {
                $data->groupvihara_id = Auth::user()->groupvihara_id;
            }
            else {
                $data->groupvihara_id = $this->groupvihara_id;
            }
            try {
                $data->save();

            } catch (\Exception $e) {
                 return $e->getMessage();
   }
            $this->updateKelas();
            $this->clear_fields();
            // session()->flash('message', 'Data Kelas Sudah di Simpan');
            $this->dispatchBrowserEvent('saved');

        } else {
            //  session()->flash('message', 'Data Sudah Ada');
            $this->dispatchBrowserEvent('duplicate');
        }

    }

    public function cancel () {
        $this->clear_fields();
        $this->is_add=true;
        $this->render();
        $this->close();

    }

    public function deleteConfirmation ($id) {

        $is_used = check_daftarkelas_is_used($id);

        if($is_used == null) {
            $data = Daftarkelas::find($id);
            $namakelas = getKelas($data->kelas_id);
            $namagroup = getGroupVihara($data->groupvihara_id);
            $this->dispatchBrowserEvent('delete_confirmation', [
                'title' => 'Yakin Untuk Hapus Data',
                //  'text' => "You won't be able to revert this!",
                  'text' => "Data Kelas : " . $namakelas . ", di Cetya : " . $namagroup,
                 'icon' => 'warning',
                 'id' => $id,
            ]);
        } else {

            $this->dispatchBrowserEvent('canNotDelete', [
                // 'title' => 'Yakin Untuk Hapus Data',
                //   'text' => "Data Kelas : " . $namakelas . ", di Cetya : " . $namagroup,
                //  'icon' => 'warning',
                //  'id' => $id,
            ]);

        }



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
    //     dd('hello');
    //     $this->id_daftarkelas = $id;
    //     $data = Daftarkelas::find($id);
    //     $this->kelas_id = $data->kelas_id;
    //     $this->groupvihara_id = $data->groupvihara_id;
    //     $this->is_add=false;
    // }

    public function clear_fields() {
        // $this->reset();
    }

    public function update() {
        // $this->validate([
        //     'nama_kelas' => 'required|unique:kelas,nama_kelas,'.$this->id_daftarkelas
        // ]);

        if($this->checkDuplicate() == false){
        $data = Daftarkelas::find($this->id_daftarkelas);
        $data->kelas_id = $this->kelas_id;
        $data->groupvihara_id = $this->groupvihara_id;
        $data->save();
        // $this->is_edit=false;
        $this->clear_fields();
        $this->is_add=true;
        // session()->flash('message', 'Data Kelas Sudah di Update');
        $this->dispatchBrowserEvent('updated');
        } else {
            $this->dispatchBrowserEvent('duplicate');
        }
    }

    public function render()
    {
        // $branch = Branch::all();
        $group = Groupvihara::all();


        if ( Auth::user()->role != 3 ) {
            $this->selectedGroup = Auth::user()->groupvihara_id;
        } else {
            $this->selectedGroup  = $this->groupvihara_id;
        }
            $daftarkelas = Daftarkelas::orderBy('id', 'asc')
            ->where('groupvihara_id', $this->selectedGroup)
            ->paginate(5);
            $existingKelas = [];
            foreach($daftarkelas as $dk) {
                $existingKelas[] = $dk->kelas_id;
            }


            $kelas = Kelas::whereNotIn('id', $existingKelas)->get();


        return view('livewire.daftarkelaswire', compact(['daftarkelas', 'kelas', 'group']))
        ->extends('layouts.main')
        ->section('content');
    }
}

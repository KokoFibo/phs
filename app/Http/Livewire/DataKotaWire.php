<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Kota;
use Livewire\Component;
use App\Models\Province;
use Livewire\WithPagination;


class DataKotaWire extends Component
{
    public $propinsi, $namakota;
    public $selectedPropinsi = NULL;
    public $selectedNamaKota = NULL;
    public $nama_kota;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // public $is_edit = false;
    public $is_add = true;
    protected $listeners = ['delete'];


    public function mount  () {
        $this->propinsi = Province::orderBy('nama', 'asc')->get();
        $this->namakota = collect();
        // $this->namakota = "";
        
    }
   
    public function  clear_fields() {
    
        $this->propinsi= '';
        $this->nama_kota='';
        
    }
    public function updatedSelectedPropinsi ($propinsi) {
        $this->namakota = City::orderBy('nama', 'asc')->where('province_id', $propinsi)->get();
        $this->selectedNamaKota = NULL;
    }

    
 
    public function store () {
      

         $this->validate([
            'nama_kota' => 'unique:kotas,nama_kota',
        ]);
        $data_kota = new Kota();
        $data_kota->nama_kota = $this->nama_kota;
        $data_kota->save(); 
        // $this->redirect(route('adddata'));
        $this->clear_fields();   
        // $this->is_edit=false;
        // $this->is_add=true;
        session()->flash('message', 'Data Kota Sudah di Simpan');


    }


    public function edit ($id) {
        $data = Kota::find($id);
        $this->current_id = $id;
        $this->nama_kota = $data->nama_kota;
        // $this->selectedNamaKota = $data->nama_kota;
        // $this->selectedPropinsi = $data->nama_kota;
       
         $this->is_add=false;
    }

    public function update () {
        $this->validate([
            'nama_kota' => 'unique:kotas,nama_kota,'.$this->current_id,
        ]);

        $data = Kota::find($this->current_id);
        $data->nama_kota = $this->nama_kota;
        $data->save();
        $this->clear_fields();   
        session()->flash('message', 'Data Kota Sudah di Update');


        $this->is_add = true;
        // $this->is_edit = false;

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

    public function delete ($id) {
        $data = Kota::find($id);
        $data->delete();

        $this->dispatchBrowserEvent('deleted');
    // session()->flash('message', 'Data Sudah di Delete');


    }

    
   
    
    public function render()
    { 
        $kota = Kota::orderBy('nama_kota', 'asc')->paginate(5);
        return view('livewire.data-kota-wire', compact('kota'));
    }
}

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
    public $is_edit = 'false';
    public $is_add = 'false';

    public function mount  () {
        $this->propinsi = Province::orderBy('nama', 'asc')->get();
        $this->namakota = collect();
        
    }
    // public function rules () {
    //     return [
    //         'kota' => ['unique'],
    //         'kota' => ['unique:kota, kota'],

    //     ];
    // }

    // public function updated($fields) {
    //     $this->validateOnly($fields);
    // }
    public function  clear_fields() {
    
        $this->propinsi= '';
        $this->nama_kota='';
        
    }
    public function updatedSelectedPropinsi ($propinsi) {
        $this->namakota = City::orderBy('nama', 'asc')->where('province_id', $propinsi)->get();
        $this->selectedNamaKota = NULL;
    }

    protected $rules = [ 
             'nama_kota' => 'unique:kotas,nama_kota',
            //  'nama' => Rule::unique(Kota::class),
    ];
 
    public function store () {
        // $validatedData = $this->validate();
         $this->validate();
        $data_kota = new Kota();
        $data_kota->nama_kota = $this->nama_kota;
        $data_kota->save(); 
        // $this->redirect(route('adddata'));
        $this->is_edit=true;
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

        session()->flash('message', 'Data Branch Sudah di Update');

        $this->clear_fields();    
        $this->is_edit=false;
        $this->is_add=false; 
        
        // hiding the Modal after run Add Data 
        // $this->dispatchBrowserEvent('close-modal');

    }

    public function edit ($id) {
        $data = Kota::find($id);
        $this->current_id = $id;
        $this->nama_kota = $data->nama_kota;
        $this->selectedNamaKota = $data->nama_kota;
        $this->selectedPropinsi = $data->nama_kota;
       
        $this->is_edit=true;
        $this->is_add=false;
    }
    public function new () {
        $this->clear_fields();   
        $this->is_edit=false;
        $this->is_add=true; 
    }
    
    public function delete ($id) {

        $data = Kota::find($id);
        $data->delete();

    }
    
    public function render()
    { 
        $kota = Kota::orderBy('nama_kota', 'asc')->paginate(5);
        return view('livewire.data-kota-wire', compact('kota'));
    }
}

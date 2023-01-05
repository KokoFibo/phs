<?php

namespace App\Http\Livewire\Datapelita;

use Auth;
use Carbon\Carbon;
use App\Models\Kota;
use Livewire\Request;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class Adddata extends Component
{

    public $columnName = 'data_pelitas.id', $direction = 'desc', $startUmur, $endUmur, $startDate, $endDate, $jen_kel;
    public $search = '';
    public $branch_id = '';
    public $nama_umat, $mandarin, $gender, $umur, $umur_sekarang;
    public $alamat, $kota, $telp, $hp, $email;
    public $pengajak, $penjamin, $pandita_id, $kota_id, $tgl_mohonTao, $status;
    public $current_id, $delete_id;
    public $namaPandita, $namaKota;
    public $kode_branch;
    

    public function mount ($kode_branch) {
        $this->kode_branch = $kode_branch;
    }
    public function rules () {

        return [
            'nama_umat' => ['required'],
            'mandarin' => ['nullable'],
            'gender' => ['required'],
            'umur' => ['required', 'numeric', 'min:1', 'max:150'],
            'umur_sekarang' => ['nullable'],
            'alamat' => ['required'],
            'kota_id' => ['required'],
            'telp' => ['nullable', 'numeric', 'min_digits:9', 'max_digits:13'],
            'hp' => ['nullable', 'numeric'],
            'email' => ['nullable', 'email'],
            'pengajak' => ['required'],
            'penjamin' => ['required'],
            'pandita_id' => ['required'],
            'tgl_mohonTao' => ['required','date','before:tomorrow'],
            'status' => ['nullable'],
            // 'branch_id' => ['required']
        ];

    }

    public function hitungUmurSekarang($tgl, $umur) {
        $now = Carbon::now();
        $tahun = $now->year;
        $year = date('Y', strtotime($tgl));
        $selisih = $tahun - $year;
        return $umur + $selisih;
    }

    public function updated($fields) {
        $this->validateOnly($fields);
    }

    public function store () {
        $validatedData = $this->validate();
        session()->flash('message', '');
       
        $data_umat = new DataPelita();
        $this->branch_id = Auth::user()->branch_id;
        // $data_umat->branch_id = $this->branch_id;
        $data_umat->branch_id = $this->kode_branch;
        $data_umat->nama_umat = $this->nama_umat;
        $data_umat->mandarin = $this->mandarin;
        $data_umat->gender = $this->gender;
        $data_umat->umur = $this->umur;
        $data_umat->umur_sekarang = $this->hitungUmurSekarang($this->tgl_mohonTao,$this->umur);
        $data_umat->alamat = $this->alamat;
        $data_umat->kota_id = $this->kota_id;
        $data_umat->telp = $this->telp;
        $data_umat->hp = $this->hp;
        $data_umat->email = $this->email;
        $data_umat->pengajak = $this->pengajak;
        $data_umat->penjamin = $this->penjamin;
        $data_umat->pandita_id = $this->pandita_id;
        $data_umat->tgl_mohonTao = $this->tgl_mohonTao;
        $data_umat->status = 'Active';

        // update data kota_is_Used
        $data_kota = Kota::find($this->kota_id);
        $data_kota->kota_is_used = true;
        $data_kota->save();
        
        
        // update data Pandita_is_Used
        $data_pandita = Pandita::find($this->pandita_id);
        $data_pandita->pandita_is_used = true;
        $data_pandita->save();

        // update data branch_is_Used
        $data_branch = Branch::find($this->branch_id);
        $data_branch->branch_is_used = true;
        $data_branch->save();


        $data_umat->save();

        session()->flash('message', 'Data Umat Sudah di tambah');
        $this->dispatchBrowserEvent('stored', [
            'title' => 'Data Added'
        ]);

        $this->clear_fields();    
        
        // hiding the Modal after run Add Data 
        // $this->dispatchBrowserEvent('close-modal');

        // $this->redirect('/main');

    }
    public function  clear_fields() {
    
        $this->branch_id= '';
        $this->nama_umat='';
        $this->mandarin='';
        $this->gender='';
        $this->umur='';
        $this->umur_sekarang='';
        $this->alamat='';
        $this->kota_id=''; 
        $this->telp='';
        $this->hp='';
        $this->email='';
        $this->pengajak='';
        $this->penjamin='';
        $this->pandita_id='';
        $this->tgl_mohonTao=NULL;
    }
    public function render()
    {
        
        // $alldatapelita =DataPelita::orderBy('nama_umat', 'asc')->get();
        $allKota = Kota::orderBy('nama_kota', 'asc')->get();
        $dataPandita = Pandita::all();
        $branch = Branch::all();
       
        // $datapelita = DataPelita::where('branch_id', Auth::user()->branch_id)->get();
        $datapelita = DataPelita::orderBy('nama_umat', 'asc')
        ->where('branch_id', $this->kode_branch)->get();
        return view('livewire.datapelita.adddata', compact(['datapelita', 'branch', 'dataPandita', 'allKota']))
        ->extends('layouts.app')
        ->section('content');
    }
} 
 
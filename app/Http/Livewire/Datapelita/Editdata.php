<?php

namespace App\Http\Livewire\Datapelita;
use Carbon\Carbon;
use App\Models\Kota;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;
use Auth;

class Editdata extends Component
{
    public $columnName = 'data_pelitas.id', $direction = 'desc', $startUmur, $endUmur, $startDate, $endDate, $jen_kel;
    public $search = '';
    public $branch_id;
    public $nama_umat, $mandarin, $gender, $umur, $umur_sekarang;
    public $alamat, $kota, $telp, $hp, $email;
    public $pengajak, $penjamin, $pandita_id, $kota_id, $tgl_mohonTao, $status;
    public $current_id, $delete_id;
    public $namaPandita, $namaKota, $kode_branch;

    // public function mount ($current_id) {
    //     $this->current_id = $current_id;
    // }

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
    public function mount ($current_id) {
        $this->current_id = $current_id;
        $data = DataPelita::find($this->current_id);
         $this->branch_id = $data->branch_id;
          $this->nama_umat = $data->nama_umat; 
          $this->mandarin = $data->mandarin;
          $this->gender = $data->gender;
          $this->umur = $data->umur;
        // $data->umur_sekarang = $this->hitungUmurSekarang($this->tgl_mohonTao,$this->umur);
          $this->alamat = $data->alamat;
          $this->kota_id = $data->kota_id;
          $this->telp = $data->telp;
          $this->hp = $data->hp;
          $this->email = $data->email;
          $this->pengajak = $data->pengajak;
          $this->penjamin = $data->penjamin;
          $this->pandita_id = $data->pandita_id;
          $this->tgl_mohonTao = $data->tgl_mohonTao;
        $this->status = $data->status;
        

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

    public function update () {
        $validatedData = $this->validate();
        session()->flash('message', '');
       

        $data_umat = DataPelita::find($this->current_id);

        // $data_umat->branch_id = $this->branch_id;
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
        $data_umat->status = $this->status;

        

        $data_umat->save();
        session()->flash('message', 'Data Umat Sudah di update');
        // $this->dispatchBrowserEvent('updated', [
        //     'title' => 'Data Updated'
        // ]);
        
        $this->clear_fields();   
        
        
       
        $this->redirect(route("main"));

    }
    public function  clear_fields() {
    
        // $this->branch_id= $this->defaultBranch_id;
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
        $allKota = Kota::orderBy('nama_kota', 'asc')->get();
        $dataPandita = Pandita::all();
        $branch = Branch::all();
        // $data = DataPelita::find($this->current_id);
        // $this->branch_id = $data->branch_id;
        //   $this->nama_umat = $data->nama_umat;
        //   $this->mandarin = $data->mandarin;
        //   $this->gender = $data->gender;
        //   $this->umur = $data->umur;
        // // $data->umur_sekarang = $this->hitungUmurSekarang($this->tgl_mohonTao,$this->umur);
        //   $this->alamat = $data->alamat;
        //   $this->kota_id = $data->kota_id;
        //   $this->telp = $data->telp;
        //   $this->hp = $data->hp;
        //   $this->email = $data->email;
        //   $this->pengajak = $data->pengajak;
        //   $this->penjamin = $data->penjamin;
        //   $this->pandita_id = $data->pandita_id;
        //   $this->tgl_mohonTao = $data->tgl_mohonTao;
        // $this->status = $data->status;
        $datapelita = DataPelita::orderBy('nama_umat', 'asc')
        ->where('branch_id', $this->branch_id)->get();

        return view('livewire.datapelita.editdata', compact([ 'datapelita', 'branch', 'dataPandita', 'allKota']))
        ->extends('layouts.app')
        ->section('content');
        
    }
}

<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Kota;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;

class Editumatwire extends Component
{

    public $nama, $query,  $nama_pengajak, $nama_penjamin, $kode_branch, $current_id;
    public $nama_umat, $mandarin, $umur, $alamat, $kota_id, $telp, $hp;
    public $email, $gender, $tgl_mohonTao, $pandita_id, $pengajak_id, $penjamin_id, $status, $branch_id;

    protected $rules = [
        'nama_umat' => 'required',
        'mandarin' => 'nullable',
        'gender' => 'required',
        'umur' => 'required|numeric|min:1|max:150',
        // 'umur_sekarang' => 'nullable',

        'alamat' => 'required',
        'kota_id' => 'required',
        'telp' => 'nullable|numeric|min_digits:9|max_digits:13',
        'hp' => 'nullable|numeric',
        'email' => 'nullable|email',
        'pengajak_id' => 'required',
        'penjamin_id' => 'required',
        'pandita_id' => 'required',
        'tgl_mohonTao' => 'required|date|before:tomorrow',
        'status' => 'nullable',
];

public function updated($fields) {
        $this->validateOnly($fields);
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
          $this->pengajak_id = $data->pengajak_id;
          $this->nama_pengajak = getName($data->pengajak_id);
          $this->penjamin_id = $data->penjamin_id;
          $this->nama_penjamin = getName($data->penjamin_id);
          $this->pandita_id = $data->pandita_id;
          $this->tgl_mohonTao = $data->tgl_mohonTao;
        $this->status = $data->status;

        $query = "";
        $nama = [];

    }

    public function hitungUmurSekarang($tgl, $umur) {
        $now = Carbon::now();
        $tahun = $now->year;
        $year = date('Y', strtotime($tgl));
        $selisih = $tahun - $year;
        return $umur + $selisih;
    }

    public function getDataPengajak ($nama, $id) {
        $this->nama_pengajak = $nama;
        $this->pengajak_id = $id;
    }
    public function getDataPenjamin ($nama, $id) {
        $this->nama_penjamin = $nama;
        $this->penjamin_id = $id;
    }
    public function updatedQuery () {
        $this->nama = DataPelita::where('nama_umat', 'like', '%' . $this->query . '%')
        ->get()
        ->toArray();
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
        $data_umat->pengajak_id = $this->pengajak_id;
        $data_umat->penjamin_id = $this->penjamin_id;
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
        $this->pengajak_id='';
        $this->penjamin_id='';
        $this->pandita_id='';
        $this->tgl_mohonTao=NULL;
    }

    public function render()
    {
        $datapandita = Pandita::orderBy('nama_pandita', 'asc')->get();
        $datakota = Kota::orderBy('nama_kota', 'asc')->get();
        return view('livewire.editumatwire', compact(['datapandita', 'datakota']))
        ->extends('layouts.secondMain')
        ->section('content');
    }
}

<?php

namespace App\Http\Livewire;

use Auth;
use Carbon\Carbon;
use App\Models\Kota;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;

class Addumatwire extends Component
{
    public $nama, $query, $pengajak_id, $penjamin_id, $pengajak, $penjamin, $kode_branch;
    public $nama_umat, $mandarin, $umur, $alamat, $kota_id, $telp, $hp;
    public $email, $gender, $tgl_mohonTao, $pandita_id, $status="Active", $branch_id;

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
        'pengajak' => 'required',
        'penjamin_id' => 'required',
        'pandita_id' => 'required',
        'tgl_mohonTao' => 'required|date|before:tomorrow',
        'status' => 'nullable',
];

public function updated($fields) {
        $this->validateOnly($fields);
}

    public function mount () {

        $query = "";
        $nama = [];
    }

    public function getDataPengajak ($nama, $id) {
        $this->pengajak = $nama;
        $this->pengajak_id = $id;
    }
    public function getDataPenjamin ($nama, $id) {
        $this->penjamin = $nama;
        $this->penjamin_id = $id;
    }

    public function updatedQuery () {
        $this->nama = DataPelita::where('nama_umat', 'like', '%'. $this->query .'%')
        ->get()
        ->toArray();
    }

    public function hitungUmurSekarang($tgl, $umur) {
        $now = Carbon::now();
        $tahun = $now->year;
        $year = date('Y', strtotime($tgl));
        $selisih = $tahun - $year;
        return $umur + $selisih;
    }


    public function store () {
        $validatedData = $this->validate();
        session()->flash('message', '');

        $data_umat = new DataPelita();
        $this->branch_id = Auth::user()->branch_id;
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
        $data_umat->pengajak_id = $this->pengajak_id;
        $data_umat->pengajak = $this->pengajak;
        $data_umat->penjamin_id = $this->penjamin_id;
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
        $this->pengajak_id='';
        $this->pengajak='';
        $this->penjamin_id='';
        $this->penjamin='';
        $this->pandita_id='';
        // $this->pandita='';
        $this->tgl_mohonTao='';
    }


    public function render()
    {
        $datapandita = Pandita::orderBy('nama_pandita', 'asc')->get();
        $datakota = Kota::orderBy('nama_kota', 'asc')->get();

        return view('livewire.addumatwire', compact(['datapandita', 'datakota']))
        ->extends('layouts.secondMain')
        ->section('content');
    }
}

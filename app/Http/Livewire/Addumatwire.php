<?php

namespace App\Http\Livewire;

use Auth;
use Carbon\Carbon;
use App\Models\Kota;
use App\Models\User;
use App\Models\Groupvihara;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use Illuminate\Support\Str;

class Addumatwire extends Component
{
    public $nama, $query, $pengajak_id, $penjamin_id, $pengajak, $penjamin, $kode_branch;
    public $nama_umat, $nama_alias, $mandarin,  $tgl_lahir, $alamat, $kota_id, $telp, $hp;
    public $email, $gender, $tgl_mohonTao, $tgl_mohonTao_lunar, $tgl_sd3h, $tgl_vtotal, $pandita_id, $status = "Active", $branch_id;
    public $umur_sekarang;
    public $selectedGroup, $selectGroup, $selectBranch, $selectKota,  $selectedBranch, $selectedKota, $selectPandita, $selectedPandita;
    public $tanggal_imlek, $keterangan;
    public function mount()
    {
        $this->selectedGroup = Auth::user()->groupvihara_id;
        $this->selectedBranch = Auth::user()->branch_id;
        $this->selectedKota = Auth::user()->kota_id;
        $this->selectedPandita = Auth::user()->pandita_id;

        $this->selectGroup = Groupvihara::all();
        // $this->selectBranch = Branch::all();
        $this->selectBranch = Branch::where('groupvihara_id', $this->selectedGroup)->get();
        $this->selectKota = Kota::all();
        $this->selectPandita = Pandita::all();
        $query = "";
        $nama = [];
        $this->tgl_mohonTao = Carbon::now()->format('Y-m-d');
        $this->tgl_mohonTao_lunar = convertToLunar($this->tgl_mohonTao);
        $this->tanggal_imlek = lunarInChinese(date('Y-m-d', strtotime($this->tgl_mohonTao_lunar)));
    }
    public function updatedSelectedGroup()
    {

        $this->selectBranch = Branch::where('groupvihara_id', $this->selectedGroup)->get();
        $this->selectedBranch = $this->selectBranch[0]->id;
    }

    public function updatedTglMohonTao()
    {
        try {
            $this->tgl_mohonTao_lunar = convertToLunar($this->tgl_mohonTao);
            $this->tanggal_imlek = lunarInChinese(date('Y-m-d', strtotime($this->tgl_mohonTao_lunar)));
        } catch (\Exception $e) {
            $this->tgl_mohonTao_lunar = '';
        }
        // $this->tgl_mohonTao = Carbon::now()->format('Y-m-d');
    }

    protected $rules = [
        'nama_umat' => 'required',
        'nama_alias' => 'nullable',
        'mandarin' => 'nullable',
        'gender' => 'required',
        'tgl_lahir' => 'required|date|before:tomorrow',
        'umur_sekarang' => 'nullable',
        'alamat' => 'required',
        // 'kota_id' => 'required',
        'telp' => 'nullable',
        'hp' => 'nullable|min_digits:9|max_digits:13',
        'email' => 'nullable|email',
        // 'pengajak_id' => 'required',
        'pengajak' => 'required',
        // 'penjamin_id' => 'required',
        'penjamin' => 'required',
        // 'pandita_id' => 'required',
        'tgl_mohonTao' => 'nullable|date|before:tomorrow',
        'tgl_sd3h' => 'nullable|date|after_or_equal:tgl_mohonTao|before:tomorrow',
        'tgl_vtotal' => 'nullable|date|after_or_equal:tgl_sd3h|before:tomorrow|prohibited_if:tgl_sd3h,=,null',

        'status' => 'nullable',
        'keterangan' => 'nullable',


    ];

    public function setDefault()
    {
        $data = User::find(Auth::user()->id);
        $data->groupvihara_id = $this->selectedGroup;
        $data->branch_id = $this->selectedBranch;
        $data->kota_id = $this->selectedKota;
        $data->pandita_id = $this->selectedPandita;
        $data->save();
        $this->dispatchBrowserEvent('success', ['message' => 'Set to default']);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }





    public function store()
    {
        $validatedData = $this->validate();
        session()->flash('message', '');

        $data_umat = new DataPelita();
        $this->branch_id = Auth::user()->branch_id;


        $data_umat->branch_id = $this->selectedBranch;
        $data_umat->kota_id = $this->selectedKota;
        $data_umat->pandita_id = $this->selectedPandita;

        $data_umat->nama_umat = Str::title($this->nama_umat);
        $data_umat->nama_alias = Str::title($this->nama_alias);

        $data_umat->mandarin = $this->mandarin;
        $data_umat->gender = $this->gender;
        $data_umat->tgl_lahir = $this->tgl_lahir;
        $data_umat->umur_sekarang = hitungUmurSekarang($this->tgl_lahir);
        $data_umat->alamat = Str::title($this->alamat);
        $data_umat->telp = $this->telp;
        $data_umat->hp = $this->hp;
        $data_umat->email = $this->email;
        // $data_umat->pengajak_id = $this->pengajak_id;
        $data_umat->pengajak = Str::title($this->pengajak);
        // $data_umat->penjamin_id = $this->penjamin_id;
        $data_umat->penjamin = Str::title($this->penjamin);
        // $data_umat->pandita_id = $this->pandita_id;
        $data_umat->tgl_mohonTao = empty($this->tgl_mohonTao) ?  Carbon::parse(Carbon::now()) : $this->tgl_mohonTao;
        $data_umat->tgl_mohonTao_lunar = empty($this->tgl_mohonTao_lunar) ?  convertToLunar($data_umat->tgl_mohonTao) : $this->tgl_mohonTao_lunar;
        $data_umat->tgl_sd3h = empty($this->tgl_sd3h) ?  null : $this->tgl_sd3h;
        $data_umat->tgl_vtotal = empty($this->tgl_vtotal) ?  null : $this->tgl_vtotal;
        $data_umat->keterangan = $this->keterangan;



        $data_umat->status = 'Active';

        // update data kota_is_Used
        $data_kota = Kota::find($this->selectedKota);
        $data_kota->kota_is_used = true;
        $data_kota->save();


        // update data Pandita_is_Used
        $data_pandita = Pandita::find($this->selectedPandita);
        $data_pandita->pandita_is_used = true;
        $data_pandita->save();

        // update data branch_is_Used
        $data_branch = Branch::find($this->selectedBranch);
        $data_branch->branch_is_used = true;
        $data_branch->save();


        $data_umat->save();

        // session()->flash('message', 'Data Umat Sudah di tambah');
        $this->dispatchBrowserEvent('success', ['message' => 'Data Added']);

        $this->clear_fields();
    }
    public function  clear_fields()
    {

        $this->branch_id = '';
        $this->nama_umat = '';
        $this->nama_alias = '';
        $this->mandarin = '';
        $this->gender = '';
        $this->tgl_lahir = '';
        $this->umur_sekarang = '';
        $this->alamat = '';
        $this->kota_id = '';
        $this->telp = '';
        $this->hp = '';
        $this->email = '';
        // $this->pengajak_id='';
        $this->pengajak = '';
        // $this->penjamin_id='';
        $this->penjamin = '';
        $this->pandita_id = '';
        // $this->pandita='';
        $this->tgl_mohonTao = '';
        $this->tgl_sd3h = '';
        $this->tgl_vtotal = '';
        $this->tgl_mohonTao = Carbon::now()->format('Y-m-d');
        $this->tgl_mohonTao_lunar = convertToLunar($this->tgl_mohonTao);
        $this->keterangan = '';
    }


    public function render()
    {
        $datapandita = Pandita::orderBy('nama_pandita', 'asc')->get();
        $datakota = Kota::orderBy('nama_kota', 'asc')->get();


        return view('livewire.addumatwire', compact(['datapandita', 'datakota']))
            ->extends('layouts.main')
            ->section('content');
    }
}

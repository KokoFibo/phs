<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Kota;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use Illuminate\Support\Str;

class Editumatwire extends Component
{

    public $nama, $query,  $nama_pengajak, $nama_penjamin, $kode_branch, $current_id;
    public $nama_umat, $nama_alias, $mandarin,  $tgl_lahir, $alamat, $kota_id, $telp, $hp;
    public $email, $gender, $tgl_mohonTao, $tgl_mohonTao_lunar, $tgl_sd3h, $tgl_vtotal, $pandita_id,  $pengajak, $penjamin, $status, $branch_id;
    public $umur_sekarang, $keterangan, $tanggal_imlek;
    protected $rules = [
        'nama_umat' => 'required',
        'nama_alias' => 'nullable',
        'mandarin' => 'nullable',
        'gender' => 'required',


        'tgl_mohonTao' => 'required|date|before_or_equal:tgl_mohonTao',
        'alamat' => 'required',
        'kota_id' => 'required',
        'telp' => 'nullable',
        'hp' => 'nullable|min_digits:9|max_digits:13|numeric',
        'email' => 'nullable|email',
        'pengajak' => 'required',
        'penjamin' => 'required',
        'pandita_id' => 'required',
        'tgl_mohonTao' => 'nullable|date|before:tomorrow',
        'tgl_sd3h' => 'nullable|date|after_or_equal:tgl_mohonTao|before:tomorrow',
        'tgl_vtotal' => 'nullable|date|after_or_equal:tgl_sd3h|before:tomorrow|prohibited_if:tgl_sd3h,=,null',
        'status' => 'nullable',
        'keterangan' => 'nullable',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
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

    public function mount($current_id)
    {
        $this->current_id = $current_id;
        $data = DataPelita::find($this->current_id);
        $this->branch_id = $data->branch_id;
        $this->nama_umat = $data->nama_umat;
        $this->nama_alias = $data->nama_alias;
        $this->mandarin = $data->mandarin;
        $this->gender = $data->gender;
        $this->tgl_lahir = $data->tgl_lahir;
        $this->umur_sekarang = $data->umur_sekarang;
        $this->alamat = $data->alamat;
        $this->kota_id = $data->kota_id;
        $this->telp = $data->telp;
        $this->hp = $data->hp;
        $this->email = $data->email;
        $this->pengajak = $data->pengajak;
        $this->penjamin = $data->penjamin;
        $this->pandita_id = $data->pandita_id;
        $this->tgl_mohonTao = $data->tgl_mohonTao;
        $this->tgl_mohonTao_lunar = $data->tgl_mohonTao_lunar;
        $this->tgl_sd3h = $data->tgl_sd3h;
        $this->tgl_vtotal = $data->tgl_vtotal;
        $this->status = $data->status;
        $this->keterangan = $data->keterangan;
        $this->tanggal_imlek = lunarInChinese($this->tgl_mohonTao_lunar);

        $query = "";
        $nama = [];
    }



    // public function getData


    public function update()
    {
        $validatedData = $this->validate();
        session()->flash('message', '');


        $data_umat = DataPelita::find($this->current_id);


        $data_umat->nama_umat = Str::title($this->nama_umat);
        $data_umat->nama_alias = Str::title($this->nama_alias);

        $data_umat->branch_id = $this->branch_id;
        $data_umat->mandarin = $this->mandarin;
        $data_umat->gender = $this->gender;
        $data_umat->tgl_lahir = $this->tgl_lahir;
        $data_umat->umur_sekarang = hitungUmurSekarang($this->tgl_lahir);
        $data_umat->alamat = Str::title($this->alamat);
        $data_umat->kota_id = $this->kota_id;
        $data_umat->telp = $this->telp;
        $data_umat->hp = $this->hp;
        $data_umat->email = $this->email;
        $data_umat->pengajak = Str::title($this->pengajak);
        $data_umat->penjamin = Str::title($this->penjamin);
        $data_umat->pandita_id = $this->pandita_id;
        $data_umat->tgl_mohonTao = $this->tgl_mohonTao;
        $data_umat->tgl_mohonTao_lunar = convertToLunar($this->tgl_mohonTao);

        $data_umat->tgl_sd3h = empty($this->tgl_sd3h) ?  null : $this->tgl_sd3h;
        $data_umat->tgl_vtotal = empty($this->tgl_vtotal) ?  null : $this->tgl_vtotal;




        $data_umat->status = $this->status;
        $data_umat->keterangan = $this->keterangan;



        $data_umat->save();

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

        $this->dispatchBrowserEvent('success', ['message' => 'Data Umat Sudah di Update']);

        // session()->flash('message', 'Data Umat Sudah di update');

        $this->clear_fields();
        $this->redirect(route("main"));
    }

    public function  clear_fields()
    {

        // $this->branch_id= $this->defaultBranch_id;
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
        $this->pengajak = '';
        $this->penjamin = '';
        $this->pandita_id = '';
        $this->tgl_mohonTao = '';
        $this->tgl_sd3h = '';
        $this->tgl_vtotal = '';
    }

    public function render()
    {
        $datapandita = Pandita::orderBy('nama_pandita', 'asc')->get();
        $datakota = Kota::orderBy('nama_kota', 'asc')->get();
        $databranch = Branch::orderBy('nama_branch', 'asc')->get();
        return view('livewire.editumatwire', compact(['datapandita', 'datakota', 'databranch']))
            // ->extends('layouts.secondMain')
            ->extends('layouts.main')
            ->section('content');
    }
}

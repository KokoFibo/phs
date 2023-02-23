<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Kota;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;


class Viewumatwire extends Component
{

    public $nama, $query,  $nama_pengajak, $nama_penjamin, $kode_branch, $current_id;
    public $nama_umat, $nama_alias, $mandarin,  $tgl_lahir,  $alamat, $kota_id, $telp, $hp;
    public $email, $gender, $tgl_mohonTao, $tgl_sd3h, $tgl_vtotal, $pandita_id, $pengajak_id, $penjamin_id, $pengajak, $penjamin, $status, $branch_id;
    public $last_update, $keterangan;
    public function mount ($current_id) {
        $this->current_id = $current_id;
        $data = DataPelita::find($this->current_id);
         $this->branch_id = $data->branch_id;
          $this->nama_umat = $data->nama_umat;
          $this->nama_alias = $data->nama_alias;
          $this->mandarin = $data->mandarin;
          $this->gender = $data->gender;
          $this->tgl_lahir = $data->tgl_lahir;
          $this->umur_sekarang = hitungUmurSekarang($data->tgl_lahir).' Tahun / '.$data->tgl_lahir;
          $this->alamat = $data->alamat;
          $this->kota_id = $data->kota_id;
          $this->telp = $data->telp;
          $this->hp = $data->hp;
          $this->email = $data->email;
          $this->pengajak_id = $data->pengajak_id;
          $this->pengajak = $data->pengajak;
        //   $this->nama_pengajak = getName($data->pengajak_id);
          $this->penjamin_id = $data->penjamin_id;
          $this->penjamin = $data->penjamin;
        //   $this->nama_penjamin = getName($data->penjamin_id);
          $this->pandita_id = $data->pandita_id;
          $this->tgl_mohonTao = $data->tgl_mohonTao;
          $this->tgl_sd3h = $data->tgl_sd3h;
          $this->tgl_vtotal = $data->tgl_vtotal;
        $this->status = $data->status;
        $this->keterangan = $data->keterangan;
        $this->last_update = $data->updated_at->diffForHumans();

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
    public function render()
    {
        $datapandita = Pandita::orderBy('nama_pandita', 'asc')->get();
        $datakota = Kota::orderBy('nama_kota', 'asc')->get();

        return view('livewire.viewumatwire', compact(['datapandita', 'datakota']))
        ->extends('layouts.secondMain')
        ->section('content');
    }
}

<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Kota;
use App\Models\Branch;
use App\Models\Pandita;
use Livewire\Component;
use App\Models\DataPelita;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Auth;


class Tablewire extends Component
{
    public $perpage = 5;
    public $columnName = 'data_pelitas.id', $direction = 'desc', $startUmur, $endUmur, $startDate, $endDate, $jen_kel;
    public $search = '';
    use WithPagination;
    public $branch_id;
    public $nama_umat, $mandarin, $gender, $umur, $umur_sekarang;
    public $alamat, $kota, $telp, $hp, $email;
    public $pengajak, $penjamin, $pandita_id, $kota_id, $tgl_mohonTao, $tgl_sd3h, $tgl_vtotal, $status;
    public $current_id, $delete_id;
    public $namaPandita, $namaKota;
    public $category="data_pelitas.nama_umat";
    public $kode_branch, $kode_branch_view, $kode_branch_khusus;
    public $nama_cetya, $nama_cetya_view, $pengajak_id, $penjamin_id;
    public $default;
    protected $listeners = ['delete'];
    // protected $listeners = ['resetfilter'];


    public function updatingSearch () {
        $this->resetPage();
    }

    public function resetFilter () {
        $this->perpage = 10;
        $this->search = '';
        $this->columnName = 'data_pelitas.id';
        $this->direction = 'desc';
        $this->startUmur = NULL;
        $this->endUmur = NULL;
        $this->startDate = NULL;
        $this->endDate = NULL;
        $this->jen_kel = NULL;
        $this->category="data_pelitas.nama_umat";
        $this->status="";
        $this->kode_branch="";
        $this->branch_id="";
        $this->resetPage();
        $this->default = true;
        $this->dispatchBrowserEvent('resetfield');

    }
    public function hitungUmurSekarang($tgl, $umur) {
        $now = Carbon::now();
        $tahun = $now->year;
        $year = date('Y', strtotime($tgl));
        $selisih = $tahun - $year;
        return $umur + $selisih;
    }

    public function deleteConfirmation ($id) {
        $data = DataPelita::find($id);
        $nama = $data->nama_umat;
        $this->dispatchBrowserEvent('delete_confirmation', [
            'title' => 'Yakin Untuk Hapus Data',
            //  'text' => "You won't be able to revert this!",
              'text' => "Data : " . $nama,
             'icon' => 'warning',
             'id' => $id,
        ]);
    }

    public function delete ($id) {
        $data = DataPelita::find($id);
        $data->delete();

        $this->dispatchBrowserEvent('deleted');
    // session()->flash('message', 'Data Sudah di Delete');
    }

    public function sortColumnName ($namaKolom) {
        $this->columnName = $namaKolom;
        $this->direction = $this->swapDirection();
    }
    public function swapDirection () {
        return $this->direction === 'asc' ? 'desc' : 'asc';
    }

    public function view ($id) {

        $this->current_id = $id;
        $data = DataPelita::find($id);

        if ($data) {
            $this->branch_id = $data->branch_id;
            $this->kode_branch_view = $this->branch_id;
            $this->nama_umat = $data->nama_umat;
            $this->mandarin = $data->mandarin;
            $this->gender = $data->gender;
            $this->umur = $data->umur;
            $this->umur_sekarang = $data->umur_sekarang;
            $this->alamat = $data->alamat;
            $this->kota_id = $data->kota_id;
            $this->telp = $data->telp;
            $this->hp = $data->hp;
            $this->email = $data->email;
            $this->pengajak = $data->pengajak;
            $this->pengajak_id = $data->pengajak_id;
            $this->penjamin = $data->penjamin;
            $this->penjamin_id = $data->penjamin_id;
            $this->pandita_id = $data->pandita_id;
            $np = Pandita::find($this->pandita_id);
            $this->namaPandita = $np->nama_pandita;
            $nk = Kota::find($this->kota_id);
            $this->namaKota = $nk->nama_kota;

            $this->tgl_mohonTao = $data->tgl_mohonTao;
            $this->status = $data->status;
            $this->tgl_sd3h = empty($data->tgl_sd3h) ? '-' : $data->tgl_sd3h;
            $this->tgl_vtotal = empty($data->tgl_vtotal) ? '-' : $data->tgl_vtotal;

        }
    }
    public function mount () {
        $this->default=true;
    }
    public function updatedJenKel () {
        $this->default=false;
    }

    public function updatedStatus () {
        $this->default=false;
    }

    public function updatedStartUmur () {
        if($this->startUmur != '')
        {

            $this->default=false;
        }
        else {
            $this->default=true;

        }
    }
    public function updatedEndUmur () {
        if($this->endUmur != '')
        {

            $this->default=false;
        }
        else {
            $this->default=true;

        }
    }
    public function updatedStartDate () {
        if($this->startDate != '')
        {

            $this->default=false;
        }
        else {
            $this->default=true;

        }
    }
    public function updatedEndDate () {
        if($this->endDate != '')
        {

            $this->default=false;
        }
        else {
            $this->default=true;

        }
    }
    public function updatedKodeBranch () {
        if($this->kode_branch != '')
        {

            $this->default=false;
        }
        else {
            $this->default=true;

        }
    }




    public function render()
    {
        if (Auth::user()->role == '3'){
            $this->branch_id = $this->kode_branch;
            $this->kode_branch_khusus = $this->kode_branch;
    }
    else {
        $this->branch_id = Auth::user()->branch_id;
        $this->kode_branch = $this->branch_id ;
        $this->kode_branch = Auth::user()->branch_id;

        $this->kode_branch_khusus = $this->kode_branch;
    }


    if($this->default == false || $this->search != '') {
        $datapelita = DB::table('data_pelitas')
        ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        ->orderBy($this->columnName, $this->direction)
        ->where($this->category,'like','%'.$this->search.'%')
        ->when($this->branch_id, function($query){
            $query->where('data_pelitas.branch_id', $this->branch_id );
        })
        ->when($this->startUmur, function($query){
            $query->where('data_pelitas.umur_sekarang', '>=', $this->startUmur );
        })
        ->when($this->endUmur, function($query){
            $query->where('data_pelitas.umur_sekarang', '<=', $this->endUmur );
        })
        ->when($this->startDate, function($query){
            $query->where('data_pelitas.tgl_mohonTao', '>=', $this->startDate );
        })
        ->when($this->endDate, function($query){
            $query->where('data_pelitas.tgl_mohonTao', '<=', $this->endDate );
        })
        ->when($this->jen_kel, function($query){
            $query->where('data_pelitas.gender',  $this->jen_kel );
        })
        ->when($this->status, function($query){
            $query->where('data_pelitas.status',  $this->status );
        })
        ->when($this->tgl_sd3h, function($query){
            $query->where('data_pelitas.tgl_sd3h',  '!=', null );
        })
        ->when($this->tgl_vtotal, function($query){
            $query->where('data_pelitas.tgl_vtotal',  '!=', null );
        })
        ->paginate($this->perpage);
    } elseif ($this->default == false && $this->search == ''){
        $datapelita = DB::table('data_pelitas')
        ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        ->orderBy($this->columnName, $this->direction)
        ->where($this->category,'like','%'.$this->search.'%')
        ->when($this->branch_id, function($query){
            $query->where('data_pelitas.branch_id', $this->branch_id );
        })
        ->when($this->startUmur, function($query){
            $query->where('data_pelitas.umur_sekarang', '>=', $this->startUmur );
        })
        ->when($this->endUmur, function($query){
            $query->where('data_pelitas.umur_sekarang', '<=', $this->endUmur );
        })
        ->when($this->startDate, function($query){
            $query->where('data_pelitas.tgl_mohonTao', '>=', $this->startDate );
        })
        ->when($this->endDate, function($query){
            $query->where('data_pelitas.tgl_mohonTao', '<=', $this->endDate );
        })
        ->when($this->jen_kel, function($query){
            $query->where('data_pelitas.gender',  $this->jen_kel );
        })
        ->when($this->status, function($query){
            $query->where('data_pelitas.status',  $this->status );
        })
        ->when($this->tgl_sd3h, function($query){
            $query->where('data_pelitas.tgl_sd3h', '!=', null );
        })
        ->when($this->tgl_vtotal, function($query){
            $query->where('data_pelitas.tgl_vtotal',  '!=', null );
        })
        ->paginate($this->perpage);


    }
    else {
        $datapelita = DB::table('data_pelitas')
        ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        // ->orderBy('data_pelitas.updated_at', 'desc')
        ->whereDate('data_pelitas.updated_at', '=', Carbon::today()->toDateString())
        ->when($this->branch_id, function($query){
            $query->where('data_pelitas.branch_id', $this->branch_id );
        })
        ->paginate($this->perpage);
    }



    $data_branch = Branch::find(Auth::user()->branch_id);
    $all_branch = Branch::orderBy('nama_branch', 'asc')->get();

    if($this->kode_branch_khusus != null){
        $dataft = Branch::find($this->kode_branch_khusus);
        $namaft = $dataft->nama_branch;
    }
    $namaft = 'Welcome';

    $dp = DataPelita::paginate(10);

    if($this->kode_branch != null) {
        $datacetya = Branch::find($this->kode_branch);
        $this->nama_cetya = $datacetya->nama_branch;
    } else {
        $datacetya = Branch::find(auth::user()->branch_id);
        $this->nama_cetya = $datacetya->nama_branch;

        // $this->nama_cetya = "Welcome";
    }
    if($this->kode_branch_view != NULL){
        $datacetya = Branch::find($this->kode_branch_view);
        $this->nama_cetya_view = $datacetya->nama_branch;
    }


        return view('livewire.tablewire', compact(['datapelita', 'data_branch', 'all_branch', 'namaft', 'dp']))
        ->extends('layouts.main')
        ->section('content');
    }
}













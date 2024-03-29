<?php

namespace App\Http\Livewire;

use Auth;
use Carbon\Carbon;
use App\Models\Kota;
use Livewire\Request;
use App\Models\Branch;
// use Barryvdh\DomPDF\PDF;
use App\Models\Pandita;
// use Maatwebsite\Excel\Excel;
use Livewire\Component;
use App\Models\DataPelita;
use App\Models\Groupvihara;
use Illuminate\Support\Arr;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DataPelitaExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;



class Tablewire extends Component
{
    public $perpage = 5;
    public $columnName = 'data_pelitas.id', $direction = 'desc', $startUmur, $endUmur, $startDate, $endDate, $jen_kel;
    public $search = '';
    use WithPagination;
    public $branch_id;
    public $nama_umat, $nama_alias, $mandarin, $gender, $umur, $umur_sekarang;
    public $alamat, $kota, $telp, $hp, $email;
    public $pengajak, $penjamin, $pandita_id, $kota_id, $tgl_mohonTao, $tgl_sd3h, $tgl_vtotal, $status;
    public $current_id, $delete_id;
    public $namaPandita, $namaKota;
    public $category="data_pelitas.nama_umat", $nama_kategori;
    public $kode_branch, $kode_branch_view, $kode_branch_khusus;
    public $nama_cetya, $nama_cetya_view, $pengajak_id, $penjamin_id;
    public $default;
    public $selectedId = [];
    public $selectedAll = [];
    public $selectAll = false;
    protected $listeners = ['delete'];
    // protected $listeners = ['resetfilter'];
    public $group_id;

    public $isTambahKolom=0, $kolomAlamat, $kolomKota, $kolomTelepon, $kolomHandphone, $kolomEmail=0;
    public $kolomSd3h=0, $kolomVTotal=0, $kolomStatus=0, $kolomKeterangan=0;


    public function checkIsTambahKolom () {
        if(
            $this->kolomAlamat == 1 ||
            $this->kolomKota == 1 ||
            $this->kolomTelepon == 1 ||
            $this->kolomHandphone == 1 ||
            $this->kolomEmail == 1 ||
            $this->kolomSd3h == 1 ||
            $this->kolomVTotal == 1 ||
            $this->kolomStatus == 1 ||
            $this->kolomKeterangan == 1

        ){
            $this->isTambahKolom = 1;
        }else {
            $this->isTambahKolom = 0;
        }
    }
    public function getCategory ($nama_kategori) {


            $this->nama_kategori = $nama_kategori;


        switch($nama_kategori) {
            case 'All categories':
                $this->category = "All categories";
                break;
            case 'Nama':
                $this->category = "Nama";
                break;
            case 'Pengajak':
                $this->category = "data_pelitas.pengajak";
                break;
            case 'Penjamin':
                $this->category = "data_pelitas.penjamin";
                break;
            case 'Pandita':
                $this->category = "panditas.nama_pandita";
                break;
            case 'Kota':
                $this->category = "kotas.nama_kota";
                break;
            case 'Alamat':
            $this->category = "data_pelitas.alamat";
            break;
        }



    }

    public function mount () {
        $this->default=true;
        $this->nama_kategori = "All categories";
        $this->category = "All categories";
    }
    public function updating () {

    }

public function updatedSelectAll () {
    if ($this->selectAll == true ) {
        $this->selectedId = $this->selectedAll;
    } else {
        $this->selectedId = [];
    }
}

    public function updatingKodeBranch () {
        // $this->group_id = "";
    }

    public function updatingGroupId () {
        $this->kode_branch = "";
    }
    public function cetak () {
        $datapelita = DataPelita::whereIn('id',$this->selectedId)->orderBy('nama_umat', 'asc')->get();
        // cara buka view blade
        return view('datapelitacetak', compact('datapelita'));
    }
    public function pdfdom () {
        $datapelita = DataPelita::whereIn('id',$this->selectedId)->orderBy('nama_umat', 'asc')->get();

        $pdfContent = PDF::loadView('datapelitapdf', ['datapelita'=>$datapelita])->setPaper('a4', 'landscape')->output();
        return response()->streamDownload(
             fn () => print($pdfContent),
             "pelita-hati.pdf"
        );

        // return response()->streamDownload(function () {
        //     $pdf = App::make('dompdf.wrapper');
        //     $pdf->loadHTML('<h1>Test</h1>');
        //     echo $pdf->stream();
        // }, 'test.pdf');
    }
    public function excel () {
        return (new DataPelitaExport($this->selectedId))->download('Data_pelita.xlsx');
    }

    public function updatingSearch () {
        $this->resetPage();
    }

    public function resetFilter () {
        $this->perpage = 5;
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
        $this->group_id="";
        $this->resetPage();
        $this->default = true;
        $this->selectedId = [];
        $this->selectedAll = [];
        $this->selectAll = false;
        $this->tgl_sd3h = false;
        $this->tgl_vtotal = false;
        // $this->dispatchBrowserEvent('resetfield');
        $this->isTambahKolom=0; $this->kolomAlamat=0; $this->kolomKota=0; $this->kolomTelepon=0; $this->kolomHandphone=0; $this->kolomEmail=0;
        $this->kolomSd3h=0; $this->kolomVTotal=0; $this->kolomStatus=0; $this->kolomKeterangan=0;
        $this->nama_kategori = "All categories";

        $this->category = "All categories";


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
            $this->nama_alias = $data->nama_alias;
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
            // $this->branch_id = $this->kode_branch;
            $this->kode_branch_khusus = $this->kode_branch;
            $this->branch_id = $this->kode_branch;
        }
        else {
        $this->branch_id = $this->kode_branch;
        // $this->branch_id = Auth::user()->branch_id;
        // $this->kode_branch = Auth::user()->branch_id;
        $this->group_id = Auth::user()->groupvihara_id;
        $this->kode_branch_khusus = $this->kode_branch;
    }


    if($this->default == false || $this->search != '') {

        // $datapelita = DB::table('data_pelitas')
        // ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        // ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        // ->select('data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')

        // $datapelita = DataPelita::query()


        $datapelita = Groupvihara::join('branches','groupviharas.id','=','branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
         ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('groupviharas.*', 'branches.*', 'data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        ->orderBy($this->columnName, $this->direction)

        ->where($this->category,'like','%'.trim($this->search).'%')
        ->when($this->category, function($query){
            if($this->category == 'Nama') {
                $query->where('data_pelitas.nama_umat','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.nama_alias','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.mandarin','like','%'.trim($this->search).'%');
            }
            elseif($this->category == 'All categories') {
                $query->where('data_pelitas.nama_umat','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.nama_alias','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.mandarin','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.pengajak','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.penjamin','like','%'.trim($this->search).'%')
                ->orWhere('panditas.nama_pandita','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.alamat','like','%'.trim($this->search).'%')
                ->orWhere('kotas.nama_kota','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.telp','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.hp','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.email','like','%'.trim($this->search).'%');
            }
            else {
                $query->where($this->category,'like','%'.trim($this->search).'%');
            }
        })
        ->when($this->group_id, function($query){
            $query->where('groupviharas.id',$this->group_id);
        })
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
        ;


    } elseif ($this->default == false && $this->search == ''){

        // $datapelita = DB::table('data_pelitas')
        // ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        // ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        // ->select('data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        // $datapelita = DataPelita::query()
        $datapelita = Groupvihara::join('branches','groupviharas.id','=','branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
         ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('groupviharas.*', 'branches.*', 'data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        ->orderBy($this->columnName, $this->direction)

        // ->where($this->category,'like','%'.trim($this->search).'%')
        ->when($this->category, function($query){
            if($this->category == 'Nama') {
                $query->where('data_pelitas.nama_umat','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.nama_alias','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.mandarin','like','%'.trim($this->search).'%');
            } elseif($this->category == 'All categories') {
                $query->where('data_pelitas.nama_umat','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.nama_alias','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.mandarin','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.pengajak','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.penjamin','like','%'.trim($this->search).'%')
                ->orWhere('panditas.nama_pandita','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.alamat','like','%'.trim($this->search).'%')
                ->orWhere('kotas.nama_kota','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.telp','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.hp','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.email','like','%'.trim($this->search).'%');

            }
            else {
                $query->where($this->category,'like','%'.trim($this->search).'%');
            }
        })
        ->when($this->group_id, function($query){
            $query->where('groupviharas.id',$this->group_id);
        })
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
        });
    }
    // yg ini
    elseif ($this->default == true && $this->search != ''){

        // $datapelita = DB::table('data_pelitas')
        // ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        // ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        // ->select('data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        // $datapelita = DataPelita::query()
        $datapelita = Groupvihara::join('branches','groupviharas.id','=','branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
         ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('groupviharas.*', 'branches.*', 'data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        ->orderBy($this->columnName, $this->direction)

        // ->where($this->category,'like','%'.trim($this->search).'%')
        ->when($this->category, function($query){
            if($this->category == 'Nama') {
                $query->where('data_pelitas.nama_umat','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.nama_alias','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.mandarin','like','%'.trim($this->search).'%');
            } elseif($this->category == 'All categories') {
                $query->where('data_pelitas.nama_umat','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.nama_alias','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.mandarin','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.pengajak','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.penjamin','like','%'.trim($this->search).'%')
                ->orWhere('panditas.nama_pandita','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.alamat','like','%'.trim($this->search).'%')
                ->orWhere('kotas.nama_kota','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.telp','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.hp','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.email','like','%'.trim($this->search).'%');

            }
            else {
                $query->where($this->category,'like','%'.trim($this->search).'%');
            }
        })
        ->when($this->group_id, function($query){
            $query->where('groupviharas.id',$this->group_id);
        })
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
        ;
    }
    else {


        $datapelita = Groupvihara::join('branches','groupviharas.id','=','branches.groupvihara_id')
        ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
         ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
        ->join('panditas', 'data_pelitas.pandita_id' , '=','panditas.id' )
        ->select('groupviharas.*', 'branches.*', 'data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
        ->orderBy($this->columnName, $this->direction)

        // ->where($this->category,'like','%'.trim($this->search).'%')
        ->when($this->category, function($query){
            if($this->category == 'Nama') {
                $query->where('data_pelitas.nama_umat','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.nama_alias','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.mandarin','like','%'.trim($this->search).'%');
            } elseif($this->category == 'All categories') {
                $query->where('data_pelitas.nama_umat','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.nama_alias','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.mandarin','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.pengajak','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.penjamin','like','%'.trim($this->search).'%')
                ->orWhere('panditas.nama_pandita','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.alamat','like','%'.trim($this->search).'%')
                ->orWhere('kotas.nama_kota','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.telp','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.hp','like','%'.trim($this->search).'%')
                ->orWhere('data_pelitas.email','like','%'.trim($this->search).'%');
            }
            else {
                $query->where($this->category,'like','%'.trim($this->search).'%');
            }
        })
        ->when($this->group_id, function($query){
            $query->where('groupviharas.id',$this->group_id);
        })
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
        });
    }

    $data_branch = Branch::find(Auth::user()->branch_id);
    $all_branch = Branch::orderBy('nama_branch', 'asc')->where('groupvihara_id', $this->group_id)->get();

    if($this->group_id != null){
        $dataGroup = GroupVihara::find($this->group_id);
        $namaft = $dataGroup->nama_group;
    }
    $namaft = 'Welcome';

    $dp = DataPelita::paginate(10);

    if($this->kode_branch != null) {
        $datacetya = Branch::find($this->kode_branch);
        $this->nama_cetya = $datacetya->nama_branch;
    } else {
        $datacetya = Branch::find(Auth::user()->branch_id);
        $this->nama_cetya = $datacetya->nama_branch;

    }
    if($this->kode_branch_view != NULL){
        $datacetya = Branch::find($this->kode_branch_view);
        $this->nama_cetya_view = $datacetya->nama_branch;
    }

     $this->selectedAll = $datapelita->pluck('id');
    $datapelita1 = $datapelita->paginate($this->perpage);
    $group = Groupvihara::all();
    $this->checkIsTambahKolom ();

        return view('livewire.tablewire', compact(['datapelita1', 'data_branch', 'all_branch', 'namaft', 'dp', 'group']))
        ->extends('layouts.main')
        ->section('content');
    }
}

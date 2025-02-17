<?php

namespace App\Http\Livewire;

use Auth;
use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Kota;
use Livewire\Request;
// use Barryvdh\DomPDF\PDF;
use App\Models\Branch;
// use Maatwebsite\Excel\Excel;
use App\Models\Absensi;
use App\Models\Pandita;
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
    public $columnName = 'data_pelitas.tgl_mohonTao', $direction = 'desc', $startUmur, $endUmur, $startDate, $endDate, $jen_kel;
    public $search = '';
    use WithPagination;
    public $branch_id;
    public $nama_umat, $nama_alias, $mandarin, $gender, $umur, $umur_sekarang;
    public $alamat, $kota, $telp, $hp, $email;
    public $pengajak, $penjamin, $pandita_id, $kota_id, $tgl_mohonTao, $tgl_mohonTao_lunar, $tgl_sd3h, $tgl_vtotal, $status, $status1, $tgl_sd3h1, $tgl_vtotal1;
    public $current_id, $delete_id;
    public $namaPandita, $namaKota, $last_update;
    public $category = "data_pelitas.nama_umat", $nama_kategori;
    public $kode_branch, $kode_branch_view, $kode_branch_khusus;
    public $nama_cetya, $nama_cetya_view, $pengajak_id, $penjamin_id, $tgl_lahir;
    public $default;
    public $selectedId = [];
    // default
    public $selectedAll = [];
    public $selectAll = false;
    protected $listeners = ['delete'];
    // protected $listeners = ['resetfilter'];
    public $group_id;
    public $dataview_nama_umat, $nomorid;

    public $isTambahKolom = 0, $kolomAlamat, $kolomKota, $kolomPandita, $kolomAlias, $kolomTelepon, $kolomHandphone, $kolomEmail = 0;
    public $kolomSd3h = 0, $kolomVTotal = 0, $kolomStatus = 0, $kolomKeterangan = 0;

    public function viewdata($id)
    {
        if ($id != null) {
            $dataview = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
                ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
                ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
                ->join('panditas', 'data_pelitas.pandita_id', '=', 'panditas.id')
                ->where('data_pelitas.id', $id)->first();
            // $this->id = $dataview->id;
            $this->nama_umat = $dataview->nama_umat;
            $this->nama_alias = $dataview->nama_alias;
            $this->mandarin = $dataview->mandarin;
            $this->gender = $dataview->gender;
            $this->alamat = $dataview->alamat;
            $this->kota_id = $dataview->kota_id;
            $this->telp = $dataview->telp;
            $this->hp = $dataview->hp;
            $this->email = $dataview->email;
            $this->pengajak = $dataview->pengajak;
            $this->penjamin = $dataview->penjamin;
            $this->pandita_id = $dataview->pandita_id;
            $this->tgl_mohonTao = date('d M Y', strtotime($dataview->tgl_mohonTao));
            $this->tgl_mohonTao_lunar = $dataview->tgl_mohonTao_lunar;
            if ($dataview->tgl_sd3h != null) {
                $this->tgl_sd3h1 = date('d M Y', strtotime($dataview->tgl_sd3h));
            } else {
                $this->tgl_sd3h1 = $dataview->tgl_sd3h;
            }
            if ($dataview->tgl_vtotal != null) {

                $this->tgl_vtotal1 = date('d M Y', strtotime($dataview->tgl_vtotal));
            } else {
                $this->tgl_vtotal1 = $dataview->tgl_vtotal;
            }
            $this->status1 = $dataview->status;
            $this->keterangan = $dataview->keterangan;
            $this->tgl_lahir =  date('d M Y', strtotime($dataview->tgl_lahir));
            $this->nomorid = $id;
            if ($dataview->updated_at != null) {
                $this->last_update = $dataview->updated_at->diffForHumans();
            }
            $this->umur_sekarang = hitungUmurSekarang($dataview->tgl_lahir) . ' Tahun / ' . $this->tgl_lahir;
        }
    }


    public function checkIsTambahKolom()
    {
        if (
            $this->kolomAlamat == 1 ||
            $this->kolomKota == 1 ||
            $this->kolomPandita == 1 ||
            $this->kolomAlias == 1 ||
            $this->kolomTelepon == 1 ||
            $this->kolomHandphone == 1 ||
            $this->kolomEmail == 1 ||
            $this->kolomSd3h == 1 ||
            $this->kolomVTotal == 1 ||
            $this->kolomStatus == 1 ||
            $this->kolomKeterangan == 1

        ) {
            $this->isTambahKolom = 1;
        } else {
            $this->isTambahKolom = 0;
        }
    }
    public function getCategory($nama_kategori)
    {


        $this->nama_kategori = $nama_kategori;


        switch ($nama_kategori) {
            case '中文名':
                $this->category = "data_pelitas.mandarin";
                break;
            case 'Alias':
                $this->category = "data_pelitas.nama_alias";
                break;
            case 'Nama':
                $this->category = "data_pelitas.nama_umat";
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

    public function mount()
    {
        $this->default = true;
        $this->nama_kategori = "Nama";
    }
    public function updating() {}

    public function updatedSelectAll()
    {
        if ($this->selectAll == true) {
            $this->selectedId = $this->selectedAll;
        } else {
            $this->selectedId = [];
        }
    }

    public function updatingKodeBranch()
    {
        // $this->group_id = "";
    }

    public function updatingGroupId()
    {
        $this->kode_branch = "";
    }


    public function excel()
    {
        return (new DataPelitaExport($this->selectedId))->download('Data_pelita.xlsx');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->perpage = 5;
        $this->search = '';
        $this->columnName = 'data_pelitas.tgl_mohonTao';
        $this->columnName = 'data_pelitas.tgl_mohonTao_lunar';
        $this->direction = 'desc';
        $this->startUmur = NULL;
        $this->endUmur = NULL;
        $this->startDate = NULL;
        $this->endDate = NULL;
        $this->jen_kel = NULL;
        $this->category = "data_pelitas.nama_umat";
        $this->status = "";
        $this->kode_branch = "";
        $this->branch_id = "";
        $this->group_id = "";
        $this->resetPage();
        $this->default = true;
        $this->selectedId = [];
        $this->selectedAll = [];
        $this->selectAll = false;
        $this->tgl_sd3h = false;
        $this->tgl_vtotal = false;


        $this->isTambahKolom = 0;
        $this->kolomAlamat = 0;
        $this->kolomKota = 0;
        $this->kolomPandita = 0;
        $this->kolomAlias = 0;
        $this->kolomTelepon = 0;
        $this->kolomHandphone = 0;
        $this->kolomEmail = 0;
        $this->kolomSd3h = 0;
        $this->kolomVTotal = 0;
        $this->kolomStatus = 0;
        $this->kolomKeterangan = 0;
        $this->nama_kategori = "Nama";
    }


    public function deleteConfirmation($id)
    {
        $canDelete = Absensi::where('datapelita_id', $id)->first();
        if (empty($canDelete)) {
            $data = DataPelita::find($id);
            $nama = $data->nama_umat;
            $this->dispatchBrowserEvent('delete_confirmation', [
                'title' => 'Yakin Untuk Hapus Data',
                //  'text' => "You won't be able to revert this!",
                'text' => "Data : " . $nama,
                'icon' => 'warning',
                'id' => $id,
            ]);
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Data ini Tidak Bisa Didelete']);
        }
    }

    public function delete($id)
    {
        $data = DataPelita::find($id);
        $data->delete();

        $this->dispatchBrowserEvent('deleted');
        // session()->flash('message', 'Data Sudah di Delete');
    }

    public function sortColumnName($namaKolom)
    {
        $this->columnName = $namaKolom;
        $this->direction = $this->swapDirection();
    }
    public function swapDirection()
    {
        return $this->direction === 'asc' ? 'desc' : 'asc';
    }


    public function updatedKodeBranch()
    {
        if ($this->kode_branch != '') {
            $this->default = false;
        } else {
            $this->default = true;
        }
    }

    public function render()
    {

        if (Auth::user()->role == '3') {
            // $this->branch_id = $this->kode_branch;
            $this->kode_branch_khusus = $this->kode_branch;
            $this->branch_id = $this->kode_branch;
        } else {
            $this->branch_id = $this->kode_branch;
            // $this->branch_id = Auth::user()->branch_id;
            // $this->kode_branch = Auth::user()->branch_id;
            $this->group_id = Auth::user()->groupvihara_id;
            $this->kode_branch_khusus = $this->kode_branch;
        }





        $datapelita = Groupvihara::join('branches', 'groupviharas.id', '=', 'branches.groupvihara_id')
            ->join('data_pelitas', 'branches.id', '=', 'data_pelitas.branch_id')
            ->join('kotas', 'data_pelitas.kota_id', '=', 'kotas.id')
            ->join('panditas', 'data_pelitas.pandita_id', '=', 'panditas.id')
            ->select('groupviharas.*', 'branches.*', 'data_pelitas.*', 'panditas.nama_pandita', 'kotas.nama_kota')
            ->orderBy($this->columnName, $this->direction)

            ->where($this->category, 'like', '%' . trim($this->search) . '%')

            ->when($this->group_id, function ($query) {
                $query->where('groupviharas.id', $this->group_id);
            })
            ->when($this->branch_id, function ($query) {
                $query->where('data_pelitas.branch_id', $this->branch_id);
            })
            ->when($this->startUmur, function ($query) {
                $query->whereYear('data_pelitas.tgl_lahir', '<=', hitungStartEndUmur($this->startUmur));
            })

            ->when($this->endUmur, function ($query) {
                $query->whereYear('data_pelitas.tgl_lahir', '>=', hitungStartEndUmur($this->endUmur));
            })
            ->when($this->startDate, function ($query) {
                $query->where('data_pelitas.tgl_mohonTao', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                $query->where('data_pelitas.tgl_mohonTao', '<=', $this->endDate);
            })
            ->when($this->jen_kel, function ($query) {
                $query->where('data_pelitas.gender',  $this->jen_kel);
            })
            ->when($this->status, function ($query) {
                $query->where('data_pelitas.status',  $this->status);
            })
            ->when($this->tgl_sd3h, function ($query) {
                $query->where('data_pelitas.tgl_sd3h', '!=', null);
            })
            ->when($this->tgl_vtotal, function ($query) {
                $query->where('data_pelitas.tgl_vtotal',  '!=', null);
            });


        $data_branch = Branch::find(Auth::user()->branch_id);
        $all_branch = Branch::orderBy('nama_branch', 'asc')->where('groupvihara_id', $this->group_id)->get();

        if ($this->group_id != null) {
            $dataGroup = GroupVihara::find($this->group_id);
            $namaft = $dataGroup->nama_group;
        }
        $namaft = 'Welcome';

        $dp = DataPelita::paginate(10);

        if ($this->kode_branch != null) {
            $datacetya = Branch::find($this->kode_branch);
            $this->nama_cetya = $datacetya->nama_branch;
        } else {
            $datacetya = Branch::find(Auth::user()->branch_id);
            $this->nama_cetya = $datacetya->nama_branch;
        }
        if ($this->kode_branch_view != NULL) {
            $datacetya = Branch::find($this->kode_branch_view);
            $this->nama_cetya_view = $datacetya->nama_branch;
        }

        $this->selectedAll = $datapelita->pluck('id');
        $datapelita1 = $datapelita->paginate($this->perpage);
        $group = Groupvihara::all();
        $this->checkIsTambahKolom();


        return view('livewire.tablewire', compact(['datapelita1', 'data_branch', 'all_branch', 'namaft', 'dp', 'group']))
            ->extends('layouts.main')
            ->section('content');
    }
}

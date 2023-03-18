<?php

namespace App\Exports;

use Carbon\Traits\Date;
// use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\DataPelita;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DataPelitaExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    // protected $selectedId;
    use Exportable;
    public function __construct($selectedId)
    {
        $this->selectedId = $selectedId;
    }

    public function map($datapelita): array
    {
        return [
            $datapelita->id,
            $datapelita->branch->nama_branch,
            $datapelita->nama_umat,
            $datapelita->mandarin,
            $datapelita->gender,
            $datapelita->umur_sekarang,
            $datapelita->alamat,
            $datapelita->kota->nama_kota,
            $datapelita->telp,
            $datapelita->hp,
            $datapelita->email,
            $datapelita->pengajak,
            $datapelita->penjamin,
            $datapelita->tgl_mohonTao,
            $datapelita->tgl_sd3h,
            $datapelita->tgl_vtotal,
            $datapelita->status,
            $datapelita->keterangan,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Cetya',
            'Nama',
            '中文名',
            'Gender',
            'Umur',
            'Alamat',
            'Kota',
            'Telepon',
            'Handphone',
            'Email',
            'Pengajak',
            'Penjamin',
            'Tanggal Mohon Tao',
            'Tgl SD3H',
            'Tanggal Veg. Total',
            'Status',
            'Keterangan',

        ];
    }

    // public function collection()
    // {
    //     return DataPelita::all();
    // }

    public function query () {
        return DataPelita::whereIn('id', $this->selectedId);
    }
}

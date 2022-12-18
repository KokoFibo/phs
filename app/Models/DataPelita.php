<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelita extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'mandarin',
        'jenis_kelamin',
        'umur',
        'umur_sekarang',
        'alamat',
        'kota',
        'telp',
        'hp',
        'email',
        'pengajak',
        'penjamin',
        'pandita',
        'tgl_mohonTao',
        'status',
        'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}

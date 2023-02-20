<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPelita extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_umat',
        'nama_alias',
        'mandarin',
        'gender',
        'tgl_lahir',
        'umur_sekarang',
        'alamat',
        'kota',
        'telp',
        'hp',
        'email',
        'pengajak_id',
        'pengajak',
        'penjamin_id',
        'penjamin',
        'pandita_id',
        'tgl_mohonTao',
        'status',
        'branch_id'
    ];

    public function getTgl_mohonTaoAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['tgl_mohonTao'])
       ->format('d, M Y H:i');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function pandita()
    {
        return $this->belongsTo(Pandita::class);
    }
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }


}

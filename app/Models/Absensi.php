<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function daftarkelas()
    {
        return $this->belongsTo(Daftarkelas::class);
    }

    public function datapelita () {
        return $this->belongsTo(DataPelita::class);
    }

}

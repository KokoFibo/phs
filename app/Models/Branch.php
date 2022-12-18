<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['kota_id', 'branch', 'kode_branch'];
    public function datapelita()
    {
        return $this->hasMany(DataPelita::class);
    }
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
}

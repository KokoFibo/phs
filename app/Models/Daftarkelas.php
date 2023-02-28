<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftarkelas extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function groupvihara()
    {
        return $this->belongsTo(Groupvihara::class);
    }
    public function absensi()
    {
        return $this->hasmany(Absensi::class);
    }

}

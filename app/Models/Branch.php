<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['groupvihara_id', 'nama_branch'];
    public function datapelita()
    {
        return $this->hasMany(DataPelita::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function daftarkelas()
    {
        return $this->hasMany(Daftarkelas::class);
    }

    public function groupvihara()
    {
        return $this->belongsTo(Groupvihara::class);
    }


}

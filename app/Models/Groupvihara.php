<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupvihara extends Model
{
    use HasFactory;
    protected $fillable = ['nama_group'];

    public function branch()
    {
        return $this->hasMany(Branch::class);
    }

    public function datapelita () {
        return $this->hasManyThrough(DataPelita::class, Branch::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}

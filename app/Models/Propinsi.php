<?php

namespace App\Models;

use App\Models\Namakota;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Propinsi extends Model
{
    use HasFactory;
    protected $table = 'propinsi';
    public function namakota() 
    {
        return $this->hasMany(Namakota::class);
    }
}


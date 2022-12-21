<?php

namespace App\Models;

use App\Models\Propinsi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Namakota extends Model
{
    use HasFactory;
    protected $table = 'namakota';
    public function propinsi() 
    {
        return $this->belongsTo(Propinsi::class);
    }
}


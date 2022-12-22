<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pandita extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];
    public function datapelita() 
    {
        return $this->hasMany(datapelita::class);
    }

}
                             
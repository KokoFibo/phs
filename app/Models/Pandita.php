<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pandita extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pandita'];
    public function datapelita()
    {
        return $this->hasMany(Datapelita::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }

}

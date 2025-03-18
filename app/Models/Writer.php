<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    //
    protected $fillable = [
        'nombre',
        'imagen',
        'nombre_completo',
        'pais',
        'nacimiento',
        'fallecimiento'
    ];
}

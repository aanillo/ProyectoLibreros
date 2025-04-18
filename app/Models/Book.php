<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'titulo',
        'imagen',
        'autor_id',
        'genero',
        'editorial',
        'fecha_publi',
        'descripcion',
        'valoracion',
        'precio'
    ];


    public function writer()
    {
        return $this->belongsTo(Writer::class, 'autor_id');
    }

}

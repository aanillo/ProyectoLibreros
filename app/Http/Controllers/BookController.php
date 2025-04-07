<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{

    public function mostrarVistaLibros()
    {
        $generos = [
            'Narrativa',
            'Historia',
            'Terror',
            'Comedia',
            'Filosofía',
            'Ciencia Ficción',
            'Novela',
            'Ensayo',
            'Poesía',
            'Cultura',
            'Fantasía',
            'Deporte',
            'Arte',
            'Psicología',
            'Biología'
        ];

        return view('bookMain', compact('generos'));
    }
}

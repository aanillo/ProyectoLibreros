<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    //
    public function mostrarVistaAutores(Request $request) {

        $autores = Writer::all();

        return view('writerMain', compact('autores'));
    }

    public function showWriter($id) {
        $writer = Writer::findOrFail($id);
        $booksWriter = $writer->books;
        return view('writerView', compact('writer', 'booksWriter'));
    }
}

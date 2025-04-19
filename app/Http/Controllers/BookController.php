<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function mostrarVistaLibros(Request $request)
{
    $generos = [
        'Narrativa', 'Historia', 'Terror', 'Comedia', 'Filosofía', 'Ciencia Ficción', 
        'Novela', 'Ensayo', 'Poesía', 'Cultura', 'Fantasía', 'Deporte', 'Arte', 
        'Psicología', 'Biografía'
    ];

    $generoSeleccionado = $request->get('genero');
    
    if ($generoSeleccionado) {
        $librosPorGenero = Book::where('genero', $generoSeleccionado)->get();
    } else {
        $librosPorGenero = Book::all();
    }

    return view('bookMain', compact('generos', 'librosPorGenero'));
}

/*
public function show($id) {
    $post = Post::findOrFail($id);
    $comments = Comment::where('post_id', $id)->orderByDesc('created_at')->get();

    return view('commentform', compact('post', 'comments'));
}
*/

public function showBook($id) {
    $book = Book::findOrFail($id);

    return view('bookView', compact('book'));
}


public function rate(Request $request, $id) {

    $request->validate([
        'valoracion' => 'required|integer|min:1|max:5',
    ]);

    $book = Book::findOrFail($id);

    Rating::updateOrCreate(
        ['user_id' => Auth::id(), 'book_id' => $book->id],
        ['valoracion' => $request->input('valoracion')]
    );

    $average = Rating::where('book_id', $book->id) -> avg('valoracion');
    $book->valoracion = $average;
    $book->save();

    return redirect()->route('show', $book->id)
                 ->with('success', 'Tu valoración se ha guardado correctamente.');

}
                 

}

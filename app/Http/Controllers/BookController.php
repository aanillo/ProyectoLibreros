<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use App\Models\Writer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

    public function mostrarVistaLibros(Request $request)
{
    $generos = [
        'Historia', 'Terror', 'Comedia', 'Filosofía', 'Ciencia Ficción', 
        'Novela', 'Ensayo', 'Poesía', 'Cultura', 'Fantasía', 'Deporte', 'Arte', 
        'Psicología', 'Biografía'
    ];

    $generoSeleccionado = $request->get('genero');
    
    if ($generoSeleccionado === 'Todos' || !$generoSeleccionado) {
        $librosPorGenero = Book::all();  
    } else {
        $librosPorGenero = Book::where('genero', $generoSeleccionado)->get();
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
      
public function indexBooks() 
    {
        $books = Book::all();
        return view('booksAdminView', compact('books'));
    }

    public function showInsert() {
        $writers = Writer::all();
        return view('insertBookView', compact('writers'));
    }

    public function doInsert(Request $request) {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'imagen' => 'required|url',
            'autor_id' => 'required|exists:writers,id',
            'genero' => 'required|string|max:100',
            'editorial' => 'required|string|max:100',
            'fecha_creacion' => 'required|digits:4|integer|min:1500|max:' . now()->year,
            'descripcion' => 'required',
            'precio' => 'required|numeric|min:0',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no debe superar los 255 caracteres.',
            
            'imagen.required' => 'La imagen es obligatoria.',
            'imagen.url' => 'La imagen debe ser una URL válida.',
            
            'autor_id.required' => 'El autor es obligatorio.',
            'autor_id.exists' => 'El autor seleccionado no existe.',
    
            'genero.required' => 'El género es obligatorio.',
            'genero.max' => 'El género no debe superar los 100 caracteres.',
    
            'editorial.required' => 'La editorial es obligatoria.',
            'editorial.max' => 'La editorial no debe superar los 100 caracteres.',
    
            'fecha_creacion.required' => 'La fecha de creación es obligatoria.',
            'fecha_creacion.digits' => 'La fecha debe ser un año válido de 4 dígitos.',
            'fecha_creacion.min' => 'El año debe ser posterior a 1500.',
            'fecha_creacion.max' => 'El año no puede ser mayor al actual.',
    
            'descripcion.required' => 'La descripción es obligatoria.',
    
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio no puede ser negativo.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $book = new Book();
        $book->titulo = $request->titulo;
        $book->imagen = $request->imagen;
        $book->autor_id = $request->autor_id;
        $book->genero = $request->genero;
        $book->editorial = $request->editorial;
        $book->fecha_creacion = $request->fecha_creacion;
        $book->descripcion = $request->descripcion;
        $book->valoracion = 0; 
        $book->precio = $request->precio;
        $book->save();
    
        return redirect()->route('admin.books')->with('success', 'Libro insertado correctamente.');
    }


    public function edit($id)
{
    $book = Book::findOrFail($id);
    $writers = Writer::all();
    return view('editBook', compact('book', 'writers'));  
}

    
public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'titulo' => 'required|string|max:255',
        'imagen' => 'required|url',
        'autor_id' => 'required|exists:writers,id',
        'genero' => 'required|string|max:50',
        'descripcion' => 'nullable',
        'editorial' => 'required|string|max:100',
        'fecha_creacion' => 'required|date_format:Y',  
        'valoracion' => 'nullable|integer|between:0,5',  
        'precio' => 'required|numeric|min:0'
    ], [
        'titulo.required' => 'El título es obligatorio.',
        'titulo.string' => 'El título debe ser una cadena de caracteres.',
        'titulo.max' => 'El título no debe exceder los 255 caracteres.',
        
        'imagen.required' => 'La imagen es obligatoria.',
        'imagen.url' => 'La imagen debe ser una URL válida.',
        
        'autor_id.required' => 'El autor es obligatorio.',
        'autor_id.exists' => 'El autor seleccionado no existe.',
        
        'genero.required' => 'El género es obligatorio.',
        'genero.string' => 'El género debe ser una cadena de caracteres.',
        'genero.max' => 'El género no debe exceder los 50 caracteres.',

        'editorial.required' => 'La editorial es obligatoria.',
        'editorial.string' => 'La editorial debe ser una cadena de caracteres.',
        'editorial.max' => 'La editorial no debe exceder los 100 caracteres.',
        
        'fecha_creacion.required' => 'La fecha de creación es obligatoria.',
        'fecha_creacion.date_format' => 'La fecha de creación debe tener el formato de año (YYYY).',
        
        'valoracion.integer' => 'La valoración debe ser un número entero.',
        'valoracion.between' => 'La valoración debe estar entre 0 y 5.',
        
        'precio.required' => 'El precio es obligatorio.',
        'precio.numeric' => 'El precio debe ser un número.',
        'precio.min' => 'El precio no puede ser negativo.'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $book = Book::findOrFail($id);
    $book->titulo = $request->titulo;
    $book->imagen = $request->imagen;
    $book->autor_id = $request->autor_id;
    $book->genero = $request->genero;
    $book->descripcion = $request->descripcion;
    $book->editorial = $request->editorial;
    $book->fecha_creacion = $request->fecha_creacion;  
    $book->valoracion = $request->input('valoracion', $book->valoracion ?? 0);  
    $book->precio = $request->precio;
    $book->save();

    return redirect()->route('admin.books')->with('success', 'Libro editado correctamente.');  
}


public function delete($id)
{
    $book = Book::findOrFail($id);
    
    $book->delete();

    return redirect()->route('admin.books')->with('success', 'Libro eliminado correctamente.');
}


}



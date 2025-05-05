<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request) {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'book_id' => 'required|exists:books,id', 
        ], [
            'comment.required' => 'El comentario es obligatorio.',
            'comment.string' => 'El comentario debe ser un texto válido.',
            'comment.max' => 'El comentario no puede tener más de 1000 caracteres.',
            'book_id.required' => 'El identificador del libro es obligatorio.',
            'book_id.exists' => 'El libro seleccionado no existe.',
        ]);
        
    
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->publish_date = now();
        $comment->book_id = $request->book_id;
        $comment->user_id = auth()->id(); 
        $comment->save();
    
        return redirect()->route('showBook', ['id' => $request->book_id]);
    }
    

    
    public function show($id) {
        $book = Book::findOrFail($id);
        $comments = Comment::where('book_id', $id)->orderByDesc('created_at')->get();
    
        return view('commentform', compact('book', 'comments'));
    }
    
}

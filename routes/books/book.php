<?php


use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'mostrarVistaLibros'])->name('books');
Route::get('/generos', [BookController::class, 'showGeneros'])->name('generos');
Route::get('/libros', [BookController::class, 'mostrarPorGenero'])->name('libros');
Route::get('/libro/{id}', [BookController::class, 'showBook'])->name('show');
Route::post('/books/{id}/rate', [BookController::class, 'rate'])->name('rateBook')->middleware('auth');

Route::middleware(['auth'])->group(function() {
    //Route::get('/', [BookController::class, 'mostrarVistaLibros'])->name('books');
    // Route::get('/generos', [BookController::class, 'showGeneros'])->name('generos');
    // Route::get('/insert', [BookController::class, 'create'])->name('posts.insert');
    // Route::post('/store', [BookController::class, 'store'])->name('posts.store');
    // Route::get('/show', [BookController::class, 'show'])->name('posts.show');
    // Route::delete('/{id}', [BookController::class, 'delete'])->name('posts.delete');
    // Route::put('/{id}/like', [BookController::class, 'likePost'])->name('posts.like');
});


/*
Route::get('/rutaNoProtegida', function() {
    return view('viewNoProtegida');
});*/

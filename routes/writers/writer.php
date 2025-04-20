<?php


use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WriterController::class, 'mostrarVistaAutores'])->name('writers');
Route::get('/autor/{id}', [WriterController::class, 'showWriter'])->name('show');
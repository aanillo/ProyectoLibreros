<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'indexLog'])->name('home')->middleware('auth');

Route::prefix('users')->group(base_path('routes/users/user.php'));
Route::prefix('books')->group(base_path('routes/books/book.php'));
Route::prefix('writers')->group(base_path('routes/writers/writer.php'));

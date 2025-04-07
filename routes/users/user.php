<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [UserController::class, 'showLogin'])->name('login.show');
Route::get('/register', [UserController::class, 'showRegister'])->name('register.show');
Route::post('/login', [UserController::class, 'doLogin'])->name('doLogin');
Route::post('/register', [UserController::class, 'doRegister'])->name('doRegister');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/deleteUser', [UserController::class, 'deleteUser'])->name('deleteUser');
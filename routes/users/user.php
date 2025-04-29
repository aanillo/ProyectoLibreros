<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [UserController::class, 'showLogin'])->name('login.show');
Route::get('/register', [UserController::class, 'showRegister'])->name('register.show');
Route::post('/login', [UserController::class, 'doLogin'])->name('doLogin');
Route::post('/register', [UserController::class, 'doRegister'])->name('doRegister');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/deleteUser', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::get('/logout/confirmar', [UserController::class, 'mostrarViewLogout'])->name('logout.confirm');

Route::get('/admin/users', [UserController::class, 'indexUsers'])->name('admin.users');

Route::get('/insert', [UserController::class, 'showInsert'])->name('insertUser');
Route::post('/store', [UserController::class, 'doInsert'])->name('doInsertUser');
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('editUsers');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('updateUsers');
Route::delete('/admin/users/{id}', [UserController::class, 'delete'])->name('deleteUsers');
Route::get('/profile/{id}', [UserController::class, 'showProfile'])->name('profile');
Route::get('/profile/{id}/edit', [UserController::class, 'editProfile'])->name('editProfile');
Route::put('/profile/{id}', [UserController::class, 'updateProfile'])->name('updateProfile');



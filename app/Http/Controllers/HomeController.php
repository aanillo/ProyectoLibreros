<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Writer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index() {
        $randomBooks = Book::all()->shuffle()->take(7);
        $randomWriters = Writer::all()->shuffle()->take(9);
        return view('home', compact('randomBooks', 'randomWriters'));
    }
    
    public function indexLog()
{
    $user = auth()->user();
    $randomBooks = Book::all()->shuffle()->take(7);
    $randomWriters = Writer::all()->shuffle()->take(9);
    return view('homeLog', compact('user', 'randomBooks', 'randomWriters'));
}


public function indexAdmin()
{
    $user = auth()->user();

    if (!$user || $user->rol !== 'admin') {
        abort(403, 'No tienes permiso para acceder a esta página.');
    }

    return view('adminHome', compact('user'));
}

}

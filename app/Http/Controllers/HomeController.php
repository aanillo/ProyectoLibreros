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
        $randomWriters = Writer::all()->shuffle()->take(4);
        return view('home', compact('randomBooks', 'randomWriters'));
    }
    
    public function indexLog()
{
    $user = auth()->user();
    $randomBooks = Book::all()->shuffle()->take(7);
    $randomWriters = Writer::all()->shuffle()->take(4);
    return view('homeLog', compact('user', 'randomBooks', 'randomWriters'));
}
}

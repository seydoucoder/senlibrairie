<?php

namespace App\Http\Controllers;

use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $livresPopulaires = Book::where('est_populaire', true)->take(3)->get();
        return view('welcome', compact('livresPopulaires'));
    }
}
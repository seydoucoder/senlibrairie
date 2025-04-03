<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLivres = Book::count() ?? 0;
        $livresPopulaires = Book::where('est_populaire', true)->count() ?? 0;
        $livresStock = Book::sum('quantite') ?? 0;
        $totalClients = User::where('role', 'client')->count() ?? 0;

        return view('dashboard.index', [
            'totalLivres' => $totalLivres,
            'livresPopulaires' => $livresPopulaires,
            'livresStock' => $livresStock,
            'totalClients' => $totalClients
        ]);
    }
}
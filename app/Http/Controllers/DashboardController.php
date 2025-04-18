<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLivres = Book::count() ?? 0;
        $livresPopulaires = Book::where('est_populaire', true)->count() ?? 0;
        $livresStock = Book::sum('quantite') ?? 0;
        $totalClients = User::where('role', 'client')->count() ?? 0;

        
        $commandesEnCours = Commande::whereDate('created_at', today())
            ->where('statut', 'En attente')
            ->count();

        $commandesValidees = Commande::whereDate('created_at', today())
            ->where('statut', 'Payée')
            ->count();

        $recettesJour = Paiement::whereDate('created_at', today())
            ->sum('montant');

       
        $commandesLabels = [];
        $commandesData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $commandesLabels[] = $month->format('F Y');
            $commandesData[] = Commande::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

    
        $categoriesData = DB::table('commande_livre')
            ->join('books', 'commande_livre.livre_id', '=', 'books.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->whereMonth('commande_livre.created_at', now()->month)
            ->groupBy('categories.name')
            ->select('categories.name', DB::raw('SUM(commande_livre.quantite) as total'))
            ->get();

        $categoriesLabels = $categoriesData->pluck('name');
        $categoriesData = $categoriesData->pluck('total');

        return view('dashboard.index', compact(
            'totalLivres',
            'livresPopulaires',
            'livresStock',
            'totalClients',
            'commandesEnCours',
            'commandesValidees',
            'recettesJour',
            'commandesLabels',
            'commandesData',
            'categoriesLabels',
            'categoriesData'
        ));
    }
}
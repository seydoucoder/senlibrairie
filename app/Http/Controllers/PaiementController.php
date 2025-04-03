<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with(['commande.client'])->orderBy('created_at', 'desc')->get();
        $commandes_non_payees = Commande::whereDoesntHave('paiement')
            ->with('client')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.paiements.index', compact('paiements', 'commandes_non_payees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'montant' => 'required|numeric|min:0',
            'datePaiement' => 'required|date',
            'modePaiement' => 'required|in:Espèces'
        ]);

        $commande = Commande::findOrFail($request->commande_id);
        
        if ($commande->paiement) {
            return back()->with('error', 'Cette commande a déjà été payée');
        }

        $paiement = Paiement::create([
            'commande_id' => $request->commande_id,
            'montant' => $request->montant,
            'datePaiement' => $request->datePaiement,
            'modePaiement' => $request->modePaiement
        ]);

        $commande->update(['statut' => 'Payée']);

        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès');
    }

    public function generateFacture(Paiement $paiement)
    {
        $paiement->load(['commande.livres', 'commande.client']);
        
        $pdf = \PDF::loadView('admin.paiements.facture', compact('paiement'));
        
        return $pdf->download('facture-' . $paiement->id . '.pdf');
    }
}
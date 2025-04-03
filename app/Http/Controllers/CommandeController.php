<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Commande;
use App\Models\Paiement;
use App\Notifications\OrderShippedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class CommandeController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Votre panier est vide');
        }

        try {
            DB::beginTransaction();

           
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['prix'] * $item['quantity'];
            }

            $commande = Commande::create([
                'dateCommande' => now(),
                'statut' => 'En attente',
                'montantTotal' => $total,
                'client_id' => auth()->id()
            ]);

            
            foreach ($cart as $id => $details) {
                $book = Book::find($id);
                if ($book->quantite < $details['quantity']) {
                    throw new \Exception('Stock insuffisant pour ' . $book->titre);
                }

                $commande->livres()->attach($id, [
                    'quantite' => $details['quantity'],
                    'prix_unitaire' => $details['prix']
                ]);

                $book->quantite -= $details['quantity'];
                $book->save();
            }

            DB::commit();
            session()->forget('cart');
            return redirect()->route('commandes.mes-commandes')->with('success', 'Votre commande a été enregistrée avec succès');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.show')->with('error', $e->getMessage());
        }
    }

    public function mesCommandes()
    {
        $commandes = Commande::where('client_id', auth()->id())
                            ->orderBy('created_at', 'desc')
                            ->with(['livres', 'paiement'])
                            ->get();
                            
        return view('commandes.mes-commandes', compact('commandes'));
    }

    public function index()
    {
        $commandes = Commande::with(['client', 'livres', 'paiement'])
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('admin.commandes.index', compact('commandes'));
    }

    public function show(Commande $commande)
    {
        $commande->load(['client', 'livres', 'paiement']);
        return view('admin.commandes.show', compact('commande'));
    }

    public function updateStatus(Request $request, Commande $commande)
    {
        $oldStatus = $commande->statut;
        $commande->update(['statut' => $request->statut]);
    
        if ($request->statut === 'Expédiée' && $oldStatus !== 'Expédiée') {
            $commande->client->notify(new OrderShippedNotification($commande));
        }

        return back()->with('success', 'Statut de la commande mis à jour');
    }

    public function destroy(Commande $commande)
    {
        
        foreach($commande->livres as $livre) {
            $livre->increment('quantite', $livre->pivot->quantite);
        }

        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande annulée avec succès');
    }
}
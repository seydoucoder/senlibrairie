@extends('layouts.gestionnaire')

@section('title', 'Détails de la Commande')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('commandes.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Retour aux commandes
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold mb-2">Commande #{{ $commande->id }}</h1>
                <p class="text-gray-600">Passée le {{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                <p class="text-gray-600">Client: {{ $commande->client->name }}</p>
            </div>
            <div>
                <form action="{{ route('commandes.update-status', $commande) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="statut" onchange="this.form.submit()" 
                        class="rounded-full px-4 py-2
                        @if($commande->statut == 'En attente') bg-yellow-100 text-yellow-800
                        @elseif($commande->statut == 'En préparation') bg-blue-100 text-blue-800
                        @elseif($commande->statut == 'Expédiée') bg-green-100 text-green-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        <option value="En attente" @selected($commande->statut == 'En attente')>En attente</option>
                        <option value="En préparation" @selected($commande->statut == 'En préparation')>En préparation</option>
                        <option value="Expédiée" @selected($commande->statut == 'Expédiée')>Expédiée</option>
                        <option value="Payée" @selected($commande->statut == 'Payée')>Payée</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="border-t border-b border-gray-200 py-4 my-4">
            <table class="w-full">
                <thead>
                    <tr class="text-left">
                        <th class="pb-2">Livre</th>
                        <th class="pb-2 text-center">Quantité</th>
                        <th class="pb-2 text-right">Prix unitaire</th>
                        <th class="pb-2 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commande->livres as $livre)
                        <tr>
                            <td class="py-2">{{ $livre->titre }}</td>
                            <td class="py-2 text-center">{{ $livre->pivot->quantite }}</td>
                            <td class="py-2 text-right">{{ number_format($livre->pivot->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                            <td class="py-2 text-right">{{ number_format($livre->pivot->prix_unitaire * $livre->pivot->quantite, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="pt-4 text-right font-bold">Total:</td>
                        <td class="pt-4 text-right font-bold">{{ number_format($commande->montantTotal, 0, ',', ' ') }} FCFA</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($commande->paiement)
            <div class="bg-green-50 p-4 rounded-lg">
                <h3 class="font-semibold text-green-800 mb-2">Informations de paiement</h3>
                <p class="text-green-700">Date: {{ $commande->paiement->datePaiement->format('d/m/Y à H:i') }}</p>
                <p class="text-green-700">Mode: {{ $commande->paiement->modePaiement }}</p>
                <p class="text-green-700">Montant: {{ number_format($commande->paiement->montant, 0, ',', ' ') }} FCFA</p>
            </div>
        @else
            <div class="bg-yellow-50 p-4 rounded-lg">
                <p class="text-yellow-700">Le paiement n'a pas encore été enregistré</p>
            </div>
        @endif
    </div>
</div>
@endsection
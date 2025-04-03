@extends('layouts.app')

@section('title', 'Mes Commandes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">Mes Commandes</h1>

    @if($commandes->count() > 0)
        <div class="space-y-6">
            @foreach($commandes as $commande)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-lg font-semibold">Commande #{{ $commande->id }}</h2>
                            <p class="text-gray-600">
                                Passée le {{ $commande->dateCommande->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="px-4 py-2 rounded-full text-sm 
                                @if($commande->statut == 'En attente') bg-yellow-100 text-yellow-800
                                @elseif($commande->statut == 'En préparation') bg-blue-100 text-blue-800
                                @elseif($commande->statut == 'Expédiée') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ $commande->statut }}
                            </span>
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
                        </table>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="text-gray-600">
                            @if($commande->paiement)
                                <div class="flex items-center gap-4">
                                    <p>Paiement: {{ $commande->paiement->modePaiement }}</p>
                                    <a href="{{ route('paiements.facture', $commande->paiement) }}" 
                                       class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700"
                                       target="_blank">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        Voir la facture
                                    </a>
                                </div>
                            @else
                                <p>Statut: {{ $commande->statut }}</p>
                            @endif
                        </div>
                        <div class="text-xl font-bold">
                            Total: {{ number_format($commande->montantTotal, 0, ',', ' ') }} FCFA
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-gray-600 mb-4">Vous n'avez pas encore passé de commande</p>
            <a href="{{ route('books.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">
                Parcourir les livres
            </a>
        </div>
    @endif
</div>
@endsection
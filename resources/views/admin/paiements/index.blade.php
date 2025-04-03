@extends('layouts.gestionnaire')

@section('title', 'Gestion des Paiements')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-6">Liste des paiements</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commande</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($paiements as $paiement)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $paiement->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">#{{ $paiement->commande_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $paiement->commande->client->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $paiement->modePaiement }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $paiement->datePaiement->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('paiements.facture', $paiement->id) }}" 
                                   class="text-blue-600 hover:text-blue-900"
                                   target="_blank">
                                    <i class="fas fa-file-invoice mr-1"></i> Facture
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
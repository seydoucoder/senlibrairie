@extends('layouts.gestionnaire')

@section('title', 'Gestion des Commandes')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">Gestion des Commandes</h1>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($commandes as $commande)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">#{{ $commande->id }}</td>
                    <td class="px-6 py-4">{{ $commande->client->name }}</td>
                    <td class="px-6 py-4">{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">{{ number_format($commande->montantTotal, 0, ',', ' ') }} FCFA</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('commandes.update-status', $commande) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <select name="statut" onchange="this.form.submit()" 
                                {{ $commande->statut == 'Payée' ? 'disabled' : '' }}
                                class="rounded-full text-sm px-3 py-1 
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
                            <input type="hidden" name="montant" value="{{ $commande->montantTotal }}">
                        </form>
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('commandes.show', $commande) }}" 
                            class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('commandes.destroy', $commande) }}" method="POST" 
                            onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
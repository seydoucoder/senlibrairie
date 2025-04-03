@extends('layouts.app')

@section('title', 'Mon Panier')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">Mon Panier</h1>

    @if(count($cart) > 0)
        <div class="bg-white rounded-lg shadow-md p-6">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-4">Produit</th>
                        <th class="text-center py-4">Quantité</th>
                        <th class="text-right py-4">Prix</th>
                        <th class="text-right py-4">Total</th>
                        <th class="text-right py-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $details)
                        <tr class="border-b">
                            <td class="py-4">
                                <div class="flex items-center">
                                    <img src="{{ asset($details['image']) }}" alt="{{ $details['titre'] }}" class="w-16 h-16 object-cover rounded">
                                    <span class="ml-4">{{ $details['titre'] }}</span>
                                </div>
                            </td>
                            <td class="text-center py-4">{{ $details['quantity'] }}</td>
                            <td class="text-right py-4">{{ number_format($details['prix'], 0, ',', ' ') }} FCFA</td>
                            <td class="text-right py-4">{{ number_format($details['prix'] * $details['quantity'], 0, ',', ' ') }} FCFA</td>
                            <td class="text-right py-4">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline">
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
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right py-4 font-bold">Total:</td>
                        <td class="text-right py-4 font-bold">{{ number_format($total, 0, ',', ' ') }} FCFA</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('books.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-full hover:bg-gray-600 mr-4">
                    Continuer les achats
                </a>
               
                <form action="{{ route('commande.store') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">
                        Passer la commande
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-gray-600 mb-4">Votre panier est vide</p>
            <a href="{{ route('books.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">
                Parcourir les livres
            </a>
        </div>
    @endif
</div>
@endsection
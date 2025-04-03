@extends('layouts.app')

@section('title', $book->titre)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <nav class="mb-8">
            <a href="{{ route('books.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>Retour aux livres
            </a>
        </nav>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:flex-shrink-0">
                    <img class="h-96 w-full object-cover md:w-96" src="{{ $book->image_url }}" alt="{{ $book->titre }}">
                </div>
                <div class="p-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-4">
                                <h1 class="text-3xl font-bold text-gray-900">{{ $book->titre }}</h1>
                                @if($book->est_nouveau)
                                    <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm">Nouveau</span>
                                @endif
                                @if($book->est_populaire)
                                    <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Populaire</span>
                                @endif
                            </div>
                            <p class="text-xl text-gray-600 mt-2">Par {{ $book->auteur }}</p>
                        </div>
                        <span class="text-2xl font-bold text-blue-600">{{ number_format($book->prix, 0, ',', ' ') }} FCFA</span>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">Description</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $book->description }}</p>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center space-x-6">
                            <span class="text-gray-700 flex items-center">
                                <i class="fas fa-box mr-2"></i> 
                                @if($book->quantite > 0)
                                    <span class="text-green-600">En stock ({{ $book->quantite }})</span>
                                @else
                                    <span class="text-red-600">Rupture de stock</span>
                                @endif
                            </span>
                            <span class="text-gray-700 flex items-center">
                                <i class="fas fa-tag mr-2"></i> 
                                {{ $book->category->name }}
                            </span>
                        </div>
                    </div>

                    @auth
                        @if($book->quantite > 0)
                            <div class="mt-8">
                                <form action="{{ route('cart.add', $book->id) }}" method="POST" class="flex items-center space-x-4">
                                    @csrf
                                    <div class="flex items-center">
                                        <label for="quantity" class="mr-3 text-gray-700">Quantité:</label>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" 
                                            max="{{ $book->quantite }}" 
                                            class="w-20 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>
                                    <button type="submit" 
                                        class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-shopping-cart mr-2"></i> Ajouter au panier
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <div class="mt-8">
                            <a href="{{ route('login') }}" 
                                class="bg-gray-600 text-white px-6 py-2 rounded-full hover:bg-gray-700 transition duration-300 inline-flex items-center">
                                <i class="fas fa-lock mr-2"></i> Se connecter pour commander
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
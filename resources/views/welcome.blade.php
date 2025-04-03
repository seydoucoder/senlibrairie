

@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
   
    <div class="bg-gradient-to-b from-blue-600 to-blue-800 text-white">
        <div class="container mx-auto px-4 py-20">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl font-bold mb-6 leading-tight">Découvrez l'univers des livres avec SenLibrairie</h1>
                <p class="text-xl mb-10 text-blue-100">Votre destination littéraire au Sénégal - Des milliers de livres à portée de clic</p>
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-8 py-3 text-lg font-medium rounded-full bg-white text-blue-600 hover:bg-gray-100 transition duration-300 shadow-lg hover:shadow-xl">
                    <span>Explorer notre collection</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    
    <div class="container mx-auto px-4 py-16">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Livres populaires</h2>
            <a href="{{ route('books.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
                Voir tout <i class="fas fa-chevron-right ml-2"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($livresPopulaires as $book)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                    <div class="relative">
                        <img src="{{ $book->image ?? asset('images/placeholder.jpg') }}" alt="{{ $book->titre }}" 
                            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                        @if($book->est_nouveau)
                            <div class="absolute top-2 right-2 bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
                                Nouveau
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-gray-800">{{ $book->titre }}</h3>
                        <p class="text-gray-600 mb-4">{{ $book->auteur }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-600">{{ number_format($book->prix, 0, ',', '.') }} FCFA</span>
                            @auth
                                <button class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300 flex items-center">
                                    <i class="fas fa-shopping-cart mr-2"></i> Ajouter
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="bg-gray-600 text-white px-6 py-2 rounded-full hover:bg-gray-700 transition duration-300 flex items-center">
                                    <i class="fas fa-lock mr-2"></i> Se connecter
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

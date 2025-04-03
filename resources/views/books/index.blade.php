@extends('layouts.app')

@section('title', 'Livres')

@section('content')
   
    <div class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row gap-6 justify-between items-center">
                <div class="w-full md:w-1/3 relative">
                    <form action="{{ route('books.index') }}" method="GET">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <i class="fas fa-search absolute left-4 top-3.5 text-gray-400"></i>
                        <input type="text" name="search" placeholder="Rechercher par titre ou auteur..." 
                            value="{{ request('search') }}"
                            class="w-full pl-12 pr-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </form>
                </div>
                <div class="flex flex-wrap gap-4">
                    <form action="{{ route('books.index') }}" method="GET">
                        <select name="category" onchange="this.form.submit()" class="px-6 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                    <div class="relative">
                       <a href="{{ route('books.show', $book->id) }}">
                       <img src="{{ $book->image ?? asset('images/placeholder.jpg') }}" alt="{{ $book->titre }}" 
                       class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                       </a>
                        @if($book->est_nouveau)
                            <div class="absolute top-2 right-2 bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
                                Nouveau
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1 text-gray-800 truncate">{{ $book->titre }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ $book->auteur }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-600">{{ number_format($book->prix, 0, ',', '.') }} FCFA</span>
                           
                            @auth
                                <form action="{{ route('cart.add', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-1.5 rounded-full hover:bg-blue-700 transition duration-300 flex items-center text-sm">
                                        <i class="fas fa-shopping-cart mr-1"></i> Ajouter
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="bg-gray-600 text-white px-4 py-1.5 rounded-full hover:bg-gray-700 transition duration-300 flex items-center text-sm">
                                    <i class="fas fa-lock mr-1"></i> Se connecter
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
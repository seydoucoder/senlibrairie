<nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <div class="text-2xl font-bold tracking-tight">📚 SenLibrairie</div>
            <div class="flex items-center space-x-6">
                <a href="/" class="hover:text-gray-200 font-medium">Accueil</a>
                <a href="{{ url('/books') }}" class="hover:text-gray-200 font-medium">Livres</a>
                
                @auth
                <a href="{{ route('cart.show') }}" class="relative">
                        <i class="fas fa-shopping-cart text-gray-200 text-xl"></i>
                        @if(session()->has('cart') && count(session()->get('cart')) > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                {{ count(session()->get('cart')) }}
                            </span>
                        @endif
                    </a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center hover:text-gray-200 font-medium">
                            <img src="{{ asset('images/utilisateur.png') }}" alt="Profile" class="w-8 h-8 rounded-full mr-2">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-2 text-sm"></i>
                        </button>
                        
                        <div x-show="open" 
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-10">
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Mon profil
                            </a>
                            <a href="{{ route('commandes.mes-commandes') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                <i class="fas fa-shopping-bag mr-2"></i> Mes commandes
                            </a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                <i class="fas fa-heart mr-2"></i> Favoris
                            </a>
                            <div class="border-t border-gray-100 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-200 font-medium">
                        <i class="fas fa-sign-in-alt mr-1"></i> Connexion
                    </a>
                    <a href="{{ route('register') }}" class="hover:text-gray-200 font-medium">
                        <i class="fas fa-user-plus mr-1"></i> Inscription
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
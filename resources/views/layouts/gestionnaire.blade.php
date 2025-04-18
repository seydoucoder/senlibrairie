<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SenLibrairie Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 h-screen bg-white shadow-lg fixed">
            <div class="p-4">
                <span class="text-xl font-bold text-blue-600">SenLibrairie</span>
            </div>
            <nav class="mt-4">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="mx-3">Tableau de bord</span>
                </a>
                <a href="{{ route('books.manage') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-book w-5"></i>
                    <span class="mx-3">Gérer les livres</span>
                </a>
                <a href="{{ route('commandes.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-shopping-bag w-5"></i>
                    <span class="mx-3">Gestion des commandes</span>
                </a>
                <a href="{{ route('paiements.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-money-bill-wave w-5"></i>
                    <span class="mx-3">Gestion des paiements</span>
                </a>
                <a href="{{ route('users.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-users w-5"></i>
                    <span class="mx-3">Utilisateurs</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top bar -->
            <div class="bg-white shadow-sm p-4">
                <div class="flex justify-end items-center">
                    <span class="text-gray-700 mr-4">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-red-600">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @yield('content')
            </div>
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>
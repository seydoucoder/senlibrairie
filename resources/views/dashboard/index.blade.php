@extends('layouts.gestionnaire')

@section('title', 'Tableau de bord')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Tableau de bord</h1>

       
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-600">Total Livres</h2>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalLivres) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-600">Livres Populaires</h2>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($livresPopulaires) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-box text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-600">Stock Total</h2>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($livresStock) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-sm font-medium text-gray-600">Total Clients</h2>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalClients) }}</p>
                    </div>
                </div>
            </div>
        </div>

    
       
    </div>
</div>
@endsection
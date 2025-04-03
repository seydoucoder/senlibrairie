<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PaiementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');




Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{book}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/commande', [CommandeController::class, 'store'])->name('commande.store');
    Route::get('/mes-commandes', [CommandeController::class, 'mesCommandes'])->name('commandes.mes-commandes');
});
// Dashboard 
Route::middleware(['auth', 'gestionnaire'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/books', [BookController::class, 'manage'])->name('books.manage');
    Route::get('/admin/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/admin/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/admin/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/admin/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/admin/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
    Route::put('/commandes/{commande}/status', [CommandeController::class, 'updateStatus'])->name('commandes.update-status');
    Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');
    Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
    Route::post('/paiements', [PaiementController::class, 'store'])->name('paiements.store');
    Route::get('/admin/paiements/{paiement}/facture', [PaiementController::class, 'generateFacture'])->name('paiements.facture');


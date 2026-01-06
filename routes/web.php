<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EntrepriseControleer;
use App\Http\Controllers\Inventaire\FournisseurController;
use App\Http\Controllers\Inventaire\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\StockMouvement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    $fournisseurs = Fournisseur::where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();
    $produits = Produit::with('fournisseur')->where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();
    return view('dashboard', compact('produits','fournisseurs'));
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ajout utilisateur par l'admin
    Route::get('/adduser', [ProfileController::class, 'addUser'])->name('profile.adduser');
    Route::post('/adduser', [ProfileController::class, 'store'])->name('profile.store');
});

Route::middleware(['auth', 'entreprise.exists'])->group(function () {
    Route::get('/dashboard', function () {
    $fournisseurs = Fournisseur::where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();
    $produits = Produit::with('fournisseur')->where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();

    $mouvements_ent = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'entree')->latest()->get();
    $mouvements_sor = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'sortie')->latest()->get();

    $clients = Client::where('entreprise_id', request()->user()->entreprise_id)->latest()->get();

    return view('dashboard.index', compact('produits','fournisseurs','mouvements_ent','mouvements_sor','clients'));        
})->name('dashboard');
});

// Route Entreprise
Route::middleware(['auth'])->group(function () {
    Route::get('entreprise/create', [EntrepriseControleer::class, 'create'])->name('entreprise.create');
    Route::post('entreprise/store', [EntrepriseControleer::class, 'store'])->name('entreprise.store');
});

// Route Inventaire
Route::middleware(['auth', 'entreprise.exists'])->group(function () { 
    // Fournisseurs
    Route::resource('fournisseurs', FournisseurController::class)->except(['show']);
    // Produits
    Route::resource('produits', ProduitController::class)->except(['show']);
    // Stock
    Route::post('/stock/entree', [StockController::class, 'entree'])->name('stock.entree');
    Route::post('/stock/sortie', [StockController::class, 'sortie'])->name('stock.sortie');
});

// Route Commercial
Route::middleware('auth', 'entreprise.exists')->group(function () {
    Route::resource('clients', ClientController::class);
});



















require __DIR__.'/auth.php';

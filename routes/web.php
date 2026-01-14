<?php

use App\Http\Controllers\Commercial\ClientController;
use App\Http\Controllers\Commercial\VenteController;
use App\Http\Controllers\EntrepriseControleer;
use App\Http\Controllers\Finance\DepenseController;
use App\Http\Controllers\Finance\RecetteController;
use App\Http\Controllers\Inventaire\FournisseurController;
use App\Http\Controllers\Inventaire\ProduitController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\StockMouvement;
use App\Models\Vente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view('home.index');
});

Route::get('new', function () {
    return view('home.register');
});

Route::get('user', function () {
    return view('home.login');
})->name('user');

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

// Route Dashboard
Route::middleware(['auth', 'entreprise.exists'])->group(function () {
    Route::get('/dashboard', function () {
        $fournisseurs = Fournisseur::where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();
        $produits = Produit::with('fournisseur')->where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();

        $mouvements_ent = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'entree')->limit(3)->latest()->get();
        $mouvements_sor = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'sortie')->limit(3)->latest()->get();

        $clients = Client::where('entreprise_id', request()->user()->entreprise_id)->latest()->get();
        $ventes = Vente::with('client')->where('entreprise_id', request()->user()->entreprise_id)->latest()->get();

        return view('dashboard.index', compact('produits','fournisseurs','mouvements_ent','mouvements_sor','clients','ventes'));        
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

    Route::get('/produits.search', [ProduitController::class, 'search'])->name('produits.search');

    // Mouvements
    Route::get('/mouvements', function () {
        $mouvements_ent = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'entree')->latest()->get();
        $mouvements_sor = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'sortie')->latest()->get();
        $produits = Produit::with('fournisseur')->where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();

        return view('inventaire.mouvements.index', compact('mouvements_ent','mouvements_sor','produits'));
    })->name('mouvements');
    // Stock
    Route::post('/stock/entree', [StockController::class, 'entree'])->name('stock.entree');
    Route::post('/stock/sortie', [StockController::class, 'sortie'])->name('stock.sortie');
});

// Route Commercial
Route::middleware('auth', 'entreprise.exists')->group(function () {
    Route::resource('clients', ClientController::class);
    Route::get('/clients.serach', [ClientController::class, 'search'])->name('clients.search');
    Route::post('/clients.ajax', [ClientController::class, 'storeAjax'])->name('clients.ajax.store');

    Route::resource('ventes', VenteController::class);
    Route::get('/ventes.search', [VenteController::class, 'search'])->name('ventes.search');

    Route::resource('paiements', PaiementController::class);
    Route::get('/paiements.search', [PaiementController::class, 'search'])->name('paiements.search');
    Route::put('/paiements/{id}/annuler', [PaiementController::class, 'annuler'])->name('paiements.annuler');


    // Facture
    Route::get('/ventes/{vente}/facture', [VenteController::class, 'facture'])->name('ventes.facture');
});


// Route Finance
Route::middleware(['auth', 'entreprise.exists'])->group(function () { 
    Route::resource('depenses', DepenseController::class);
    Route::resource('recettes', RecetteController::class);
});



















require __DIR__.'/auth.php';

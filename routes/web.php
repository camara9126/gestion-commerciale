<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\Commercial\ClientController;
use App\Http\Controllers\Commercial\VenteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntrepriseControleer;
use App\Http\Controllers\Finance\DepenseController;
use App\Http\Controllers\Finance\RecetteController;
use App\Http\Controllers\Inventaire\FournisseurController;
use App\Http\Controllers\Inventaire\ProduitController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\StockMouvement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('apropos', function () {
    return view('home.apropos');
})->name('apropos');

Route::get('contact', function () {
    return view('home.contact');
})->name('contact');

Route::get('politiques-conditions', function () {
    return view('home.politiquesEtConditions');
})->name('politiques');


Route::get('test', function () {
    $fournisseurs = Fournisseur::where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();
    $produits = Produit::with('fournisseur')->where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();
    return view('dashboard', compact('produits','fournisseurs'));
});

Route::get('rapport', function () {
    $fournisseurs = Fournisseur::where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();
    $produits = Produit::with('fournisseur')->where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();
    return view('rapport', compact('produits','fournisseurs'));
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/entreprise/{entreprise}', [ProfileController::class, 'entrepriseUpdate'])->name('entreprise.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ajout utilisateur par l'admin
    Route::get('/compte', [ProfileController::class, 'compte'])->name('user.compte');
    Route::get('/adduser', [ProfileController::class, 'addUser'])->name('user.adduser');
    Route::post('/adduser', [ProfileController::class, 'store'])->name('user.store');
    Route::delete('/adduser/delete/{user}', [ProfileController::class, 'destroy'])->name('user.destroy');
});


// Routes Abonnement et paiements PAYTECH
Route::middleware('auth')->group(function () {
    Route::get('/abonnement/payer', [AbonnementController::class, 'initialPaiement'])->name('abonnement.payer');

    Route::get('/abonnement/changer/{p}', [AbonnementController::class, 'changerPack'])->name('abonnement.changer');


    Route::get('/abonnement/success', [AbonnementController::class, 'success'])->name('abonnement.success');

    Route::get('/abonnement/cancel', [AbonnementController::class, 'cancel'])->name('abonnement.cancel');
});

// Route IPN et CHP doivent etre public (pas de auth)
 Route::post('/abonnement/ipn', [AbonnementController::class, 'ipn'])->name('abonnement.ipn');
 Route::post('/abonnement/chp', [AbonnementController::class, 'chp'])->name('abonnement.chp');

// Route Dashboard
Route::middleware(['auth', 'entreprise.exists'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard.rapport', [DashboardController::class, 'rapport'])->name('dashboard.rapport');
    Route::get('/dashboard/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
    Route::get('/abonnement', [DashboardController::class, 'abonnement'])->name('dashboard.abonnement');
});

// Route Super Administrateur (Webmaster)
Route::middleware(['auth'])->group(function () {
    Route::get('entreprise.index', [EntrepriseControleer::class, 'index'])->name('entreprise.index');
    Route::get('entreprise', [EntrepriseControleer::class, 'utilisateurs'])->name('entreprise.utilisateurs');
});

// Route Inventaire (fournisseurs - produits - stock - mouvements)
Route::middleware(['auth', 'entreprise.exists'])->group(function () { 
    // Fournisseurs
    Route::resource('fournisseurs', FournisseurController::class)->except(['show']);
    Route::post('/fournisseurs.ajax', [FournisseurController::class, 'storeAjax'])->name('fournisseurs.ajax.store');
    Route::get('/fournisseurs.search', [FournisseurController::class, 'search'])->name('fournisseurs.search');

    // Produits
    Route::resource('produits', ProduitController::class)->except(['show']);
    Route::get('/produits.search', [ProduitController::class, 'search'])->name('produits.search');

    // Mouvements
    Route::get('/mouvements', function () {
        $mouvements_ent = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'entree')->latest()->simplePaginate(10);
        $mouvements_sor = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'sortie')->latest()->simplePaginate(10);
        $produits = Produit::with('fournisseur')->where('entreprise_id', Auth::user()->entreprise_id)->latest()->get();

        return view('inventaire.mouvements.index', compact('mouvements_ent','mouvements_sor','produits'));
    })->name('mouvements');
    // Stock
    Route::post('/stock/entree', [StockController::class, 'entree'])->name('stock.entree');
    Route::post('/stock/sortie', [StockController::class, 'sortie'])->name('stock.sortie');
});

// Route Commercial (clients - ventes)
Route::middleware('auth', 'entreprise.exists')->group(function () {
    Route::resource('clients', ClientController::class);
    Route::get('/clients.serach', [ClientController::class, 'search'])->name('clients.search');
    Route::post('/clients.ajax', [ClientController::class, 'storeAjax'])->name('clients.ajax.store');

    Route::resource('ventes', VenteController::class);
    Route::get('/ventes.search', [VenteController::class, 'search'])->name('ventes.search');

    


    // Facture
    Route::get('/ventes/{vente}/facture', [VenteController::class, 'facture'])->name('ventes.facture');
});


// Route Finance (depenses - recettes - paiements)
Route::middleware(['auth', 'entreprise.exists'])->group(function () { 
    Route::resource('depenses', DepenseController::class);
    Route::get('/depenses.search', [DepenseController::class, 'search'])->name('depenses.search');

    Route::resource('recettes', RecetteController::class);
    Route::get('/recettes.search', [RecetteController::class, 'search'])->name('recettes.search');
    
    Route::resource('paiements', PaiementController::class);
    Route::get('/paiements.search', [PaiementController::class, 'search'])->name('paiements.search');
    Route::put('/paiements/{id}/annuler', [PaiementController::class, 'annuler'])->name('paiements.annuler');
});



















require __DIR__.'/auth.php';

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\StockMouvement;
use App\Models\User;
use App\Models\Vente;
use Illuminate\Http\Request;

class EntrepriseControleer extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entreprise = request()->user()->entreprise;

        $fournisseurs = Fournisseur::limit(3)->latest()->get();
        $produits = Produit::limit(3)->latest()->get();
        $mouvements_ent = StockMouvement::where('type', 'entree')->limit(3)->latest()->get();
        $mouvements_sor = StockMouvement::where('type', 'sortie')->limit(3)->latest()->get();

        $clients = Client::limit(3)->latest()->get();
        $ventes = Vente::limit(3)->latest()->get();

        return view('bmanager.index', compact('produits','fournisseurs','mouvements_ent','mouvements_sor','clients','ventes','entreprise')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function utilisateurs()
    {
        $users = User::where('entreprise_id', '!=', 2)->limit(10)->latest()->get();

        return view('bmanager.utilisateurs', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

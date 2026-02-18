<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\StockMouvement;
use App\Models\Support;
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

        $fournisseurs = Fournisseur::where('entreprise_id', '!=', 2)->limit(3)->latest()->get();
        $produits = Produit::where('entreprise_id', '!=', 2)->limit(3)->latest()->get();
        $entreprises = Entreprise::where('id', '!=', 2)->limit(3)->latest()->get();
        $users = User::where('id', '!=', 2)->limit(3)->latest()->get();

        return view('bmanager.index', compact('produits','fournisseurs','entreprises','users','entreprise')); 
    }

    public function search(Request $request)
    {
        $search = $request->query('search');

        // Recherche Liste Entreprise
        $entreprises = Entreprise::with('users')->when($search, function ($query, $search) {

                $query->where('nom', 'like', "%{$search}%");

        })->latest()->paginate(10)->withQueryString();

        // Recherche Liste Utilisateurs
        $users = User::with('entreprise')->where('entreprise_id', '!=', $request->user()->entreprise_id)->when($search, function ($query, $search) {

                $query->where('name', 'like', "%{$search}%");

        })->latest()->paginate(10)->withQueryString();


        // Recherche Liste  Fournisseurs
         $fournisseurs = Fournisseur::with('produit')->where('entreprise_id', '!=', $request->user()->entreprise_id)->when($search, function ($query, $search) {

                $query->where('nom', 'like', "%{$search}%");

        })->latest()->paginate(10)->withQueryString();


        // Recherche Liste Produits
        $produits = Produit::with('fournisseur')->where('entreprise_id', '!=', $request->user()->entreprise_id)->when($search, function ($query, $search) {

                $query->where('nom', 'like', "%{$search}%");

        })->latest()->paginate(10)->withQueryString();

         return view('bmanager.index', compact('users','fournisseurs','produits','search','entreprises')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function utilisateurs()
    {
        $users = User::where('id', '!=', 2)->latest()->simplePaginate(10);

        return view('bmanager.utilisateurs', compact('users'));
    }

    public function entreprise()
    {
        $entreprises = Entreprise::where('id', '!=', 2)->latest()->simplePaginate(10);

        return view('bmanager.entreprises', compact('entreprises'));
    }

    public function produits()
    {
        $produits = Produit::where('entreprise_id', '!=', 2)->latest()->simplePaginate(10);

        return view('bmanager.produits', compact('produits'));
    }

    public function fournisseurs()
    {
        $fournisseurs = Fournisseur::where('entreprise_id', '!=', 2)->latest()->simplePaginate(10);

        return view('bmanager.fournisseurs', compact('fournisseurs'));
    }

       public function support()
    {
        $supports = Support::latest()->simplePaginate(10);

        return view('bmanager.supports', compact('supports'));
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
    public function show(string $s)
    {
        $support= Support::findOrFail($s);
        
        return view('bmanager.show', compact('support'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $string)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Support $support)
    {
        $support= Support::findOrFail($support);

        $request->validate([
           'statut',
        ]);
dd($support);

        $support->update([
        'statut' => $request->statut,
        ]);

        return redirect()->back()->with('success', 'message traite avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

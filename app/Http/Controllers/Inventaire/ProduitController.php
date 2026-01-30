<?php

namespace App\Http\Controllers\Inventaire;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Fournisseur;
use App\Models\User;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(Request $request)
    {

        $produits = Produit::with('fournisseur')->where('entreprise_id', $request->user()->entreprise_id)->latest()->simplePaginate(10);

        return view('inventaire.produits.index', compact('produits'));
    }
    

    public function search(Request $request)
    {
        $search = $request->query('search');

        $produits = Produit::with('fournisseur')->where('entreprise_id', $request->user()->entreprise_id)->when($search, function ($query, $search) {

                $query->where('nom', 'like', "%{$search}%")->orWhereHas('fournisseur', function ($q) use ($search) {

                        $q->where('nom', 'like', "%{$search}%");
                });

        })->latest()->paginate(10)->withQueryString(); // 🔑 garde ?search=

        return view('inventaire.produits.index', compact('produits', 'search'));
    }


    public function create(Request $request, User $user)
    {

        // Verification limite produit du pack
        $user = request()->user();
        $pack = $user->entreprise->pack;

        if($user->entreprise->produit()->count() >= $pack->max_produit) {
            return redirect()->back()->with('warning', 'Limite du pack atteinte. Passez au pack supérieur.');

        };
              
        $fournisseurs = Fournisseur::where('entreprise_id', $request->user()->entreprise_id)->where('statut', true)->get();

        return view('inventaire.produits.create', compact('fournisseurs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'stock_min' => 'required|integer|min:0',
        ]);

        Produit::create([
            'entreprise_id' => $request->user()->entreprise_id,
            'fournisseur_id' => $request->fournisseur_id,
            'nom' => $request->nom,
            'code' => $this->generateCode($request->user()->entreprise_id),
            'prix_achat' => $request->prix_achat,
            'prix_vente' => $request->prix_vente,
            'stock_min' => $request->stock_min,
            'stock' => 0,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès, veuillez enregistrer un mouvement d"entree');
    }


    public function edit(Request $request, Produit $produit)
    {
        $this->authorizeEntreprise($produit, $request);

        $fournisseurs = Fournisseur::where('entreprise_id', $request->user()->entreprise_id)
            ->where('statut', true)
            ->get();

        return view('inventaire.produits.edit', compact('produit', 'fournisseurs'));
    }


    public function update(Request $request, Produit $produit)
    {
        $this->authorizeEntreprise($produit, $request);

        $request->validate([
            'nom' => 'required|string|max:255',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'stock_min' => 'required|integer|min:0',
        ]);

        $produit->update($request->only(
            'nom',
            'fournisseur_id',
            'prix_achat',
            'prix_vente',
            'stock_min'
        ));

        return redirect()->route('produits.index')->with('success', 'Produit modifié');
    }


    public function destroy(Request $request, Produit $produit)
    {
        $this->authorizeEntreprise($produit, $request);

        $produit->update(['statut' => false]);

        return redirect()->route('produits.index')
            ->with('success', 'Produit désactivé');
    }

    private function authorizeEntreprise(Produit $produit, Request $request)
    {
        if ($produit->entreprise_id !== $request->user()->entreprise_id) {
            abort(403);
        }
    }

    private function generateCode(int $entrepriseId): string
{
    $lastProduit = Produit::where('entreprise_id', $entrepriseId)->orderBy('id', 'desc')->first();

    $number = $lastProduit ? intval(substr($lastProduit->code, -5)) + 1 : 1;

    return 'PRD-' . str_pad($number, 5, '0', STR_PAD_LEFT);
}
}
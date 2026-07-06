<?php

namespace App\Http\Controllers\Inventaire;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Fournisseur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request, User $user)
    {
        $this->authorize('gerer-stock');

        // Verification limite produit du pack
        $user = request()->user();
        $produits = Produit::with('fournisseur')->where('entreprise_id', $request->user()->entreprise_id)->latest()->simplePaginate(10);
        $pack = $user->entreprise->pack;

        if($produits->count() >= $pack->max_produit) {
            return back()->with('warning', 'Limite du pack atteinte. Passez au pack supérieur.');

        };
              
        $fournisseurs = Fournisseur::where('entreprise_id', $request->user()->entreprise_id)->where('statut', true)->get();
        return view('inventaire.produits.index', compact('produits', 'fournisseurs'));
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
        $produits = Produit::with('fournisseur')->where('entreprise_id', $request->user()->entreprise_id)->get();
        $pack = $user->entreprise->pack;

        if($produits->count() >= $pack->max_produit) {
            return back()->with('warning', 'Limite du pack atteinte. Passez au pack supérieur.');

        };
              
        $fournisseurs = Fournisseur::where('entreprise_id', $request->user()->entreprise_id)->where('statut', true)->get();

        return view('inventaire.produits.create', compact('fournisseurs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'fournisseur_id' ,
            'prix_achat' ,
            'prix_vente' => 'required|numeric|min:0',
            'stock_min' => 'integer|min:0',
            'fournisseur' => 'string',
        ]);

        DB::beginTransaction();
    
        try {

                //Creation de fournisseur
                if($request->fournisseur) {
                    
                    $fournisseur= Fournisseur::create([
                        'nom' => $request->fournisseur,
                        'entreprise_id' => $request->user()->entreprise_id,
                    ]);
                };

                    
                Produit::create([
                    'entreprise_id' => $request->user()->entreprise_id,
                    'fournisseur_id' => $request->fournisseur_id ?? $fournisseur->id ?? null,
                    'nom' => $request->nom,
                    'code' => $this->generateCode($request->user()->entreprise_id),
                    'prix_achat' => $request->prix_achat ?? $request->prix_vente,
                    'prix_vente' => $request->prix_vente,
                    'stock_min' => $request->stock_min ?? 10,
                    'stock' => 0,
                ]);

                DB::commit();

                    return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès, veuillez enregistrer un mouvement d"entree');
            } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->back()->with('danger', 'Erreur lors de la conversion: ' . $e->getMessage());
                }
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
            'nom',
            'fournisseur_id',
            'prix_vente',
            'stock_min',
        ]);

        $produit->update($request->only(
            'nom',
            'fournisseur_id',
            'prix_vente',
            'stock_min'
        ));

        return redirect()->route('produits.index')->with('success', 'Produit modifié');
    }


    public function destroy(Request $request, Produit $produit)
    {
        $this->authorizeEntreprise($produit, $request);
        if($produit->statut == true) {
             $produit->update(['statut' => false]);

             return redirect()->route('produits.index')->with('success', 'Produit désactivé');
        } else
            $produit->update(['statut' => true]);

        return redirect()->route('produits.index')->with('success', 'Produit activé');
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

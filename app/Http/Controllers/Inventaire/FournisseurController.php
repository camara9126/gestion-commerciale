<?php

namespace App\Http\Controllers\Inventaire;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class FournisseurController extends Controller
{
     use AuthorizesRequests;

     
    public function index(Request $request)
    {

    $this->authorize('gerer-stock');

        $fournisseurs = Fournisseur::where('entreprise_id', $request->user()->entreprise_id)
            ->latest()
            ->get();

        return view('inventaire.fournisseurs.index', compact('fournisseurs'));
    }


    public function search(Request $request)
    {
        $search = $request->query('search');

        $fournisseurs = Fournisseur::with('produit')->where('entreprise_id', $request->user()->entreprise_id)->when($search, function ($query, $search) {

                $query->where('nom', 'like', "%{$search}%")->orWhereHas('produit', function ($q) use ($search) {

                        $q->where('telephone', 'like', "%{$search}%");
                });

        })->latest()->paginate(10)->withQueryString(); // 🔑 garde ?search=

        return view('inventaire.fournisseurs.index', compact('fournisseurs','search'));

    }


    public function create()
    {
        return view('inventaire.fournisseurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'adresse' => 'nullable|string',
        ]);

        Fournisseur::create([
            'entreprise_id' => $request->user()->entreprise_id,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('fournisseurs.index')
            ->with('success', 'Fournisseur ajouté avec succès');
    }


    public function storeAjax(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'adresse' => 'nullable|string',
        ]);

        Fournisseur::create([
            'entreprise_id' => $request->user()->entreprise_id,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('produits.create')->with('success', 'Fournisseur ajouté avec succès');
    }

    public function edit(Fournisseur $fournisseur)
    {
        $this->authorizeEntreprise($fournisseur);

        return view('inventaire.fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        $this->authorizeEntreprise($fournisseur);


        
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'adresse' => 'nullable|string',
            'statut' => 'nullable',
        ]);

        $fournisseur->update([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'statut' => $request->statut,
        ]);

        return redirect()->route('fournisseurs.index')
            ->with('success', 'Fournisseur modifié');
    }

    public function destroy(Fournisseur $fournisseur)
    {
        $this->authorizeEntreprise($fournisseur);

        $fournisseur->update(['statut' => false]);

        return redirect()->route('fournisseurs.index')
            ->with('success', 'Fournisseur désactivé');
    }


    private function authorizeEntreprise(Fournisseur $fournisseur)
    {
        $user= request()->user();
        if ($fournisseur->entreprise_id !== $user->entreprise_id) {
            abort(403);
        }
    }
}

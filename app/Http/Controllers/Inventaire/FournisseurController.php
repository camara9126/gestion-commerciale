<?php

namespace App\Http\Controllers\Inventaire;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index(Request $request)
    {
        $fournisseurs = Fournisseur::where('entreprise_id', $request->user()->entreprise_id)
            ->latest()
            ->get();

        return view('inventaire.fournisseurs.index', compact('fournisseurs'));
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
        ]);

        $fournisseur->update($request->only(
            'nom',
            'telephone',
            'email',
            'adresse'
        ));

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

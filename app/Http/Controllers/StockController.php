<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\StockMouvement;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // Entrer Mouvement
    public function entree(Request $request)
{
    $request->validate([
        'produit_id' => 'required|exists:produits,id',
        'quantite' => 'required|integer|min:1',
    ]);

    $produit = Produit::findOrFail($request->produit_id);

    StockMouvement::create([
        'entreprise_id' => $request->user()->entreprise_id,
        'produit_id' => $produit->id,
        'type' => 'entree',
        'quantite' => $request->quantite,
        'reference' => 'ENT-' . now()->timestamp,
        'user_id' => $request->user()->id,
    ]);

    $produit->increment('stock', $request->quantite);

    return back()->with('success', 'Entrée de stock enregistrée');
}

// Sortie Mouvement
public function sortie(Request $request)
{
    $request->validate([
        'produit_id' => 'required|exists:produits,id',
        'quantite' => 'required|integer|min:1',
    ]);

    $produit = Produit::findOrFail($request->produit_id);

    if ($produit->stock < $request->quantite) {
        return back()->withErrors('Stock insuffisant');
    }

    StockMouvement::create([
        'entreprise_id' => $request->user()->entreprise_id,
        'produit_id' => $produit->id,
        'type' => 'sortie',
        'quantite' => $request->quantite,
        'reference' => 'SRT-' . now()->timestamp,
        'user_id' => $request->user()->id,
    ]);

    $produit->decrement('stock', $request->quantite);

    return back()->with('success', 'Sortie de stock enregistrée');
}


}

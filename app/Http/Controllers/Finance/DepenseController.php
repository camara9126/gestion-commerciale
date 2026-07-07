<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\CategorieDepense;
use App\Models\Depense;
use Illuminate\Http\Request;

class DepenseController extends Controller
{

    public function index(Request $request)
    {

        $depenses = Depense::with('categorie')->where( 'entreprise_id', request()->user()->entreprise_id)->latest()->paginate(10);
        $categories = CategorieDepense::all();

        return view('finance.depenses.index', compact('depenses','categories'));
    }


     public function search(Request $request)
    {
        $categories = CategorieDepense::all();
        $search = $request->query('search');

        $depenses = Depense::with('categorie')->where('entreprise_id', $request->user()->entreprise_id)->when($search, function ($query, $search) {

                $query->where('reference', 'like', "%{$search}%")->orWhereHas('categorie', function ($q) use ($search) {

                        $q->where('nom', 'like', "%{$search}%");
                });
;

        })->latest()->paginate(10)->withQueryString(); // 🔑 garde ?search=;

        return view('finance.depenses.index', compact('categories','depenses', 'search'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'montant' => 'required|numeric|min:0',
            'date_depense' => 'required|date',
            'mode_paiement' => 'required'
        ]);

        Depense::create([
            'entreprise_id' => $request->user()->entreprise_id,
            'user_id' => $request->user()->id,
            'reference' => 'DEP-' . now()->timestamp,
            'libelle' => $request->libelle,
            'description' => $request->description,
            'montant' => $request->montant,
            'date_depense' => $request->date_depense,
            'categorie_depense_id' => $request->categorie_depense_id,
            'mode_paiement' => $request->mode_paiement,
        ]);

        return redirect()->back()->with('success', 'Dépense enregistrée avec succès');
    }


    public function annuler($id)
    {
        $depense = Depense::findOrFail($id);
        $depense->update(['statut' => 'annulee']);

        return back()->with('success', 'Dépense annulée avec succès');
    }
}

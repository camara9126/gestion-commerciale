<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;

class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entreprise = request()->user()->entreprise;
        $pack = $entreprise->pack;

        return view('dashboard.abonnement', compact('entreprise','pack'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $entreprise = request()->user()->entreprise;
        $pack = $entreprise->pack;

        //Desactiver l'ancien abonnement
        Abonnement::where('entreprise_id', $entreprise->id)->where('statut', 'actif')->update(['statut' => 'expire']);

        // Nouvel abonnement
        Abonnement::create([
            'entreprise_id'=> $entreprise->id,
            'pack_id' => $pack->id,
            'montant' => $pack->prix,
            'date_debut' => now(),
            'date_fin' => now()->addMonth(),
            'statut' => 'actif',
        ]);

        // Mettre a jour l'entreprise
        $entreprise->update([
            'abonnement_expire_le' => now()->addMonth(),
        ]);

        return back()->with('success', 'Abonnement active avec succes');
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
    public function update(Request $request, string $id)
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

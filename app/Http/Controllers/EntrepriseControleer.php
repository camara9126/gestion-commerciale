<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseControleer extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entreprise.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'telephone' => 'nullable|string|max:50',
            'adresse' => 'nullable|string',
        ]);

        $entreprise= Entreprise::create([
            'nom' =>$request->nom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'devise' => 'XOF',
        ]);
        // Lier l'utilisateur a l'entreprise
        $user= $request->user();
        $user->entreprise_id = $entreprise->id;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Entreprise cree avec success');
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

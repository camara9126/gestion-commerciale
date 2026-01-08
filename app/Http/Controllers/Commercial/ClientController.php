<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::where( 'entreprise_id', request()->user()->entreprise_id)->get();

        return view('commercial.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('commercial.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'adresse' => 'nullable|string',
        ]);

        Client::create([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'entreprise_id' => $request->user()->entreprise_id,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client ajouté');
    }


    public function edit(Client $client)
    {
        $this->authorizeEntreprise($client);

        return view('commercial.clients.edit', compact('client'));
    }
    

    public function update(Request $request, Client $client)
    {
        $this->authorizeEntreprise($client);

        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'adresse' => 'nullable|string',
        ]);

        $client->update($request->only(
            'nom',
            'telephone',
            'email',
            'adresse'
        ));

        return redirect()->route('clients.index')
            ->with('success', 'Client modifié');

    }

     private function authorizeEntreprise(Client $client)
    {
        $user= request()->user();
        if ($client->entreprise_id !== $user->entreprise_id) {
            abort(403);
        }
    }
}

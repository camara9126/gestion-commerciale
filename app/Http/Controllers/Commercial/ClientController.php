<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search');

        $clients = Client::where( 'entreprise_id', request()->user()->entreprise_id)->when($search, function ($query, $search) {

                $query->where('nom', 'like', "%{$search}%");

        })->latest()->paginate(10)->withQueryString(); // 🔑 garde ?search=;

        return view('commercial.clients.index', compact('clients','search'));
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

    public function storeAjax(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $client = Client::create([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'entreprise_id' => $request->user()->entreprise_id,
        ]);

        return redirect()->back()->with('success', 'Nouveau client ajouté');
    }


     private function authorizeEntreprise(Client $client)
    {
        $user= request()->user();
        if ($client->entreprise_id !== $user->entreprise_id) {
            abort(403);
        }
    }
}

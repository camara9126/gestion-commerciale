<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Paiements;
use App\Models\Produit;
use App\Models\Vente;
use App\Models\VenteItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use function Symfony\Component\Clock\now;

class VenteController extends Controller
{

   use AuthorizesRequests;


    public function index(Request $request)
    {
        $this->authorize('gerer-ventes');


        $ventes = Vente::with('client')->where('entreprise_id', $request->user()->entreprise_id)->latest()->simplePaginate(5); 

        return view('commercial.ventes.index', compact('ventes'));
    }

    public function search(Request $request)
    {
        $search = $request->query('search');

        $ventes = Vente::with('client')->where('entreprise_id', $request->user()->entreprise_id)->when($search, function ($query, $search) {

                $query->where('reference', 'like', "%{$search}%")->orWhereHas('client', function ($q) use ($search) {

                        $q->where('nom', 'like', "%{$search}%");
                });

        })->latest()->paginate(10)->withQueryString(); // 🔑 garde ?search=

        return view('commercial.ventes.index', compact('ventes', 'search'));
    }
    
    // Recherche caisse
    public function caisseSearch(Request $request)
    {
        $query = $request->q;

        $produits = Produit::where('nom', 'LIKE', "%{$query}%")->limit(50)->get();

        return response()->json($produits);
    }

    public function create()
    {
        $clients = Client::where('entreprise_id', request()->user()->entreprise_id)->latest()->get();
        $entreprise= request()->user()->entreprise;
        $produits = Produit::where( 'entreprise_id', request()->user()->entreprise_id)->where('statut', true)->latest()->get();

        return view('commercial.ventes.create', compact('clients', 'produits', 'entreprise'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'client_id',
            'produits' => 'required|array|min:1',
            'statut',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.prix_vente' => 'required|numeric|min:1',
            'produits.*.quantite' => 'required|numeric|min:1',
            'newClient',
        ]);

        
         if (!$request->newClient && !$request->client_id) {
                return redirect()->back()->with('danger','Veuillez selectionner ou saisir un client');
            }
        //Creation nouveau client
        if($request->newClient) {
            
            $client= Client::create([
                'nom' => $request->newClient,
                'entreprise_id' => $request->user()->entreprise_id,
            ]);
        };

        //dd($request->all());
            $vente = Vente::create([
                'client_id' => $request->client_id ?? $client->id,
                'entreprise_id' => $request->user()->entreprise_id,
                'reference' => 'VNT-' . time(),
                'date' => now(),
                'total' => 0,
                'total_tva' => 0,
                'total_ttc' => 0,
                'statut' => 'impayee',
                'user_id' => $request->user()->id,
            ]);

            $total = 0;
            $total_tva = 0;
            $total_ttc = 0;


        foreach ($request->produits as $item) {

            //dd($item);
             if (empty($item['produit_id'])) {
                continue;
            }

            $produit = Produit::where('id', $item['produit_id'])->where('entreprise_id', $request->user()->entreprise_id)->lockForUpdate()
                                ->first(); // verrou stock

            // Verification stock mouvement
            if ($produit->stock == 0) {

                 return redirect()->back()->with('danger','Vous devez enregister un mouvement d"abord');
            }

            // Alert stock minimum depasse
            if ($produit->stock <= $produit->stock_min) {
                return redirect()->back()->with('danger','Votre stock minimum est depasse');
            }


            // Verification quantite de stock
            if ($produit->stock < $item['quantite']) {
                
                return redirect()->back()->with('danger','Stock insuffisant pour le produit ');
            }


            // Creation vente item
            $entreprise= $request->user()->entreprise; // Recuperation de la TVA de l'entreprise

            VenteItem::create([
                'vente_id' => $vente->id,
                'entreprise_id' => $request->user()->entreprise_id,
                'produit_id' => $item['produit_id'],
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix_vente'],
                'taux_tva' => $entreprise->taux_tva,
                'montant_tva' => ($item['quantite'] * $item['quantite']) * ($entreprise->taux_tva /100 ),
                'total_ttc' => ($item['quantite'] * $item['quantite']) + (($item['quantite'] * $item['quantite']) * ($entreprise->taux_tva /100 )),
                'total' => $item['quantite'] * $item['quantite'],
            ]);

            // Mise a jour stock
            $produit->decrement('stock', $item['quantite']);

            // Calcule total + total_tva + total_ttc
            $total += $item['quantite'] * $produit->prix_vente;
            $total_tva += ($item['quantite'] * $produit->prix_vente) * ($entreprise->taux_tva /100 );
            $total_ttc += ($item['quantite'] * $produit->prix_vente) + (($item['quantite'] * $produit->prix_vente) * ($entreprise->taux_tva /100 ));
            
            // Mise a jour total + total_tva + total_ttc
            $vente->update([
                'total' => $total,
                'total_tva' => $total_tva,
                'total_ttc' => $total_ttc,
            ]);

    }

        return redirect()->route('ventes.index')->with('success','Vente effectue avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vente= Vente::findOrFail($id);
        $paiement= Paiements::where('vente_id', $vente->id)->get();
        //dd($paiement);
         $vente->destroy($id);

        $paiement->update([
            'statut' => 'annule',
            'motif' => 'Annulation manuelle',
            'annule_par' => request()->user()->id,
            'annule_le' => now(),
        ]);

        return redirect()->route('ventes.index')->with('success', ' vente supprimé avec succès');        

    }


    public function show(Vente $vente)
    {
        if($vente->entreprise_id !== request()->user()->entreprise_id) {
            abort(403);
        }

        $vente->load(['client', 'items.produit', 'entreprise']);

        $pdf = Pdf::loadView('commercial.ventes.show', compact('vente'));

        return $pdf->stream('Facture-' . $vente->reference . '.pdf');
    }


    // Facture
    public function facture(Vente $vente)
    {
        // Sécurité multi-entreprise
        if ($vente->entreprise_id !== request()->user()->entreprise_id) {
            abort(403);
        }

        $vente->load(['client', 'items.produit', 'entreprise']);

        $pdf = Pdf::loadView('commercial.ventes.facture', compact('vente'));

        return $pdf->download('Facture-' . $vente->reference . '.pdf');
    }
}


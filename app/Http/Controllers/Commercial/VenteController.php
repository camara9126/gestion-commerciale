<?php

namespace App\Http\Controllers\Commercial;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Vente;
use App\Models\VenteItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use function Symfony\Component\Clock\now;

class VenteController extends Controller
{

    public function index()
    {
        $ventes = Vente::with('client')->where('entreprise_id', request()->user()->entreprise_id)->latest()->get();

        return view('commercial.ventes.index', compact('ventes'));
    }
    


    public function create()
    {
        $clients = Client::where('entreprise_id', request()->user()->entreprise_id)->get();

        $produits = Produit::where( 'entreprise_id', request()->user()->entreprise_id)->get();

        return view('commercial.ventes.create', compact('clients', 'produits'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'produits' => 'required|array|min:1',
            'statut',
            'tva',
            'produits.*.tva' => 'required',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|numeric|min:1',
            'produits.*.prix' => 'required|numeric|min:0',
        ]);

        // Verification mouvement stock
        foreach ($request->produits as $item) {

            //dd($item);
             if (empty($item['produit_id'])) {
                continue;
            }

            $produit = Produit::where('id', $item['produit_id'])->where('entreprise_id', $request->user()->entreprise_id)->lockForUpdate()
                                ->firstOrFail(); // verrou stock

            // Verification stock mouvement
            if ($produit->stock == 0) {

                 return redirect()->back()->with('danger','Vous devez enregister un mouvement d"abord');
            }


            // Verification quantite de stock
            if ($produit->stock < $item['quantite']) {
                
                return redirect()->back()->with('danger','Stock insuffisant pour le produit : {$produit->nom}');
            }

            //dd($request->all());
            $vente = Vente::create([
                'client_id' => $request->client_id,
                'entreprise_id' => $request->user()->entreprise_id,
                'reference' => 'VNT-' . time(),
                'date' => now(),
                'total' => 0,
                'total_tva' => 0,
                'total_ttc' => 0,
                'statut' => $request->statut,
                'user_id' => $request->user()->id,
            ]);

            $total = 0;
            $total_tva = 0;
            $total_ttc = 0;


            // Creation vente item
            VenteItem::create([
                'vente_id' => $vente->id,
                'produit_id' => $item['produit_id'],
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix'],
                'taux_tva' => $item['tva'],
                'montant_tva' => ($item['quantite'] * $item['prix']) * (18 /100 ),
                'total_ttc' => ($item['quantite'] * $item['prix']) + (($item['quantite'] * $item['prix']) * (18 /100 )),
                'total' => $item['quantite'] * $item['prix'],
            ]);

            // Mise a jour stock
            $produit->decrement('stock', $item['quantite']);

            // Calcule total + total_tva + total_ttc
            $total += $item['quantite'] * $item['prix'];
            $total_tva += ($item['quantite'] * $item['prix']) * (18 /100 );
            $total_ttc += ($item['quantite'] * $item['prix']) + (($item['quantite'] * $item['prix']) * (18 /100 ));
            
            // Mise a jour total + total_tva + total_ttc
            $vente->update(['total' => $total]);
            $vente->update(['total_tva' => $total_tva]);
            $vente->update(['total_ttc' => $total_ttc]);

    }

        

        return redirect()->route('ventes.index')->with('success','Vente effectue');
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

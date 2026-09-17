<?php

namespace App\Http\Controllers\Inventaire;

use App\Http\Controllers\Controller;
use App\Models\Achat;
use App\Models\Entreprise;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\AchatDetail;
use App\Models\Depense;
use App\Models\StockMouvement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $achats = Achat::where('entreprise_id', request()->user()->entreprise_id)->with('fournisseur')->latest()->paginate(30);

        return view('inventaire.achats.index', compact('achats'));
    }

    /**
     * recherche des achats
     */
    public function search(Request $request)
    {
        $search = $request->query('search');
        $achats = Achat::where('entreprise_id', request()->user()->entreprise_id)->with('fournisseur')->when($search, function ($query, $search) {
                $query->where('reference', 'like', "%{$search}%")->orWhereHas('fournisseur', function ($q) use ($search) {
                        $q->where('nom', 'like', "%{$search}%");
                    });
            })->latest()->paginate(30)->withQueryString(); // 🔑 garde ?search=

        return view('inventaire.achats.index', compact('achats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entreprise= Entreprise::Where('id', request()->user()->entreprise_id)->first(); 

        $fournisseurs = Fournisseur::where('entreprise_id', request()->user()->entreprise_id)->latest()->get();
    
        $produits = Produit::where('entreprise_id', request()->user()->entreprise_id)->latest()->get();

        return view('inventaire.achats.create', compact('fournisseurs','produits','entreprise'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'fournisseur_id' => 'exists:fournisseurs,id',
            'designation' => 'array|min:1',
            'designation.*.nom',
            'designation.*.prix',
            'designation.*.quantite',
            'produits' => 'array',
            'produits.*.nom' ,
            'produits.*.quantite' => 'numeric|min:1',
            'produits.*.prix_achat' => 'numeric|min:0',
            'facture' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'note' => 'nullable',
        ]);

         DB::beginTransaction();
        // dd($request);
        try {

            if ($request->hasFile('facture')) {
                $facture = $request->file('facture')->store('factures-achats', 'public');
            }

            // Création du bon de commande
            $achat = Achat::create([
                'entreprise_id' => request()->user()->entreprise_id,
                'reference' => 'FAC-ACT-' . strtoupper(Str::random(6)),
                'fournisseur_id' => $request->fournisseur_id,
                'total' => 0,
                'note' => $request->note ?? 'null',
                'statut' => 'recu',
                'facture' => $facture ?? null,
            ]);

            $total = 0;


            // Enregistrement du nouveau produit_intrant (designation) dans le AchatDetails
            if(!empty($request->designation)) { // Nouvelle produit

                foreach ($request->designation as $item) {
                    
                    // Récupération de l'entreprise
                    $entreprise= entreprise::Where('id', request()->user()->entreprise_id)->first(); 

                    $ligneTotal = $item['quantite'] * $item['prix'];

                    AchatDetail::create([
                        'entreprise_id' => $entreprise->id,
                        'achat_id' => $achat->id,
                        'produit_id' => null,
                        'designation' => $item['nom'],
                        'quantite' => $item['quantite'],
                        'prix_unitaire' => $item['prix'],
                        'total' => $ligneTotal,
                    ]);

                    $total += $ligneTotal;
                

                    // Mise a jour du stock
                    StockMouvement::create([
                        'entreprise_id' => $entreprise->id,
                        'user_id' => request()->user()->id,
                        'produit_id' => null,
                        'designation' => $item['nom'],
                        'type' => 'entree',
                        'quantite' => $item['quantite'],
                        'reference' => 'MVT-ACT-' . now()->timestamp,
                    ]);

                }
                
            } elseif(!empty($request->produits)) { // Produit déja enrégistré
                
                foreach ($request->produits as $item) {

                    // Récupération de l'entreprise
                    $entreprise= entreprise::Where('id', request()->user()->entreprise_id)->first(); 

                    $ligneTotal = $item['quantite'] * $item['prix_achat'];

                    $total += $ligneTotal;


                    // Récupération du produit original rechercher
                    $produit = produit::where('id', $item['nom'])->lockForUpdate()->first();
                    // dd($produit);

                    // Verification si le produit existe
                    if(!empty($produit)) {

                        // Creation achat detail
                        AchatDetail::create([
                            'entreprise_id' => $entreprise->id,
                            'achat_id' => $achat->id,
                            'produit_id' => $item['nom'],
                            'quantite' => $item['quantite'],
                            'prix_unitaire' => $item['prix_achat'],
                            'total' => $ligneTotal,
                        ]);

                        // Ajouter la quantité au stock existant
                        $ancienStock = $produit->stock;
                        $nouvelleQuantite = $ancienStock + $item['quantite'];

                        $produit->update([
                            'stock' => $nouvelleQuantite,
                            'prix_achat' => $produit->prix_achat,
                            'prix_vente' => $produit->prix_vente, 
                            'fournisseur_id' => $request->fournisseur_id ?? $achat->fournisseur_id, 
                        ]);

                        // Enregistrement d'un historique de mouvement
                        StockMouvement::create([
                            'entreprise_id' => $request->user()->entreprise_id,
                            'produit_id' => $produit->id,
                            'type' => 'entree',
                            'quantite' => $item['quantite'],
                            'reference' => 'MVT/PRD-' . now()->timestamp,
                            'user_id' => $request->user()->id,
                        ]);

                    } else {

                        // Creation achat detail
                        AchatDetail::create([
                            'entreprise_id' => $entreprise->id,
                            'achat_id' => $achat->id,
                            'designation' => $item['nom'],
                            'quantite' => $item['quantite'],
                            'prix_unitaire' => $item['prix_achat'],
                            'total' => $ligneTotal,
                        ]);

                        // Creation nouveau produit
                        $produit= Produit::create([
                            'entreprise_id' => $request->user()->entreprise_id,
                            'fournisseur_id' => $request->fournisseur_id ?? null,
                            'categorie_id' => null,
                            'nom' => $item['nom'],
                            'code' => $this->generateCode($request->user()->entreprise_id),
                            'prix_achat' => $item['prix_achat'],
                            'prix_vente' => $item['prix_achat'] * 1.2, // Prix de vente par défaut avec une marge de 20%
                            'stock_min' => 0,
                            'stock' => $item['quantite'],
                        ]);

                            
                        // Enregistrement d'un historique de mouvement
                        StockMouvement::create([
                            'entreprise_id' => $request->user()->entreprise_id,
                            'designation' => $item['nom'],
                            'type' => 'entree',
                            'quantite' => $item['quantite'],
                            'reference' => 'MVT/PRD-' . now()->timestamp,
                            'user_id' => $request->user()->id,
                        ]);
                    }
      
                }
            }

            // Mise à jour du total
            $achat->update([
                'total' => $total
            ]);

            Depense::create([
                'entreprise_id' => $entreprise->id,
                'user_id' => request()->user()->id,
                'reference' => 'DEP-' . now()->timestamp,
                'libelle' => 'Achat - '. $achat->reference,
                'description' => 'Achat produit',
                'montant' => $achat->total,
                'date_depense' => now(),
                'mode_paiement' => 'cash',
            ]);

        DB::commit();

        return redirect()->route('achats.index')->with('success', 'Achat créé avec succès');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Erreur : ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entreprise= entreprise::Where('id', request()->user()->entreprise_id)->first(); 

        $achat = Achat::with('fournisseur', 'details')->findOrFail($id);

        $achat->load(['fournisseur', 'details']);
        
        $pdf = Pdf::loadView('inventaire.achats.show', compact('achat', 'entreprise'));

        return $pdf->stream ('Facture-' . $achat->reference . '.pdf');
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

    private function generateCode(int $entrepriseId): string
    {
        $lastProduit = Produit::where('entreprise_id', $entrepriseId)->orderBy('id', 'desc')->first();

        $number = $lastProduit ? intval(substr($lastProduit->code, -5)) + 1 : 1;

        return 'PRD-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}

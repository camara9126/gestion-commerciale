<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Depense;
use App\Models\Fournisseur;
use App\Models\Pack;
use App\Models\Produit;
use App\Models\Recette;
use App\Models\StockMouvement;
use App\Models\Support;
use App\Models\Vente;
use App\Models\VenteItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

//use function Symfony\Component\Clock\now;

class DashboardController extends Controller
{
     use AuthorizesRequests;
    // Accueil
    public function index()
    {
        $this->authorize('admin');

        $entreprise = request()->user()->entreprise;

        // Redirection abonnenemt si le Essai gratuite est termine
        if($entreprise->trialExpire()) {
             return redirect()->route('dashboard.abonnement');
        }

        $alerte = Produit::produitsEnAlerte()->count();

        /* Changement de mois */ 
        $mois = $request->mois ?? now()->month;
        $annee = $request->annee ?? now()->year;

        $produits = Produit::with('fournisseur')->where('entreprise_id', request()->user()->entreprise_id)->limit(5)->latest()->get();

        $ventes = Vente::with('client')->where('entreprise_id', request()->user()->entreprise_id)->limit(3)->latest()->get();

        /* 1️⃣ Commandes par mois */
        $commandesParJour = Vente::selectRaw('DAY(created_at) jour, COUNT(*) total')->where('entreprise_id', request()->user()->entreprise_id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->groupBy('jour')->orderBy('jour')->get();

        $commandesMoisLabels = $commandesParJour->pluck('jour');
        $commandesMoisData = $commandesParJour->pluck('total');

        return view('dashboard.index', compact('commandesMoisLabels','commandesMoisData','produits','ventes','entreprise','mois','annee','alerte')); 
    }


    // Comptabilite
    public function comptabilite()
    {
        return view('dashboard.comptabilite');
    }


    // Page Abonnement
     public function abonnement()
    {
        $entreprise = request()->user()->entreprise;
        $packs = Pack::all();
        $alerte = Produit::produitsEnAlerte()->count();

        return view('dashboard.abonnement', compact('entreprise','packs','alerte'));
    }


    // Calcule des rapport
    public function rapport(Request $request)
    {

        $entreprise = request()->user()->entreprise;
        $alerte = Produit::produitsEnAlerte()->count();

        /* Changement de mois */ 
        $mois = $request->mois ?? now()->month;
        $annee = $request->annee ?? now()->year;


        /* 1️⃣ Commandes par mois */
        $commandesParJour = Vente::selectRaw('DAY(created_at) jour, COUNT(*) total')->where('entreprise_id', $entreprise->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->groupBy('jour')->orderBy('jour')->get();

        $commandesMoisLabels = $commandesParJour->pluck('jour');
        $commandesMoisData = $commandesParJour->pluck('total');


        /* 2️⃣ Chiffre d’affaires par mois */
        $caParMois = Recette::selectRaw('MONTH(created_at) as mois, SUM(montant) as total')->where('entreprise_id', $entreprise->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->where('statut', 'recu')->groupBy('mois')->orderBy('mois')->get();

        $caLabels = $caParMois->pluck('mois')->map(fn ($m)=>
            Carbon::create()->month($m)->translatedFormat('M')
        );
        $caData = $caParMois->pluck('total');


        /* 3️⃣ Top produits du mois */
        $topProduits = VenteItem::selectRaw('produit_id, SUM(quantite) as total')->where('entreprise_id', $entreprise->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->groupBy('produit_id')->orderByDesc('total')->with('produit:id,nom')->limit(5)->get();

        $topProduitsLabels = $topProduits->pluck('produit.nom');
        $topProduitsData = $topProduits->pluck('total');


        /* 4️⃣ Statut des commandes */
        $statutCommandes = Vente::where('entreprise_id', $entreprise->id)->where('entreprise_id', $entreprise->id)->selectRaw('statut, COUNT(*) as total')->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->groupBy('statut')->get();

        $statutLabels = $statutCommandes->pluck('statut');
        $statutData = $statutCommandes->pluck('total');


               /* Changement de mois */ 
        $mois = $request->mois ?? now()->month;
        $annee = $request->annee ?? now()->year;


        /* 1️⃣ Commandes par mois */
        $commandesParJour = Vente::selectRaw('DAY(created_at) jour, COUNT(*) total')->where('entreprise_id', $entreprise->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->groupBy('jour')->orderBy('jour')->get();

        $commandesMoisLabels = $commandesParJour->pluck('jour');
        $commandesMoisData = $commandesParJour->pluck('total');

        /* 2️⃣ Top produits du mois */
        $topProduits = VenteItem::selectRaw('produit_id, SUM(quantite) as total')->where('entreprise_id', $entreprise->id)->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->groupBy('produit_id')->orderByDesc('total')->with('produit:id,nom')->limit(5)->get();

        $topProduitsLabels = $topProduits->pluck('produit.nom');
        $topProduitsData = $topProduits->pluck('total');


        // ===== 2em SECTION SUR LES DEPENSES ET RECETTES =====

            // ===== MENSUEL =====

            $months = [];
            $revenues = [];
            $expenses = [];
            $profits = [];

            for ($i = 1; $i <= 12; $i++) {

                $recette = Recette::whereMonth('created_at', $i)->where('entreprise_id', $entreprise->id)->whereYear('created_at', now()->year)->sum('montant');

                $depense = Depense::whereMonth('created_at', $i)->where('entreprise_id', $entreprise->id)->whereYear('created_at', now()->year)->sum('montant');

                $months[] = Carbon::create()->month($i)->translatedFormat('F');
                $revenues[] = round($recette, 2);
                $expenses[] = round($depense, 2);
                $profits[] = round($recette - $depense, 2);
            }

            $monthlyData = [
                'months' => $months,
                'revenues' => $revenues,
                'expenses' => $expenses,
                'profits' => $profits,
            ];

            // ===== TRIMESTRIEL =====

            $quarterlyData = [
                'quarters' => ['T1', 'T2', 'T3', 'T4'],
                'revenues' => [],
                'expenses' => [],
                'profits' => []
            ];

            for ($q = 1; $q <= 4; $q++) {

                $recette = Recette::where('entreprise_id', $entreprise->id)->whereBetween(DB::raw('MONTH(created_at)'), [($q-1)*3+1, $q*3])->sum('montant');

                $depense = Depense::where('entreprise_id', $entreprise->id)->whereBetween(DB::raw('MONTH(created_at)'), [($q-1)*3+1, $q*3])->sum('montant');

                $quarterlyData['revenues'][] = $recette;
                $quarterlyData['expenses'][] = $depense;
                $quarterlyData['profits'][] = $recette - $depense;
            }

            // ===== ANNUEL (3 dernières années) =====

            $years = [];
            $yearRevenue = [];
            $yearExpense = [];
            $yearProfit = [];

            for ($y = now()->year - 2; $y <= now()->year; $y++) {

                $r = Recette::where('entreprise_id', $entreprise->id)->whereYear('created_at', $y)->sum('montant');

                $d = Depense::where('entreprise_id', $entreprise->id)->whereYear('created_at', $y)->sum('montant');

                $years[] = $y;
                $yearRevenue[] = $r;
                $yearExpense[] = $d;
                $yearProfit[] = $r - $d;
            }

            $yearlyData = [
                'years' => $years,
                'revenues' => $yearRevenue,
                'expenses' => $yearExpense,
                'profits' => $yearProfit,
            ];


            // Top produit mois
            $monthTopProduits = DB::table('vente_items')->join('produits', 'vente_items.produit_id', '=', 'produits.id')->select('produits.nom as produit',
                        DB::raw('SUM(vente_items.quantite * vente_items.prix_unitaire) as total'))->where('vente_items.entreprise_id', $entreprise->id)->whereMonth('vente_items.created_at', now()->month)->groupBy('produits.nom')->orderByDesc('total')->limit(10)->get();

                $categories = $monthTopProduits->pluck('produit');
                $amounts = $monthTopProduits->pluck('total');

                
            // Top produit annee
            $yearTopProduits = DB::table('vente_items')->join('produits', 'vente_items.produit_id', '=', 'produits.id')->select('produits.nom as produit', DB::raw('SUM(vente_items.quantite * vente_items.prix_unitaire) as total'))->where('vente_items.entreprise_id', $entreprise->id)->whereYear('vente_items.created_at', now()->year)->groupBy('produits.nom')->orderByDesc('total')->limit(10)->get();

            $yearCategories = $yearTopProduits->pluck('produit');
            $yearAmounts = $yearTopProduits->pluck('total');

        return view('dashboard.rapport', compact('commandesMoisLabels','commandesMoisData','caLabels','caData','topProduitsLabels','topProduitsData','statutLabels','statutData', 'entreprise','alerte','monthlyData','quarterlyData','yearlyData','categories', 'amounts','yearAmounts','yearCategories'));
    }


    // Changement de mois
    public function support(Request $request)
    {
        $entreprise = request()->user()->entreprise;

        $request->validate([
            'user_id',
            'entreprise_id',
            'nom_complet' =>'required',
            'email' => 'required',
            'telephone' => 'required',
            'urgence' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

         // Gestion des l'images
        if ($request->hasFile('image')) {
            $filename = time().$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $filename, 'public');
            $request['image'] = '/storage/' . $path;
        }

        Support::create([
        'user_id' => request()->user()->id,
        'entreprise_id' => $entreprise->id,
        'nom_complet' => $request->nom_complet,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'urgence' => $request->urgence,
        'description' => $request->description,
        'image' => $path ?? null,
        ]);

        return redirect()->back()->with('success', '✅ Demande envoyée. Merci ! Notre équipe va traiter votre requête.');
    }

    
}

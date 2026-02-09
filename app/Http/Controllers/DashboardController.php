<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Pack;
use App\Models\Produit;
use App\Models\Recette;
use App\Models\StockMouvement;
use App\Models\Vente;
use App\Models\VenteItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

//use function Symfony\Component\Clock\now;

class DashboardController extends Controller
{
    // Accueil
    public function index()
    {
        $entreprise = request()->user()->entreprise;

        // Redirection abonnenemt si le Essai gratuite est termine
        if($entreprise->trialExpire()) {
             return redirect()->route('dashboard.abonnement');
        }

        $fournisseurs = Fournisseur::where('entreprise_id', request()->user()->entreprise_id)->limit(3)->latest()->get();
        $produits = Produit::with('fournisseur')->where('entreprise_id', request()->user()->entreprise_id)->limit(3)->latest()->get();
        $mouvements_ent = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'entree')->limit(3)->latest()->get();
        $mouvements_sor = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'sortie')->limit(3)->latest()->get();

        $clients = Client::where('entreprise_id', request()->user()->entreprise_id)->limit(3)->latest()->get();
        $ventes = Vente::with('client')->where('entreprise_id', request()->user()->entreprise_id)->limit(3)->latest()->get();

        return view('dashboard.index', compact('produits','fournisseurs','mouvements_ent','mouvements_sor','clients','ventes','entreprise')); 
    }


    // Page Abonnement
     public function abonnement()
    {
        $entreprise = request()->user()->entreprise;
        $packs = Pack::all();

        return view('dashboard.abonnement', compact('entreprise','packs'));
    }


    // Calcule des rapport
    public function rapport(Request $request)
    {

        $entreprise = request()->user()->entreprise;

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
        $statutCommandes = Vente::where('entreprise_id', $entreprise->id)->selectRaw('statut, COUNT(*) as total')->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->groupBy('statut')->get();

        $statutLabels = $statutCommandes->pluck('statut');
        $statutData = $statutCommandes->pluck('total');


        return view('dashboard.rapport', compact('commandesMoisLabels','commandesMoisData','caLabels','caData','topProduitsLabels','topProduitsData','statutLabels','statutData', 'entreprise'));
    }


    // Changement de mois
    public function stats(Request $request)
    {
        $mois = $request->month;
        $annee = $request->year;
        $entrepriseId = request()->user()->entreprise_id;

        /* 1️⃣ Commandes par jour du mois */
        $commandes = Vente::selectRaw('DAY(created_at) jour, COUNT(*) total')->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->where('entreprise_id', $entrepriseId)->groupBy('jour')->orderBy('jour')->get();


        /* 2️⃣ Chiffre d'affaires */
        $ca = Recette::whereMonth('created_at', $mois)->whereYear('created_at', $annee)->where('entreprise_id', $entrepriseId)->sum('montant');


        /* 3️⃣ Top produits */
        $produits = VenteItem::selectRaw('produit_id, SUM(quantite) total')->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->where('entreprise_id', $entrepriseId)->groupBy('produit_id')->with('produit:id,nom')->orderByDesc('total')->limit(5)->get();


        /* 4️⃣ Statut commandes */
        $statuts = Vente::selectRaw('statut, COUNT(*) total')->whereMonth('created_at', $mois)->whereYear('created_at', $annee)->where('entreprise_id', $entrepriseId)->groupBy('statut')->get();

        return response()->json(['commandes' => $commandes,'ca' => $ca,'produits' => $produits,'statuts' => $statuts,]);
    }

    
}

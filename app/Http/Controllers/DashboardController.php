<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Recette;
use App\Models\StockMouvement;
use App\Models\Vente;
use App\Models\VenteItem;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Accueil
    public function index()
    {
        $fournisseurs = Fournisseur::where('entreprise_id', request()->user()->entreprise_id)->limit(3)->latest()->get();
        $produits = Produit::with('fournisseur')->where('entreprise_id', request()->user()->entreprise_id)->limit(3)->latest()->get();
        $mouvements_ent = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'entree')->limit(3)->latest()->get();
        $mouvements_sor = StockMouvement::where('entreprise_id', request()->user()->entreprise_id)->where('type', 'sortie')->limit(3)->latest()->get();

        $clients = Client::where('entreprise_id', request()->user()->entreprise_id)->limit(3)->latest()->get();
        $ventes = Vente::with('client')->where('entreprise_id', request()->user()->entreprise_id)->limit(3)->latest()->get();

        return view('dashboard.index', compact('produits','fournisseurs','mouvements_ent','mouvements_sor','clients','ventes')); 
    }


    public function rapport()
    {
        $entrepriseId = request()->user()->entreprise_id;

        /* 1️⃣ Commandes par mois */
        $commandesParMois = Vente::selectRaw('MONTH(created_at) mois, COUNT(*) total')->where('entreprise_id', request()->user()->entreprise_id)->whereYear('created_at', now()->year)->groupBy('mois')->get();

        $commandesMoisLabels = [];
        $commandesMoisData = [];

        foreach ($commandesParMois as $item) {
            $commandesMoisLabels[] = Carbon::create()->month($item->mois)->format('M');
            $commandesMoisData[] = $item->total;
        }


        /* 2️⃣ Chiffre d’affaires par mois */
        $caParMois = Recette::selectRaw('MONTH(created_at) mois, SUM(montant) total')->where('entreprise_id', request()->user()->entreprise_id)->where('statut', 'valide')->whereYear('created_at', now()->year)->groupBy('mois')->get();

        $caLabels = [];
        $caData = [];

        foreach ($caParMois as $item) {
            $caMoisLabels[] = Carbon::create()->month($item->mois)->format('M');
            $caMoisData[] = $item->total;
        }


        /* 3️⃣ Top produits du mois */
        $topProduits = VenteItem::selectRaw('produit_id, SUM(quantite) total_ttc')->whereMonth('created_at', now()->month)->groupBy('produit_id')->with('produit')->orderByDesc('total')->limit(5)->get();

        $topProduitsLabels = $topProduits->pluck('nom');
        $topProduitsData = $topProduits->pluck('total');


        /* 4️⃣ Statut des commandes */
        $statutCommandes = Vente::selectRaw('statut, COUNT(*) total_ttc')->where('entreprise_id', request()->user()->entreprise_id)->groupBy('statut')->pluck('total_ttc', 'statut');

        $statutLabels = $statutCommandes->pluck('statut');
        $statutData = $statutCommandes->pluck('total_ttc');

        //return view('dashboard.test', compact('$commandesMoisLabels','$commandesMoisData','caLabels','caData','topProduitsLabels','topProduitsData','statutLabels','statutData'));
        return view('rapport', compact('commandesMoisLabels','commandesMoisData','caLabels','caData','topProduitsLabels','topProduitsData','statutLabels','statutData'));
    }
}

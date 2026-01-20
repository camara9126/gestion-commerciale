 <?php

use App\Models\Client;
use App\Models\Produit;
use App\Models\Recette;
use App\Models\Vente;

    // chiffre d'affaire mois actuel
    $caMoisActuel = Recette::where('entreprise_id', request()->user()->entreprise_id)->where('statut', 'recu')->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('montant');

    // chiffre d'affairemois precedent
    $caMoisPrecedent = Recette::where('entreprise_id', request()->user()->entreprise_id)->where('statut', 'recu')->whereMonth('created_at', now()->submonth()->month)->whereYear('created_at', now()->subMonth()->year)->sum('montant');

    // Taux chiffre d'affaire
    $tauxCA = $caMoisPrecedent > 0 ? (($caMoisActuel - $caMoisPrecedent) / $caMoisPrecedent) * 100 : null;

    // Commande mois actuel
    $commandesMois = Vente::where('entreprise_id', request()->user()->entreprise_id)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

    // Commande mois precedent
    $commandesMoisPrecedent = Vente::where('entreprise_id', request()->user()->entreprise_id)->whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year)->count();

    // Taux commande
    $tauxCommandes = $commandesMoisPrecedent > 0 ? (($commandesMois - $commandesMoisPrecedent) / $commandesMoisPrecedent)* 100 : null;

    // Total produit
    $totalProduits = Produit::where('entreprise_id', request()->user()->entreprise_id)->count();

    // Produit ajoute de ce mois
    $produitsMois = Produit::where('entreprise_id', request()->user()->entreprise_id)->whereMonth('created_at', now()->month)->count();

    // Produit mois precedenr
    $produitsMoisPrecedent = Produit::where('entreprise_id', request()->user()->entreprise_id)->whereMonth('created_at', now()->subMonth()->month)->count();

    // nombre total de cient
    $totalClients = Client::where('entreprise_id', request()->user()->entreprise_id)->count();

    // client de ce mois
    $clientsMois = Client::where('entreprise_id', request()->user()->entreprise_id)->whereMonth('created_at', now()->month)->count();

    // client du mois precedent
    $clientsMoisPrecedent = Client::where('entreprise_id', request()->user()->entreprise_id)->whereMonth('created_at', now()->subMonth()->month)->count();

    // Taux client
    $tauxClients = $clientsMoisPrecedent > 0 ? (($clientsMois - $clientsMoisPrecedent) / $clientsMoisPrecedent) * 100 : null;

?>



 <div class="row g-3 mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Chiffre d'affaires (mois actuel)</p>
                    <h3 class="value fw-bold">{{ $caMoisActuel }} XOF</h3>
                    <small class="text-success">
                        @if($tauxCommandes > 15)
                            <i class="fas fa-arrow-up me-1"></i> {{number_format($tauxCommandes, 1)}}% vs mois dernier
                        @elseif($tauxCommandes < 8)
                            <i class="fas fa-arrow-down me-1"></i> {{number_format(abs($tauxCommandes), 1)}}% vs mois dernier
                        @endif
                    </small>
                </div>
                <div class="icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-euro-sign"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Commandes (mois actuel)</p>
                    <h3 class="value fw-bold">{{$commandesMois}}</h3>
                    <small class="text-success">
                         @if($tauxCA > 15)
                            <i class="fas fa-arrow-up me-1"></i> {{number_format($tauxCA, )}}% vs mois dernier
                        @elseif($tauxCA < 8)
                            <i class="fas fa-arrow-down me-1"></i> {{number_format(abs($tauxCA), 1)}}% vs mois dernier
                        @endif
                    </small>
                </div>
                <div class="icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Clients (mois actuel)</p>
                    <h3 class="value fw-bold">{{$clientsMois}}</h3>
                    <small class="text-success">
                        @if($tauxClients > 15)
                            <i class="fas fa-arrow-up me-1"></i> {{number_format($tauxClients, 1)}}% vs mois dernier
                        @elseif($tauxClients < 8)
                            <i class="fas fa-arrow-down me-1"></i> {{number_format(abs($tauxClients), 1)}}% vs mois dernier
                        @endif
                    </small>
                </div>
                <div class="icon bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Produits (mois actuel)</p>
                    <h3 class="value fw-bold">{{$produitsMois}}</h3>
                    <small class="text-danger">
                            <i class="fas fa-arrow-down me-1"></i>12% vs mois dernier
                    </small>
                </div>
                <div class="icon bg-info bg-opacity-10 text-info">
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card bg-white p-4 shadow-sm border-start border-primary border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Chiffre d'affaires</p>
                    <h3 class="fw-bold">CFA 12,540</h3>
                </div>
                <div class="dashboard-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-euro-sign"></i>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-success"><i class="fas fa-arrow-up me-1"></i> 12.5%</span>
                <span class="text-muted ms-2">vs mois dernier</span>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card bg-white p-4 shadow-sm border-start border-success border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Commandes</p>
                    <h3 class="fw-bold"><?= count($ventes)?></h3>
                </div>
                <div class="dashboard-icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-success"><i class="fas fa-arrow-up me-1"></i> 8.2%</span>
                <span class="text-muted ms-2">vs mois dernier</span>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card bg-white p-4 shadow-sm border-start border-warning border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Clients</p>
                    <h3 class="fw-bold"><?= count($clients)?></h3>
                </div>
                <div class="dashboard-icon bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-success"><i class="fas fa-arrow-up me-1"></i> 5.3%</span>
                <span class="text-muted ms-2">vs mois dernier</span>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card bg-white p-4 shadow-sm border-start border-info border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Produits</p>
                    <h3 class="fw-bold"><?= count($produits)?></h3>
                </div>
                <div class="dashboard-icon bg-info bg-opacity-10 text-info">
                    <i class="fas fa-box"></i>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-danger"><i class="fas fa-arrow-down me-1"></i> 2.1%</span>
                <span class="text-muted ms-2">stock faible</span>
            </div>
        </div>
    </div>
</div>-->
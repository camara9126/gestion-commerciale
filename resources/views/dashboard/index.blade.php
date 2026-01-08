<?php

use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BizManager - Gestion Commerciale</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">
    
</head>
<body>
    <!-- Sidebar -->
    @include('partials.sidebar')
    
    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="h4 mb-0" id="pageTitle">Tableau de bord</h2>
            </div>
            
            <div class="d-flex align-items-center">
                <!-- Search Bar - Hidden on mobile -->
                <div class="d-none d-md-block me-3">
                    <div class="input-group" style="width: 300px;">
                        <input type="text" class="form-control" placeholder="Rechercher...">
                        <button class="btn btn-outline-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Notifications -->
                <div class="dropdown me-3">
                    <button class="btn btn-light position-relative" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">Notifications</h6></li>
                        <li><a class="dropdown-item" href="#">Nouvelle commande #1234</a></li>
                        <li><a class="dropdown-item" href="#">Paiement reçu de Client XYZ</a></li>
                        <li><a class="dropdown-item" href="#">Stock faible pour Produit A</a></li>
                    </ul>
                </div>
                
                <!-- Mobile Search Button -->
                <button class="btn btn-light d-md-none me-2" id="mobileSearchBtn">
                    <i class="fas fa-search"></i>
                </button>
                
                <!-- User Menu -->
                <div class="dropdown">
                    <button class="btn btn-light d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                        <div class="user-profile me-2"><?= strtoupper(Auth::user()->name[0]) ?></div>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Mon profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                        @csrf    
                                <a class="dropdown-item" href="{{route('logout')}}"onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</a></li>
                            </form>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="container-fluid p-3 p-md-4" id="contentArea">
            <!-- Dashboard Section -->
            <section id="dashboard" class="content-section">
                <!-- Stats Row -->
                @include('partials.data')
                @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @elseif(Session::has('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('danger') }}
                        </div>
                    @endif
                <!-- Recent Orders -->
                <div class="row">
                    <div class="col-12">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Dernières commandes</h5>
                                <a href="{{route('ventes.index')}}" class="btn btn-sm btn-primary">Voir tout</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Reference</th>
                                            <th>Client</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ventes as $v)
                                        <tr>
                                            <td>{{$v->reference}}</td>
                                            <td>{{$v->client->nom ?? 'Client supprimee'}}</td>
                                            <td>{{number_format($v->total, 0, ',','')}}</td>
                                            <td>{{$v->created_at->format('d/m/y')}}</td>
                                            <td>
                                                @if($v->statut == 'payee')
                                                    <span class="status-badge badge-paid">{{$v->statut}}</span>
                                                @else
                                                    <span class="status-badge badge-pending">{{$v->statut}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" align="center">Donnee vide !</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!--<table class="table data-table">
                                    <thead>
                                        <tr>
                                            <th>N° Commande</th>
                                            <th>Client</th>
                                            <th>Date</th>
                                            <th>Montant</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>#ORD-001</strong></td>
                                            <td>Marie Dubois</td>
                                            <td>15/05/2023</td>
                                            <td><strong>€450</strong></td>
                                            <td><span class="status-badge badge-paid">Payé</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary btn-action">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>#ORD-002</strong></td>
                                            <td>Jean Martin</td>
                                            <td>14/05/2023</td>
                                            <td><strong>€890</strong></td>
                                            <td><span class="status-badge badge-pending">En attente</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary btn-action">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>#ORD-003</strong></td>
                                            <td>Sophie Bernard</td>
                                            <td>13/05/2023</td>
                                            <td><strong>€320</strong></td>
                                            <td><span class="status-badge badge-paid">Payé</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary btn-action">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>-->
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="stat-card">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Liste des clients</h5>
                                <a href="{{route('clients.index')}}" class="btn btn-sm btn-primary">Voir plus</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table data-table">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Telephone</th>
                                            <th>Email</th>
                                            <th>Adresse</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clients as $c)
                                        <tr>
                                            <td>{{$c->nom}}</td>
                                            <td>{{$c->telephone}}</td>
                                            <td>{{$c->email}}</td>
                                            <td>{{$c->adresse}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section Fournisseurs -->
                <div class="row mb-5">
                    <div class="stat-card">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between align-items-center mb-0">                          
                                <h5 class="mb-0">Fournisseurs</h5>
                                <a href="{{route('fournisseurs.index')}}" class="btn btn-primary">
                                        Voir plus
                                </a>
                            </div>
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Adresse</th>
                                                        <th>Telephone</th>
                                                        <th>Email</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($fournisseurs as $f)
                                                    <tr>
                                                        <td>{{$f->nom}}</td>
                                                        <td>{{$f->adresse}}</td>
                                                        <td>{{$f->telephone}}</td>
                                                        <td>{{$f->email}}</td>
                                                        <td>
                                                            @if($f->adresse)
                                                                <span class="badge bg-success">Activé</span>
                                                                @else
                                                                <span class="badge bg-warning">Desactivé</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                                    
                                
                                </div>
                            </div>                                
                        </div>
                    </div>
                </div>

                <hr>
                <!-- Section Produits -->
                <div class="row mb-5">
                    <div class="stat-card">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between align-items-center mb-0">                          
                                <h5 class="mb-0">Produits</h5>
                                <a href="{{route('produits.index')}}" class="btn btn-primary">
                                        Voir plus
                                </a>
                            </div>
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Code</th>
                                                        <th>Prix d'achat</th>
                                                        <th>Stock</th>
                                                        <th>Fournisseur</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($produits as $p)
                                                    <tr>
                                                        <td>{{$p->nom}}</td>
                                                        <td>{{$p->code}}</td>
                                                        <td>{{number_format($p->prix_achat, 0,'','')}} XOF</td>
                                                        <td>{{$p->stock}}</td>
                                                        <td>{{$p->fournisseur->nom}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                                    
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb-4">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Historique des mouvements</h5>
                            <a href="{{route('mouvements')}}" class="btn btn-sm btn-primary">Voir plus</a>
                        </div>
                        <!-- Historiques Mouvements -->
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="stat-card">
                                    <div class="list-group list-group-flush">
                                        <div class="table-responsive">
                                            <table class="table data-table">
                                                <thead>
                                                    <tr>
                                                        <th>Reference</th>
                                                        <th>Produit</th>
                                                        <th>Quantite</th>
                                                        <th>Date</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($mouvements_ent as $m)
                                                    <tr>
                                                        <td><strong>{{$m->reference}}</strong></td>
                                                        <td>{{$m->produit->nom}}</td>
                                                        <td>{{$m->quantite}}</td>
                                                        <td>{{$m->created_at->format('j / F / Y')}}</td>
                                                        <td>
                                                            @if($f->statut == 'entree')
                                                                <span class="badge bg-success">entree</span>
                                                                @else
                                                                <span class="badge bg-danger">sortie</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Section Commercial -->
     
                      
            </section>

            <section id="finance" class="content-section d-none">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3>Gestion des commandes</h3>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Nouvelle commande
                        </button>
                    </div>
                    <p class="text-muted">Gérez ici toutes les commandes de vos clients, suivez leur statut et traitez les paiements.</p>
                </div>
            </section>
            
            <section id="invoices" class="content-section d-none">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3>Gestion des factures</h3>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Nouvelle facture
                        </button>
                    </div>
                    <p class="text-muted">Créez, gérez et suivez les factures pour vos clients dans cette section.</p>
                </div>
            </section>
            
            <section id="reports" class="content-section d-none">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3>Rapports et analyses</h3>
                        <button class="btn btn-primary">
                            <i class="fas fa-download me-2"></i> Exporter
                        </button>
                    </div>
                    <p class="text-muted">Accédez à des rapports détaillés sur vos ventes, performances et indicateurs clés.</p>
                </div>
            </section>
            
            <section id="settings" class="content-section d-none">
                <div class="stat-card">
                    <h3 class="mb-4">Paramètres de l'application</h3>
                    <p class="text-muted">Configurez les paramètres de votre application de gestion commerciale.</p>
                </div>
            </section>
        </div>
        
        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">© 2026 Ges-Com. Tous droits réservés.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0 text-muted">Version 1.0.0</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
   <script src="{{asset('asset/main.js')}}"></script>
</body>
</html>
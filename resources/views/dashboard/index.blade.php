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
                                <a href="#" class="btn btn-sm btn-primary">Voir tout</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table data-table">
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
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Section Inventaire -->
            <section id="inventaire" class="content-section d-none">
                

                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @elseif(Session::has('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('danger') }}
                        </div>
                    @endif
                    <!-- Section Fournisseurs -->
                    <div class="row mb-5">
                        <div class="stat-card">
                            <div class="col-lg-10">
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
                                                            <th>Actions</th>
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
                                                            <td>
                                                                <a href="{{route('fournisseurs.edit', $f->id)}}">
                                                                    <i class="fa fa-eye text-primary"></i>
                                                                </a>
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
                        @if ($errors->any())
                            <div style="color: red; margin-bottom: 10px;">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <div class="stat-card">
                            <div class="col-lg-10">
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
                                                            <th>Fournisseur</th>
                                                            <th>Prix de vente</th>
                                                            <th>Stock</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($produits as $p)
                                                        <tr>
                                                            <td>{{$p->nom}}</td>
                                                            <td>{{$p->code}}</td>
                                                            <td>{{$p->fournisseur->nom}}</td>
                                                            <td>{{number_format($p->prix_vente, 0,'','')}} XOF</td>
                                                            <td>{{$p->stock}}</td>
                                                            <td>
                                                                <a href="{{route('produits.edit', $p->id)}}">
                                                                    <i class="fa fa-eye text-primary"></i>
                                                                </a>
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
            </section>


            <!-- Mouvements -->
            <section id="mouvements" class="content-section d-none">
                <div class="stat-card">
                    <!-- Historiques Mouvements -->
                    <div class="row mb-4">
                        <h5 class="mb-4">Historique des mouvements</h5>
                        <div class="col-lg-6">
                            <h5 class="text-white bg-success">Entree</h5>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($mouvements_ent as $m)
                                                <tr>
                                                    <td><strong>{{$m->reference}}</strong></td>
                                                    <td>{{$m->produit->nom}}</td>
                                                    <td>{{$m->quantite}}</td>
                                                    <td>{{$m->created_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5 class=" text-white bg-danger">Sortie</h5>
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($mouvements_sor as $m)
                                                    <tr>
                                                        <td><strong>{{$m->reference}}</strong></td>
                                                        <td>{{$m->produit->nom}}</td>
                                                        <td>{{$m->quantite}}</td>
                                                        <td>{{$m->created_at}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Mouvements Entree/Sortie -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="stat-card">
                                <h5>Mouvements Entree</h5>
                                <form method="post" action="{{route('stock.entree')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Produit</label>
                                        <select class="form-control" name="produit_id" id="exampleFormControlSelect1">
                                            <option value="">-- Veuillez choisir un produit --</option>
                                            @foreach($produits as $p)
                                            <option value="{{$p->id}}">{{$p->nom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="exampleInputPassword1">Quantite</label>
                                        <input type="number" name="quantite" min="1" class="form-control" id="exampleInputquantity1">
                                    </div>
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="stat-card">
                                <h5>Mouvements Sortie</h5>
                                <form method="post" action="{{route('stock.sortie')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Produit</label>
                                        <select class="form-control" name="produit_id" id="exampleFormControlSelect1">
                                            <option value="">-- Veuillez choisir un produit --</option>
                                            @foreach($produits as $p)
                                            <option value="{{$p->id}}">{{$p->nom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="exampleInputPassword1">Quantite</label>
                                        <input type="number" name="quantite" min="1" class="form-control" id="exampleInputquantity1">
                                    </div>
                                    <button type="submit" class="btn btn-danger">Enregistrer</button>
                                </form>
                            </div>  
                        </div>
                    </div>
                </div>
            </section>

            <!-- Ventes -->
             <section id="clients" class="content-section d-none">
                <div class="row">
                    <div class="col-10">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Liste des ventes</h5>
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
                                            <td>
                                                <a href="{{route('clients.edit', $c->id)}}">
                                                    <i class="fa fa-eye text-primary"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Clients -->
            <section id="clients" class="content-section d-none">
                <div class="row">
                    <div class="col-10">
                        <div class="stat-card">
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
                                            <td>
                                                <a href="{{route('clients.edit', $c->id)}}">
                                                    <i class="fa fa-eye text-primary"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
    
    <script>
        // Toggle sidebar on mobile
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const mainContent = document.getElementById('mainContent');
        
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
        
        // Navigation between sections
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetSection = this.getAttribute('data-section');
                
                // Update page title
                document.getElementById('pageTitle').textContent = this.textContent.trim();
                
                // Update active nav link
                document.querySelectorAll('.nav-link').forEach(navLink => {
                    navLink.classList.remove('active');
                });
                this.classList.add('active');
                
                // Show target section
                document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.add('d-none');
                });
                document.getElementById(targetSection).classList.remove('d-none');
                
                // Close sidebar on mobile
                if (window.innerWidth < 992) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        });
        
        // Mobile search functionality
        const mobileSearchBtn = document.getElementById('mobileSearchBtn');
        if (mobileSearchBtn) {
            mobileSearchBtn.addEventListener('click', function() {
                const searchQuery = prompt("Entrez votre recherche :");
                if (searchQuery) {
                    alert("Recherche de : " + searchQuery);
                    // Implement search functionality here
                }
            });
        }
        
        // Initialize sales chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                    datasets: [{
                        label: 'Ventes (€)',
                        data: [6500, 8100, 7500, 9200, 12540, 11000, 13500, 12000, 9800, 11200, 14000, 15000],
                        borderColor: '#4361ee',
                        backgroundColor: 'rgba(67, 97, 238, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            },
                            ticks: {
                                callback: function(value) {
                                    return '€' + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                salesChart.resize();
                
                // Auto-close sidebar when switching to desktop
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        });
        
        // Make sure chart resizes properly on load
        window.dispatchEvent(new Event('resize'));
    </script>
</body>
</html>
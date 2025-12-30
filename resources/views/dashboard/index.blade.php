<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BizManager - Gestion Commerciale</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">
    
</head>
<body class="bg-gray-50">
    <!-- Navigation et structure principale -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('partials.sidebar')
            
            <!-- Overlay pour mobile -->
            <div class="overlay"></div>
            
            <!-- Contenu principal -->
            <main class="main-content col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Barre de navigation supérieure -->
                <header class="d-flex flex-wrap justify-content-between align-items-center py-3 mb-4 border-bottom bg-white shadow-sm">
                    <div class="d-flex align-items-center">
                        <button id="sidebarToggle" class="btn btn-outline-secondary me-3 d-md-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h2 class="h5 mb-0 text-gray-800" id="pageTitle">Tableau de bord</h2>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-3">
                            <button class="btn btn-light dropdown-toggle" type="button" id="notificationsDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="badge bg-danger rounded-pill">3</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><a class="dropdown-item" href="#">Nouvelle commande #1234</a></li>
                                <li><a class="dropdown-item" href="#">Paiement reçu de Client XYZ</a></li>
                                <li><a class="dropdown-item" href="#">Stock faible pour Produit A</a></li>
                            </ul>
                        </div>
                        
                        <div class="input-group d-none d-md-flex" style="width: 300px;">
                            <input type="text" class="form-control" placeholder="Rechercher...">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="dropdown me-3">
                            <button class="btn btn-light dropdown-toggle" type="button" id="notificationsDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i>
                                <span class="badge bg-success rounded-pill">{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{route('profile.edit')}}">{{ __('Mon profil') }}</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Deconnexion') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
                
                <!-- Contenu dynamique -->
                <div id="contentArea">
                    <!-- Section Tableau de bord (par défaut) -->
                    <section id="dashboard" class="content-section active">
                        <div class="row mb-4">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="stat-card bg-white p-4 shadow-sm border-start border-primary border-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted mb-1">Chiffre d'affaires</p>
                                            <h3 class="fw-bold">€12,540</h3>
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
                                            <h3 class="fw-bold">48</h3>
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
                                            <h3 class="fw-bold">124</h3>
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
                                            <h3 class="fw-bold">76</h3>
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
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-8 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-white">
                                        <h5 class="mb-0">Top produits</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                                <div>
                                                    <h6 class="mb-1">Smartphone X</h6>
                                                    <small class="text-muted">Électronique</small>
                                                </div>
                                                <span class="badge bg-primary rounded-pill">24 ventes</span>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                                <div>
                                                    <h6 class="mb-1">Chaise ergonomique</h6>
                                                    <small class="text-muted">Bureau</small>
                                                </div>
                                                <span class="badge bg-primary rounded-pill">18 ventes</span>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                                <div>
                                                    <h6 class="mb-1">Livre "Business"</h6>
                                                    <small class="text-muted">Éducation</small>
                                                </div>
                                                <span class="badge bg-primary rounded-pill">15 ventes</span>
                                            </div>
                                            <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                                <div>
                                                    <h6 class="mb-1">Cafetière premium</h6>
                                                    <small class="text-muted">Cuisine</small>
                                                </div>
                                                <span class="badge bg-primary rounded-pill">12 ventes</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Ventes mensuelles</h5>
                                        <select class="form-select form-select-sm w-auto">
                                            <option>2023</option>
                                            <option>2022</option>
                                            <option>2021</option>
                                        </select>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="salesChart" height="250"></canvas>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Dernières commandes</h5>
                                        <a href="#" class="btn btn-sm btn-primary">Voir tout</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
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
                                                        <td>#ORD-001</td>
                                                        <td>Marie Dubois</td>
                                                        <td>15/05/2023</td>
                                                        <td>€450</td>
                                                        <td><span class="badge bg-success">Payé</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>#ORD-002</td>
                                                        <td>Jean Martin</td>
                                                        <td>14/05/2023</td>
                                                        <td>€890</td>
                                                        <td><span class="badge bg-warning">En attente</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>#ORD-003</td>
                                                        <td>Sophie Bernard</td>
                                                        <td>13/05/2023</td>
                                                        <td>€320</td>
                                                        <td><span class="badge bg-success">Payé</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary">
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
                        </div>
                    </section>
                    
                    <!-- Inventaire Start -->
                        <!-- Section Fournisseur -->
                        <section id="fournisseurs" class="content-section d-none">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0">Gestion des fournisseur</h3>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Nouveau fournisseur
                                </button>
                            </div>
                            
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p class="text-muted mb-4">Ici, vous pourriez gérer vos fournisseur, ajouter de nouveaux clients, modifier leurs informations, etc.</p>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        <!-- Section Produits -->
                        <section id="products" class="content-section d-none">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0">Gestion des produits</h3>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Nouveau produit
                                </button>
                            </div>
                            
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p class="text-muted mb-4">Cette section permettra de gérer votre catalogue de produits, les stocks, les prix, etc.</p>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Section Stock -->
                        <section id="stock" class="content-section d-none">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0">Gestion de Stock</h3>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Nouveau stock
                                </button>
                            </div>
                            
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p class="text-muted mb-4">Ici, vous pourriez gérer vos stock, ajouter de nouveaux stocks, modifier leurs informations, etc.</p>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                    </div>
                                </div>
                            </div>
                        </section>
                    <!-- Inventaire End -->

                    <!-- Commercial Start -->
                        <!-- Section Ventes -->
                        <section id="ventes" class="content-section d-none">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0">Gestion des ventes</h3>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Nouvelle vente
                                </button>
                            </div>
                            
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p class="text-muted mb-4">Gérez ici toutes les commandes de vos clients, suivez leur statut et traitez les paiements.</p>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Section Devis -->
                        <section id="devis" class="content-section d-none">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0">Gestion des devis</h3>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Nouveau devis
                                </button>
                            </div>
                            
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p class="text-muted mb-4">Ici, vous pourriez gérer vos devis, ajouter de nouveaux devis, modifier leurs informations, etc.</p>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        <!-- Section Clients -->
                        <section id="clients" class="content-section d-none">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0">Gestion des clients</h3>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Nouveau client
                                </button>
                            </div>
                            
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p class="text-muted mb-4">Ici, vous pourriez gérer vos clients, ajouter de nouveaux clients, modifier leurs informations, etc.</p>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                    </div>
                                </div>
                            </div>
                        </section>
                    <!-- Commercial End -->

                    <!-- Finance Start -->
                        <!-- Section Depenses -->
                        <section id="depenses" class="content-section d-none">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0">Gestion des depenses</h3>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Nouveau commande
                                </button>
                            </div>
                            
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p class="text-muted mb-4">Gérez ici toutes les commandes de vos clients, suivez leur statut et traitez les paiements.</p>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Section Recettes -->
                        <section id="recettes" class="content-section d-none">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0">Gestion des recettes</h3>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Nouvelle recette
                                </button>
                            </div>
                            
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p class="text-muted mb-4">Gérez ici toutes les commandes de vos clients, suivez leur statut et traitez les paiements.</p>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Section Paiements -->
                        <section id="paiements" class="content-section d-none">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0">Gestion des paiements</h3>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Nouveau paiement
                                </button>
                            </div>
                            
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <p class="text-muted mb-4">Gérez ici toutes les commandes de vos clients, suivez leur statut et traitez les paiements.</p>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                    </div>
                                </div>
                            </div>
                        </section>

                    <!-- Finance End -->
                    
                    <!-- Section Factures -->
                    <section id="invoices" class="content-section d-none">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="mb-0">Gestion des factures</h3>
                            <button class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Nouvelle facture
                            </button>
                        </div>
                        
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p class="text-muted mb-4">Créez, gérez et suivez les factures pour vos clients dans cette section.</p>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Section Rapports -->
                    <section id="reports" class="content-section d-none">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="mb-0">Rapports et analyses</h3>
                            <button class="btn btn-primary">
                                <i class="fas fa-download me-1"></i> Exporter
                            </button>
                        </div>
                        
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p class="text-muted mb-4">Accédez à des rapports détaillés sur vos ventes, performances et indicateurs clés.</p>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Section Paramètres -->
                    <section id="settings" class="content-section d-none">
                        <h3 class="mb-4">Paramètres de l'application</h3>
                        
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p class="text-muted mb-4">Configurez les paramètres de votre application de gestion commerciale.</p>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Cette section est en cours de développement. Le contenu complet sera ajouté prochainement.
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                
                <!-- Pied de page -->
                <footer class="mt-5 pt-4 border-top">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-muted">© 2023 BizManager. Application de gestion commerciale.</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p class="text-muted">Version 1.0.0</p>
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </div>
    <!-- Scripts JS -->
    <script src="{{asset('asset/main.js')}}"></script>
    
    <!-- Bootstrap JS avec Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
   
</body>
</html>
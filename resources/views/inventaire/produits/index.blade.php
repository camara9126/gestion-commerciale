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

                        @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @elseif(Session::has('danger'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('danger') }}
                            </div>
                        @endif
                        <!-- Section Produits -->
                         <div class="d-flex justify-content-between align-items-center mb-4">                          
                            <h3 class="mb-0">Produits</h3>
                            <a href="{{route('produits.create')}}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Nouveau produit
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
                    </section>

                </div>
            </main>
        </div>
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
    <!--<script src="{{asset('asset/main.js')}}"></script>-->
    <!-- Bootstrap JS avec Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
   
</body>
</html>
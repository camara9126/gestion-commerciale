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
                       @include('partials.data')

                        <div class="d-flex justify-content-between align-items-center mb-4">                          
                            <h3 class="mb-0">Produits</h3>
                            <a href="{{route('produits.index')}}" class="btn btn-danger">
                                <i class="fas fa-bar me-1"></i> Retour
                            </a>
                        </div>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div style="color: red; margin-bottom: 10px;">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                    <form method="post" action="{{route('produits.store')}}" class="contact-form">
                                        @csrf
                                        <h2 class="text-center mb-4">Nouveau produit</h2>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nom produit</label>
                                                    <input type="text" class="form-control" name="nom" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="stock_min" class="form-label">Stock Minimum</label>
                                                    <input type="number" class="form-control" name="stock_min" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 d-center">
                                                <label for="fournisseur" class="form-label">Fournisseur</label>
                                                <select class="form-select" name="fournisseur_id" id="type_maison">
                                                    <option value="">-- Fournisseur --</option>
                                                    @foreach($fournisseurs as $f)
                                                    <option value="{{$f->id}}">{{$f->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="prix achat" class="form-label">Prix d'achat</label>
                                                    <input type="text" class="form-control" name="prix_achat" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="prix de vente" class="form-label">Prix de vente</label>
                                                    <input type="text" class="form-control" name="prix_vente" >
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">Enregister</button>
                                        </div>
                                    </form>
                                

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
    <!-- Bootstrap JS avec Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
   
</body>
</html>
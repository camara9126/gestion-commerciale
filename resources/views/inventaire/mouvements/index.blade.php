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
                        <div class="user-profile me-2">AD</div>
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
            
                <!--<div class="row">
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
                </div>-->
                <!-- Historiques Mouvements -->

                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @elseif(Session::has('danger'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('danger') }}
                    </div>
                @endif

                <div class="row mb-4">
                    <h5 class="mb-4">Historique des mouvements</h5>
                        <div class="col-lg-6">
                             
                            <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#entreeModal">
                                + Nouveau mouvement entree
                            </button>

                            <!-- Liste mouvement entree-->
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
                                                <td>{{$m->created_at->format('j / F / Y')}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                             <!-- Modal Nouveau mouvement entree-->
                            <div class="modal fade" id="entreeModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="post" action="{{route('stock.entree')}}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Mouvement Entree</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Produit</label>
                                                    <select class="form-control" name="produit_id" id="exampleFormControlSelect1">
                                                        <option value="">-- Veuillez choisir un produit --</option>
                                                        @foreach($produits as $p)
                                                        <option value="{{$p->id}}">{{$p->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Quantite</label>
                                                    <input type="number" name="quantite" min="1" class="form-control" id="exampleInputquantity1">
                                                </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-lg-6">
                            <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#sortieModal">
                                + Nouveau mouvement sortie
                            </button>
                        
                            <!-- Liste mouvement sortie-->
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
                                                <td>{{$m->created_at->format('j / F / Y')}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            
                            <!-- Modal Nouveau mouvement sortie-->
                            <div class="modal fade" id="sortieModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="post" action="{{route('stock.sortie')}}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Mouvement Sortie</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Produit</label>
                                                    <select class="form-control" name="produit_id" id="exampleFormControlSelect1">
                                                        <option value="">-- Veuillez choisir un produit --</option>
                                                        @foreach($produits as $p)
                                                        <option value="{{$p->id}}">{{$p->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Quantite</label>
                                                    <input type="number" name="quantite" min="1" class="form-control" id="exampleInputquantity1">
                                                </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                    
                </div>
            </section>


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
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
   <script src="{{asset('asset/main.js')}}"></script>
</body>
</html>
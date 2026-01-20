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

                <div class="d-flex justify-content-between align-items-center mb-4">                          
                    <h3 class="mb-0">Nouvelle vente</h3>
                    <a href="{{route('ventes.index')}}" class="btn btn-danger">
                        <i class="fas fa-bar me-1"></i> Annuler
                    </a>
                </div>
                <div class="row justify-content-center">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @elseif(Session::has('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('danger') }}
                        </div>
                    @endif
                    <div class="col-8">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div style="color: red; margin-bottom: 10px;">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                <h2>Nouvelle vente</h2>

                                <form action="{{ route('ventes.store') }}" method="POST" class="contact-form">
                                    @csrf
                                    {{-- CLIENT --}}
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Client</label><br>
                                                <select name="client_id" class="form-select" required>
                                                    <option value="">-- Sélectionner un client --</option>
                                                    @foreach($clients as $client)
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->nom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>                                
                                        </div>
                                        <div class="col-4 mt-4">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#clientModal">
                                                + Nouveau client
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-8">
                                            <label for="total" class="form-label">TVA</label>
                                            <input type="text" name="produits[0][tva]" class="form-control" required >
                                        </div>
                                    </div>
                                    <hr>

                                    {{-- PRODUITS --}}
                                    <h4>Produits</h4>

                                    <table border="1" cellpadding="8" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Quantité</th>
                                                <th>Prix (XOF)</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            {{-- PRODUIT --}}
                                            <tr>
                                                <td>
                                                    <select name="produits[0][produit_id]" class="form-select" required>
                                                        <option value="">-- Choisir --</option>
                                                        @foreach($produits as $produit)
                                                            <option value="{{ $produit->id }}">
                                                                {{ $produit->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="produits[0][quantite]" class="form-control" min="1" value="1" required>
                                                </td>

                                                <td>
                                                    <input type="number" name="produits[0][prix]" class="form-control" min="0" required>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Enregistrer la vente
                                    </button>
                                </form>
                               
                                <!-- Nouveau client -->
                                <div class="modal fade" id="clientModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form method="post" action="{{route('clients.ajax.store')}}">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Nouveau client</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Nom du client</label>
                                                        <input type="text" name="nom" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Téléphone</label>
                                                        <input type="text" name="telephone" class="form-control">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control">
                                                    </div>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
   
   <script src="{{asset('asset/main.js')}}"></script>
</body>
</html>
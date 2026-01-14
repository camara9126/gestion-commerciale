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
                <!-- Stats Row -->
                
                <!-- Recent Orders -->
                <div class="row">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @elseif(Session::has('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('danger') }}
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-3">

                        <!-- Section Produits -->
                        <h3 class="mb-0">Depenses</h3>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#depenseModal">
                            Enregister
                        </button>
                        </div>
                        <div class="stat-card">        
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="stat-card">
                                        <div class="table-responsive">
                                            <!--<nav class="navbar navbar-light bg-light">-->
                                                <form method="get" action="{{route('clients.search')}}" class="form-inline">
                                                   
                                                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher par nom client.." aria-label="Search">                                                            
                                                
                                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>                                                    
                                                       
                                                </form>
                                            <!--</nav>-->
                                            <table class="table data-table">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Libelle</th>
                                                        <th>Categorie</th>
                                                        <th>Montant</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($depenses as $d)
                                                    <tr>
                                                        <td>{{$d->date_depense}}</td>
                                                        <td>{{$d->libelle}}</td>
                                                        <td>{{$d->categorie->nom}}</td>
                                                        <td>{{number_format($d->montant, 0, ',','')}} XOF</td>
                                                        <td>
                                                            <span class="badge bg-{{ $d->statut == 'payee' ? 'success' : 'danger' }}">
                                                                {{ ucfirst($d->statut) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="7" align="center">Donnee vide !</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>    
                                        </div>
                                        <div class="d-flex justify-content-center mt-4">
                                            {{$depenses->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal paiement -->
                        <div class="modal fade" id="depenseModal" tabindex="-1">
                            <div class="modal-dialog">
                               <form action="{{ route('depenses.store') }}" method="POST" class="contact-form">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Paiement</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">

                                                <!-- Libellé -->
                                                <div class="col-6 mb-3">
                                                    <label class="form-label">Libellé de la dépense</label>
                                                    <input type="text" name="libelle" class="form-control" placeholder="Ex : Achat marchandises" required>
                                                </div>

                                                <!-- Catégorie -->
                                                <div class="col-6 mb-3">
                                                    <label class="form-label">Catégorie</label>
                                                    <select name="categorie_depense_id" class="form-control">
                                                        <option value="">-- Sélectionner --</option>
                                                        @foreach($categories as $categorie)
                                                            <option value="{{ $categorie->id }}">
                                                                {{ $categorie->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Montant -->
                                                <div class="col-6 mb-3">
                                                    <label class="form-label">Montant (FCFA)</label>
                                                    <input type="number" name="montant" class="form-control" step="0.01" required>
                                                </div>

                                                <!-- Date -->
                                                <div class="col-6 mb-3">
                                                    <label class="form-label">Date de la dépense</label>
                                                    <input type="date" name="date_depense" class="form-control" value="{{ date('Y-m-d') }}" required>
                                                </div>

                                                <!-- Mode de paiement -->
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">Mode de paiement</label>
                                                    <select name="mode_paiement" class="form-control" required>
                                                        <option value="">-- Choisir --</option>
                                                        <option value="cash">Cash</option>
                                                        <option value="mobile_money">Mobile Money</option>
                                                        <option value="virement">Virement</option>
                                                        <option value="cheque">Chèque</option>
                                                    </select>
                                                </div>

                                                <!-- Description -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Description (optionnelle)</label>
                                                    <textarea name="description" class="form-control" rows="3" placeholder="Détails supplémentaires..."></textarea>
                                                </div>

                                            </div>
                                            <!-- Bouton -->
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">
                                                    💾 Enregistrer la dépense
                                                </button>
                                            </div>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
   <script src="{{asset('asset/main.js')}}"></script>
</body>
</html>
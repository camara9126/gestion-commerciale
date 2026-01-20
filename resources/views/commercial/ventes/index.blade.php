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
            <section id="" class="content-section">
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
                        <h3 class="mb-0">Commandes</h3>
                        <a href="{{route('ventes.create')}}" class="btn btn-success">
                            <i class="fas fa-plus me-1"></i> Nouveau commande
                        </a>
                        </div>
                        <div class="stat-card">        
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div style="color: red; margin-bottom: 10px;">
                                            @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="table-responsive">
                                        <!--<nav class="navbar navbar-light bg-light">-->
                                            <form method="get" action="{{route('ventes.search')}}" class="form-inline">
                                               
                                                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher par reference ou client..." aria-label="Search">                                                            
                                            
                                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>                                                    
                                            
                                            </form>
                                        <!--</nav>-->
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Reference</th>
                                                    <th>Client</th>
                                                    <th>Total TTC</th>
                                                    <th>Restant</th>
                                                    <th>Date</th>
                                                    <th>Statut</th>
                                                    <th>Actions</th>
                                                    <th>Facture</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($ventes as $v)
                                                <tr>
                                                    <td>{{$v->reference}}</td>
                                                    <td>{{$v->client->nom ?? 'Client supprimee'}}</td>
                                                    <td>{{number_format($v->total_ttc, 0, ',','')}} XOF</td>
                                                    <td>{{number_format($v->montant_restant, 0, ',','')}} XOF</td>
                                                    <td>{{$v->created_at->format('d/m/y')}}</td>
                                                    <td>
                                                        @if($v->statut == 'payee')
                                                            <span class="status-badge badge-paid">{{$v->statut}}</span>
                                                        @elseif($v->statut == 'partielle')
                                                            <span class="status-badge badge-pending">{{$v->statut}}</span>
                                                        @else
                                                            <span class="status-badge badge bg-danger">{{$v->statut}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-id="{{$v->id}}" data-bs-target="#paiementModal">
                                                            + Payee
                                                        </button>
                                                    </td>
                                                    @if($v->statut == 'payee')
                                                        <td>
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <a href="{{route('ventes.show', $v->id)}}">
                                                                            <i class="fa fa-eye text-primary"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <a href="{{route('ventes.facture', $v->id)}}">
                                                                            <i class="fas fa-file-invoice text-primary"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <marquee behavior="" direction="">Pas encore disponnible !</marquee>
                                                        </td>
                                                    @endif                                                                  
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
                                        {{$ventes->links()}}
                                    </div>
                                </div>                                                                    
                            </div>
                        </div>
                        <!-- Modal paiement -->
                        <div class="modal fade" id="paiementModal" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('paiements.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Paiement</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="vente_id" id="vente_id">

                                            <div class="mb-3">
                                                <label>Montant à payer</label>
                                                <input type="number" name="montant" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Mode de paiement</label>
                                                <select name="mode_paiement" class="form-select" required>
                                                    <option value="cash">Cash</option>
                                                    <option value="wave">Wave</option>
                                                    <option value="orange_money">Orange Money</option>
                                                    <option value="banque">Banque</option>
                                                </select>
                                            </div>

                                            <button class="btn btn-success">
                                                Enregistrer le paiement
                                            </button>
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

    <script>
        // Recuperation de l'ID de la vente
        document.addEventListener('DOMContentLoaded', function () {

            const modal = document.getElementById('paiementModal');

            modal.addEventListener('show.bs.modal', function (event) {

                const button = event.relatedTarget;

                const id = button.getAttribute('data-id');

                modal.querySelector('#vente_id').value = id;
            });
        });

        
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
   <script src="{{asset('asset/main.js')}}"></script>
</body>
</html>
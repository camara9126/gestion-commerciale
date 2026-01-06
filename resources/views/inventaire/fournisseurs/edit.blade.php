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
                    <h3 class="mb-0">Fournisseurs</h3>
                    <a href="{{route('fournisseurs.index')}}" class="btn btn-danger">
                        <i class="fas fa-bar me-1"></i> Annuler
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
                            <form method="post" action="{{route('fournisseurs.update', $fournisseur->id)}}" class="contact-form">
                                @csrf
                                <h2 class="text-center mb-4">Edit fournisseur ({{$fournisseur->statut ? 'Active' : 'Inactive'}})</h2>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" name="nom" value="{{$fournisseur->nom}}" >
                                </div>
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input type="text" class="form-control" name="telephone" value="{{$fournisseur->telephone}}" >
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$fournisseur->email}}" >
                                </div>
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <textarea class="form-control" name="adresse" rows="5" >{{$fournisseur->adresse}}</textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-warning btn-lg">Modifier</button>
                                </div>
                            </form>
                        

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
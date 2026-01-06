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
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f5f7fb;
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%);
            color: white;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 3px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
            min-height: 100vh;
        }
        
        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        
        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        /* Top Bar */
        .top-bar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        /* User Profile */
        .user-profile {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, #4361ee, #3a0ca3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                margin-left: -250px;
            }
            
            .sidebar.active {
                margin-left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .top-bar {
                padding: 15px;
            }
        }
        
        @media (max-width: 768px) {
            .stat-card .value {
                font-size: 1.5rem;
            }
            
            .table-responsive {
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 576px) {
            .top-bar h2 {
                font-size: 1.2rem;
            }
            
            .stat-card {
                padding: 15px;
            }
            
            .stat-card .icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }
        }
        
        /* Mobile Menu Button */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #4361ee;
            margin-right: 15px;
        }
        
        @media (max-width: 992px) {
            .menu-toggle {
                display: block;
            }
        }
        
        /* Overlay for mobile */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        .overlay.active {
            display: block;
        }
        
        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        /* Table Styles */
        .data-table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        
        .data-table th {
            background: #f8f9fa;
            border: none;
            padding: 15px;
            font-weight: 600;
            color: #495057;
        }
        
        .data-table td {
            padding: 15px;
            border-top: 1px solid #e9ecef;
            vertical-align: middle;
        }
        
        /* Badge Styles */
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .badge-paid {
            background: #d4edda;
            color: #155724;
        }
        
        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .badge-canceled {
            background: #f8d7da;
            color: #721c24;
        }
        
        /* Button Styles */
        .btn-action {
            width: 35px;
            height: 35px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        
        /* Footer */
        .footer {
            background: white;
            padding: 20px 0;
            margin-top: 40px;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3 class="mb-0">
                <i class="fas fa-chart-line text-primary me-2"></i>
                <span class="fw-bold">BizManager</span>
            </h3>
            <small class="text-muted">Gestion Commerciale</small>
        </div>
        
        <div class="px-3 py-4">
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link active" data-section="dashboard">
                        <i class="fas fa-home"></i> Tableau de bord
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="clients">
                        <i class="fas fa-users"></i> Clients
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="products">
                        <i class="fas fa-box"></i> Produits
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="orders">
                        <i class="fas fa-shopping-cart"></i> Commandes
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="invoices">
                        <i class="fas fa-file-invoice"></i> Factures
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="reports">
                        <i class="fas fa-chart-bar"></i> Rapports
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="settings">
                        <i class="fas fa-cog"></i> Paramètres
                    </a>
                </li>
            </ul>
            
            <div class="mt-5 pt-4 border-top border-secondary">
                <div class="d-flex align-items-center">
                    <div class="user-profile me-3">AD</div>
                    <div>
                        <p class="mb-0 fw-bold">Admin User</p>
                        <small class="text-muted">Administrateur</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Mon profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="container-fluid p-3 p-md-4" id="contentArea">
            <!-- Dashboard Section -->
            <section id="dashboard" class="content-section">
                <!-- Stats Row -->
                <div class="row g-3 mb-4">
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Chiffre d'affaires</p>
                                    <h3 class="value fw-bold">€12,540</h3>
                                    <small class="text-success">
                                        <i class="fas fa-arrow-up me-1"></i> 12.5% vs mois dernier
                                    </small>
                                </div>
                                <div class="icon bg-primary bg-opacity-10 text-primary">
                                    <i class="fas fa-euro-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Commandes</p>
                                    <h3 class="value fw-bold">48</h3>
                                    <small class="text-success">
                                        <i class="fas fa-arrow-up me-1"></i> 8.2% vs mois dernier
                                    </small>
                                </div>
                                <div class="icon bg-success bg-opacity-10 text-success">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Clients</p>
                                    <h3 class="value fw-bold">124</h3>
                                    <small class="text-success">
                                        <i class="fas fa-arrow-up me-1"></i> 5.3% vs mois dernier
                                    </small>
                                </div>
                                <div class="icon bg-warning bg-opacity-10 text-warning">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted mb-1">Produits</p>
                                    <h3 class="value fw-bold">76</h3>
                                    <small class="text-danger">
                                        <i class="fas fa-arrow-down me-1"></i> 2.1% stock faible
                                    </small>
                                </div>
                                <div class="icon bg-info bg-opacity-10 text-info">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Row -->
                <div class="row g-3 mb-4">
                    <div class="col-xl-8">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Ventes mensuelles</h5>
                                <select class="form-select form-select-sm w-auto">
                                    <option>2023</option>
                                    <option>2022</option>
                                    <option>2021</option>
                                </select>
                            </div>
                            <div class="chart-container">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-4">
                        <div class="stat-card">
                            <h5 class="mb-3">Top produits</h5>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Smartphone X</h6>
                                            <small class="text-muted">Électronique</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">24</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 text-success rounded p-2 me-3">
                                            <i class="fas fa-chair"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Chaise ergonomique</h6>
                                            <small class="text-muted">Bureau</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">18</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-10 text-warning rounded p-2 me-3">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Livre "Business"</h6>
                                            <small class="text-muted">Éducation</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">15</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 text-info rounded p-2 me-3">
                                            <i class="fas fa-coffee"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Cafetière premium</h6>
                                            <small class="text-muted">Cuisine</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">12</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
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
            
            <!-- Other Sections (Hidden by default) -->
            <section id="clients" class="content-section d-none">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3>Gestion des clients</h3>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Nouveau client
                        </button>
                    </div>
                    <p class="text-muted">Cette section permet de gérer vos clients, ajouter de nouveaux clients, modifier leurs informations, etc.</p>
                </div>
            </section>
            
            <section id="products" class="content-section d-none">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3>Gestion des produits</h3>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Nouveau produit
                        </button>
                    </div>
                    <p class="text-muted">Cette section permet de gérer votre catalogue de produits, les stocks, les prix, etc.</p>
                </div>
            </section>
            
            <section id="orders" class="content-section d-none">
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
                        <p class="mb-0 text-muted">© 2023 BizManager. Tous droits réservés.</p>
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


<!--<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>-->

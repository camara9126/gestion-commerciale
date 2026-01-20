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

        /* rapport */
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e1e5eb;
        }

        h1 {
            color: #2c3e50;
            font-size: 28px;
        }

        .period-selector {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .period-selector select {
            padding: 8px 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
            background-color: white;
            font-weight: 500;
        }

        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }

        .orders .stat-icon {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .revenue .stat-icon {
            background-color: #e8f5e9;
            color: #388e3c;
        }

        .products .stat-icon {
            background-color: #fff3e0;
            color: #f57c00;
        }

        .customers .stat-icon {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }

        .stat-info h3 {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-change {
            font-size: 13px;
        }

        .positive {
            color: #27ae60;
        }

        .negative {
            color: #e74c3c;
        }

        .charts-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }

        @media (max-width: 1100px) {
            .charts-container {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-header h2 {
            font-size: 18px;
            color: #2c3e50;
        }

        .chart-wrapper {
            position: relative;
            height: 300px;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e1e5eb;
            color: #7f8c8d;
            font-size: 14px;
        }

        .export-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        .btn-secondary:hover {
            background-color: #d5dbdb;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    @include('partials.Sidebar')
    
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
                <div class="dashboard-container">
                    <header>
                        <h1>Tableau de Bord Mensuel</h1>
                        <div class="period-selector">
                            <select id="monthSelect">
                                <option value="0">Janvier</option>
                                <option value="1">Février</option>
                                <option value="2">Mars</option>
                                <option value="3">Avril</option>
                                <option value="4">Mai</option>
                                <option value="5">Juin</option>
                                <option value="6">Juillet</option>
                                <option value="7">Août</option>
                                <option value="8" selected>Septembre</option>
                                <option value="9">Octobre</option>
                                <option value="10">Novembre</option>
                                <option value="11">Décembre</option>
                            </select>
                            <select id="yearSelect">
                                <option>2022</option>
                                <option>2023</option>
                                <option selected>2024</option>
                            </select>
                            <div class="export-buttons">
                                <button class="btn btn-secondary" onclick="exportData('png')">Export PNG</button>
                                <button class="btn btn-primary" onclick="exportData('pdf')">Export PDF</button>
                            </div>
                        </div>
                    </header>

                    <div class="stats-summary">
                        <div class="stat-card orders">
                            <div class="stat-icon">
                                <span>📦</span>
                            </div>
                            <div class="stat-info">
                                <h3>Commandes</h3>
                                <div class="stat-value">1,247</div>
                                <div class="stat-change positive">↑ 12.5% vs mois dernier</div>
                            </div>
                        </div>

                        <div class="stat-card revenue">
                            <div class="stat-icon">
                                <span>💰</span>
                            </div>
                            <div class="stat-info">
                                <h3>Chiffre d'Affaires</h3>
                                <div class="stat-value">€45,820</div>
                                <div class="stat-change positive">↑ 8.3% vs mois dernier</div>
                            </div>
                        </div>

                        <div class="stat-card products">
                            <div class="stat-icon">
                                <span>📊</span>
                            </div>
                            <div class="stat-info">
                                <h3>Produits Vendus</h3>
                                <div class="stat-value">3,458</div>
                                <div class="stat-change positive">↑ 5.7% vs mois dernier</div>
                            </div>
                        </div>

                        <div class="stat-card customers">
                            <div class="stat-icon">
                                <span>👥</span>
                            </div>
                            <div class="stat-info">
                                <h3>Nouveaux Clients</h3>
                                <div class="stat-value">187</div>
                                <div class="stat-change negative">↓ 2.1% vs mois dernier</div>
                            </div>
                        </div>
                    </div>

                    <div class="charts-container">
                        <div class="chart-card">
                            <div class="chart-header">
                                <h2>Commandes Mensuelles</h2>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="ordersChart"></canvas>
                            </div>
                        </div>

                        <div class="chart-card">
                            <div class="chart-header">
                                <h2>Chiffre d'Affaires Mensuel</h2>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>

                        <div class="chart-card">
                            <div class="chart-header">
                                <h2>Top Produits du Mois</h2>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="productsChart"></canvas>
                            </div>
                        </div>

                        <div class="chart-card">
                            <div class="chart-header">
                                <h2>Statut des Commandes</h2>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="statusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
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
    
    <!-- Donnees du rappord -->
    <!--<script>
        const commandesLabels = @json($commandesParMois->keys());
        const commandesData = @json($commandesParMois->values());

        const caLabels = @json($caParMois->keys());
        const caData = @json($caParMois->values());

        const topProduitsLabels = @json($topProduits->pluck('produit.nom'));
        const topProduitsData = @json($topProduits->pluck('total'));

        const statutLabels = @json($statuts->keys());
        const statutData = @json($statuts->values());
    </script>-->


    <script>
        // Données pour les graphiques
        const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
        const currentMonthIndex = 8; // Septembre (0-indexed)

        // Graphique des commandes
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ordersCtx, {
            type: 'line',
            data: {
                labels: ['1', '5', '10', '15', '20', '25', '30'],
                datasets: [{
                    label: 'Commandes',
                    data: [45, 52, 48, 65, 70, 75, 82],
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
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
                        title: {
                            display: true,
                            text: 'Nombre de commandes'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Jours du mois'
                        }
                    }
                }
            }
        });

        // Graphique du chiffre d'affaires
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep'],
                datasets: [{
                    label: 'Chiffre d\'affaires (k€)',
                    data: [32, 28, 35, 40, 38, 42, 45, 44, 45.8],
                    backgroundColor: [
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(41, 128, 185, 0.9)'
                    ],
                    borderColor: [
                        'rgb(46, 204, 113)',
                        'rgb(46, 204, 113)',
                        'rgb(46, 204, 113)',
                        'rgb(46, 204, 113)',
                        'rgb(46, 204, 113)',
                        'rgb(46, 204, 113)',
                        'rgb(46, 204, 113)',
                        'rgb(46, 204, 113)',
                        'rgb(41, 128, 185)'
                    ],
                    borderWidth: 1
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
                        title: {
                            display: true,
                            text: 'Chiffre d\'affaires (k€)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Mois'
                        }
                    }
                }
            }
        });

        // Graphique des produits
        const productsCtx = document.getElementById('productsChart').getContext('2d');
        const productsChart = new Chart(productsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Produit A', 'Produit B', 'Produit C', 'Produit D', 'Autres'],
                datasets: [{
                    data: [35, 25, 20, 12, 8],
                    backgroundColor: [
                        '#3498db',
                        '#2ecc71',
                        '#e74c3c',
                        '#f39c12',
                        '#95a5a6'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw}%`;
                            }
                        }
                    }
                }
            }
        });

        // Graphique des statuts de commande
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'polarArea',
            data: {
                labels: ['Livrées', 'En cours', 'En attente', 'Annulées'],
                datasets: [{
                    data: [75, 15, 8, 2],
                    backgroundColor: [
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(52, 152, 219, 0.7)',
                        'rgba(241, 196, 15, 0.7)',
                        'rgba(231, 76, 60, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                },
                scales: {
                    r: {
                        ticks: {
                            display: false
                        }
                    }
                }
            }
        });

        // Gestion du changement de mois/année
        document.getElementById('monthSelect').addEventListener('change', function() {
            updateDashboard(this.value, document.getElementById('yearSelect').value);
        });

        document.getElementById('yearSelect').addEventListener('change', function() {
            updateDashboard(document.getElementById('monthSelect').value, this.value);
        });

        function updateDashboard(month, year) {
            const monthName = months[parseInt(month)];
            document.querySelector('footer p').textContent = `Tableau de bord mis à jour en temps réel | Données du mois de ${monthName} ${year}`;
            
            // Simulation de mise à jour des données
            alert(`Mise à jour des données pour ${monthName} ${year}... (simulation)`);
        }

        // Fonction d'export
        function exportData(format) {
            if (format === 'png') {
                alert('Export des graphiques au format PNG (simulation)');
            } else if (format === 'pdf') {
                alert('Génération du rapport PDF (simulation)');
            }
        }

        // Sélectionner le mois actuel dans le sélecteur
        document.getElementById('monthSelect').value = currentMonthIndex;
    </script>


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
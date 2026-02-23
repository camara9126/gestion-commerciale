<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>B-Manager - Gestion Commerciale</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">

     <!-- Icon Image -->
     <link rel="shortcut icon" href="{{asset('asset/logo/Logo B.Manager.png')}}"/>
    
    <style>    
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #3b82f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
        }
        
        /* Section abonnement */
        .subscription-section {
            margin-bottom: 40px;
        }
        
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .section-title h2 {
            color: #1e293b;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title h2 i {
            color: #00778b;
        }
        
        .manage-btn {
            background-color: #f1f5f9;
            color: #475569;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .manage-btn:hover {
            background-color: #e2e8f0;
        }
        
        /* Carte d'abonnement */
        .subscription-card {
            background: linear-gradient(135deg, #ff9d1b 0%, #00778b 50%);
            border-radius: 16px;
            padding: 30px;
            color: white;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .subscription-card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .subscription-card::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: 20px;
            width: 100px;
            height: 100px;
            background-color: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }
        
        .subscription-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }
        
        .subscription-title h3 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .subscription-title p {
            opacity: 0.9;
            font-size: 15px;
        }
        
        .subscription-badge {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .subscription-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            position: relative;
            z-index: 1;
            margin-bottom: 30px;
        }
        
        .detail-item h4 {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .detail-value {
            font-size: 20px;
            font-weight: 700;
        }
        
        .subscription-actions {
            display: flex;
            gap: 15px;
            position: relative;
            z-index: 1;
        }
        
        .action-btn {
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .primary-btn {
            background-color: white;
            color: #00778b;
        }
        
        .primary-btn:hover {
            background-color: #f8fafc;
            transform: translateY(-2px);
        }
        
        .secondary-btn {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(10px);
        }
        
        .secondary-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        
        /* Section des packs disponibles */
        .available-packs {
            margin-top: 40px;
             position: relative;
        }
        
        .packs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .pack-card {
            background-color: white;
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .pack-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }
        
        .pack-card.recommended {
            border: 2px solid #00778b;
            position: relative;
        }
        
        .recommended-badge {
            position: absolute;
            top: -12px;
            right: 20px;
            background-color: #00778b;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        
        .pack-header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .pack-name {
            font-size: 20px;
            color: #1e293b;
            margin-bottom: 5px;
        }
        
        .pack-price {
            font-size: 28px;
            font-weight: 700;
            color: #00778b;
            margin-bottom: 5px;
        }
        
        .pack-period {
            color: #64748b;
            font-size: 14px;
        }
        
        .pack-features {
            list-style: none;
            margin-bottom: 25px;
        }
        
        .pack-features li {
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .pack-features li i {
            color: #10b981;
            font-size: 14px;
        }
        
        .pack-btn {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #f1f5f9;
            color: #475569;
        }
        
        .pack-btn:hover {
            background-color: #e2e8f0;
        }
        
        .pack-card.recommended .pack-btn {
            background-color: #00778b;
            color: white;
        }
        
        .pack-card.recommended .pack-btn:hover {
            background-color: #00778b;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            .subscription-details {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .subscription-actions {
                flex-direction: column;
            }
            
            .packs-grid {
                grid-template-columns: 1fr;
            }
            
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
        
        
    </style>
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
                <h2 class="h4 mb-0" id="pageTitle">Bienvenue</h2>
            </div>
            
            <div class="d-flex align-items-center">
                <!-- Search Bar - Hidden on mobile -->
                <div class="d-none d-md-block me-3">
                    @if(auth()->user()->entreprise->isOnTrial())
                        <div class="alert alert-info">
                            🎉 Essai gratuit actif – expire le {{ auth()->user()->entreprise->trial_fin }}
                        </div>
                    @endif

                    @if(auth()->user()->entreprise->trialExpire())
                        <div class="alert alert-danger">
                            ⛔ Essai expiré – veuillez activer un abonnement
                        </div>
                    @endif

                    <!-- Abonnement jour restant <= 5 jours-->
                    @if(auth()->user()->entreprise->abonnementExpireBientot())
                    <div class="alert alert-warning">
                        ⚠️ Votre abonnement expire dans
                        <strong>{{ auth()->user()->entreprise->joursRestantsAbonnement() }}</strong> jours.
                        <a href="{{ route('abonnement.payer') }}" class="bg-info">Renouveler maintenant</a>
                    </div>
                    @endif
                </div>
                
                <!-- Notifications -->
                <div class="dropdown me-3">
                    <button class="btn btn-light dropdown-toggle" type="button" id="notificationsDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                @if(auth()->user()->entreprise->isOnTrial()  || auth()->user()->entreprise->trialExpire())
                                    <span class="badge bg-danger rounded-pill">
                                        1
                                    </span>
                                @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <!--<li><h6 class="dropdown-header">Notifications</h6></li>-->
                        @if(auth()->user()->entreprise->isOnTrial())
                        <li>
                            <a class="dropdown-item alert alert-info" href="#">🎉 Essai gratuit actif – expire le {{ auth()->user()->entreprise->trial_fin }}
                            </a>
                        </li>
                        @endif
                        <!--<li><a class="dropdown-item" href="#">Paiement reçu de Client XYZ</a></li>-->
                         @if(auth()->user()->entreprise->trialExpire())
                            <li>
                                <a class="dropdown-item alert alert-danger" href="#" >⛔ Essai expiré – veuillez activer un abonnement
                                </a>
                            </li>
                        @endif
                            <li>
                                @if(auth()->user()->entreprise->abonnementExpireBientot())
                                    ⚠️ Votre abonnement expire dans
                                    <strong>{{ auth()->user()->entreprise->joursRestantsAbonnement() }}</strong> jours.
                                    <a href="{{ route('abonnement.payer') }}" class="bg-info">Renouveler maintenant</a>
                                @endif
                            </li>
                    </ul>
                    
                </div>
                
                <!-- Mobile Search Button 
                <button class="btn btn-light d-md-none me-2" id="mobileSearchBtn">
                    <i class="fas fa-search"></i>
                </button>-->
                
                <!-- User Menu -->
                <div class="dropdown">
                    <button class="btn btn-light d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                        <!--<span class="badge bg-success">{{strtoupper(Auth::user()->name[0]) }}</span>-->
                        <i class="fas fa-user-check text-success me-2"></i>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Mon profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.abonnement') }}"><i class="fas fa-box-open me-2"></i> Abonnement</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('parametre') }}"><i class="fas fa-tools me-2"></i> Assistance</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                        @csrf    
                                <a class="dropdown-item" href="{{route('logout')}}"onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="container-fluid p-3 p-md-4" id="contentArea">

            <!-- Dashboard Section -->
            <section id="dashboard" class="content-section">
                <!-- Stats Row -->
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @elseif(Session::has('danger'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('danger') }}
                    </div>
                @endif        

                <!-- Section Abonnement -->
                <div class="subscription-section">
                    <div class="section-title">
                        <h2><i class="fas fa-crown"></i> Mon Abonnement</h2>
                         @if(auth()->user()->entreprise->abonnementActif())
                            <a href="{{route('abonnement.payer')}}" class="manage-btn">
                                <i class="fa-solid fa-bag-shopping text-success"></i>Payer l'abonnement
                            </a>
                        @endif
                    </div>
                    
                    <!-- Carte d'abonnement actuel -->
                    <div class="subscription-card">
                        <div class="subscription-header">
                            <div class="subscription-title">
                                <h3>PACK {{strtoupper(auth()->user()->entreprise->pack->nom) ?? 'Vide'}}</h3>
                                <p >Statut :  
                                    @if(auth()->user()->entreprise->isOnTrial())
                                        <span class="badge bg-success">Essai gratuit actif</span>
                                    @elseif(auth()->user()->entreprise->abonnementValide())
                                         <span class="badge bg-success">Actif</span>
                                    @elseif(auth()->user()->entreprise->trialExpire())
                                        <span class="badge bg-danger">Essai gratuit termine</span>
                                    @endif
                                 </p>
                            </div>
                            <div class="subscription-badge">{{auth()->user()->entreprise->isOnTrial() ? 'Essai gratuit' : ' '}}</div>
                        </div>
                        
                        <!-- Details abonnement-->
                        <div class="subscription-details">
                            <div class="detail-item">
                                <h4>Prochain paiement</h4>
                                <div class="detail-value">{{auth()->user()->entreprise->abonnement_expire_le}}</div>
                            </div>

                            <div class="detail-item">
                                <h4>Prix mensuel</h4>
                                <div class="detail-value">{{number_format(auth()->user()->entreprise->pack->prix, 0, ',', ' ')}} XOF <span style="font-size: 14px; opacity: 0.9;">/mois</span></div>
                            </div>

                            <div class="detail-item">
                                <h4>Utilisateurs inclus</h4>
                                    <div class="detail-value">{{auth()->user()->entreprise->pack->max_user}} <span style="font-size: 14px; opacity: 0.9;">utilisateur</span></div>
                            </div>

                            <div class="detail-item">
                                <h4>Nombre de produits</h4>
                                    <div class="detail-value">{{auth()->user()->entreprise->pack->max_produit}} <span style="font-size: 14px; opacity: 0.9;">produits</span></div>
                            </div>
                             <div class="detail-item">
                                <h4>Nombre de clients</h4>
                                    <div class="detail-value">{{auth()->user()->entreprise->pack->max_client}} <span style="font-size: 14px; opacity: 0.9;">clients</span></div>
                            </div>
                        </div>
                        
                        <div class="subscription-actions">
                            @if(auth()->user()->entreprise->trialExpire())
                            <a href="{{route('abonnement.payer')}}" class="btn btn-light"><i class="fa fa-card"></i>Abonnement expiré. Veuillez renouveler</a> 
                            </form>
                            @elseif(auth()->user()->entreprise->abonnementActif())
                                    <a href="{{route('abonnement.payer')}}" class="btn btn-light"><i class="fa fa-card"></i> Payer l'abonnement</a>
                            @endif
                        </div>
                    </div>

                    <!-- Section des packs disponibles -->
                    <div class="available-packs">
                            <h3 style="margin-bottom: 20px; color: #00778b;">Packs disponibles</h3>   
                            <div class="packs-grid">
                                <!-- Pack Basique -->
                                 @foreach($packs as $p)
                                    <div class="pack-card">
                                        
                                        <div class="pack-header">
                                            @if(auth()->user()->entreprise->pack->nom == $p->nom)
                                                <div class="recommended-badge">ACTUELLEMENT ACTIF</div>
                                            @endif
                                            <div class="pack-name">{{$p->nom}}</div>
                                            <div class="pack-price">{{$p->prix}} XOF</div>
                                            <div class="pack-period">par mois</div>
                                        </div>
                                        <ul class="pack-features">
                                            <li><i class="fas fa-check"></i> Jusqu'à {{$p->max_produit}} produits</li>
                                            <li><i class="fas fa-check"></i> {{$p->max_client}} clients</li>
                                            <li><i class="fas fa-check"></i> {{$p->max_user ?? 10}} utilisateur maximum</li>
                                            @if($p->nom == 'starter')
                                                <li><i class="fas fa-check"></i> 50 Go de stockage</li>
                                                <li><i class="fas fa-check"></i> Gestion de stock basique</li>
                                                <li><i class="fas fa-check"></i> Support basique</li>
                                                <li><i class="fas fa-times" style="color: red;"></i> Factures illimitées</li>
                                                <li><i class="fas fa-times" style="color: red;"></i> Tableaux de bord avancés</li>
                                                <li><i class="fas fa-times" style="color: red;"></i> Intégrations API</li>
                                                <li><i class="fas fa-times" style="color: red;"></i> Formation personnalisée</li>
                                            @elseif($p->nom == 'professionnel')
                                                <li><i class="fas fa-check"></i> Factures illimitées</li>
                                                <li><i class="fas fa-check"></i> 500 Go de stockage</li>
                                                <li><i class="fas fa-check"></i> Support prioritaire 24/7</li>
                                                <li><i class="fas fa-check"></i> Analytics avancés</li>
                                                <li><i class="fas fa-times" style="color: red;"></i> Formation personnalisée</li>
                                            @else
                                                <li><i class="fas fa-check"></i> 2 To de stockage</li>
                                                <li><i class="fas fa-check"></i> Gestion des rôles et permissions</li>
                                                <li><i class="fas fa-check"></i> Support dédié 24/7</li>
                                                <li><i class="fas fa-check"></i> Analytics avancés</li>
                                                <li><i class="fas fa-check"></i> Formation personnalisée</li>
                                            @endif
                                        </ul>
                                        @if(auth()->user()->entreprise->pack->nom !==  $p->nom)
                                            <button class="pack-btn bg-success">
                                                <a href="{{route('changement.pack', $p->id)}}" class="text-white">Choisir ce pack</a>
                                            </button>
                                        @else
                                            <button class="pack-btn">Pack actuel</button>
                                        @endif
                                    </div>
                                    @endforeach
                                
                                <!-- Pack Professionnel (recommandé) -->
                                <!--<div class="pack-card recommended">
                                    @if(auth()->user()->entreprise->pack->id == 3)
                                        <div class="recommended-badge">ACTUELLEMENT ACTIF</div>
                                    @endif
                                    <div class="pack-header">
                                        <div class="pack-name">Pack Professionnel</div>
                                        <div class="pack-price">20.000 XOF</div>
                                        <div class="pack-period">par mois</div>
                                    </div>
                                    <ul class="pack-features">
                                        <li><i class="fas fa-check"></i> 200 produits</li>
                                        <li><i class="fas fa-check"></i> 300 Clients</li>
                                        <li><i class="fas fa-check"></i> 2 utilisateurs</li>
                                        <li><i class="fas fa-check"></i> Factures illimitées</li>
                                        <li><i class="fas fa-check"></i> 500 Go de stockage</li>
                                        <li><i class="fas fa-check"></i> Support prioritaire 24/7</li>
                                        <li><i class="fas fa-check"></i> Analytics avancés</li>
                                        <li><i class="fas fa-times" style="color: red;"></i> Formation personnalisée</li>
                                    </ul>
                                    @if(auth()->user()->entreprise->pack->id == 3 && !auth()->user()->entreprise->trialExpire())
                                        <button class="pack-btn">Pack actuel</button>
                                    @elseif(auth()->user()->entreprise->pack->id == 3 && auth()->user()->entreprise->trialExpire())
                                        <button class="pack-btn">Pack actuel</button>
                                        <a href="{{route('abonnement.payer')}}" class="btn btn-success">Payer l'abonnement</a>
                                    @else
                                        <button class="pack-btn">Choisir ce pack</button>
                                    @endif
                                </div>-->
                                
                                <!-- Pack Entreprise -->
                                <!--<div class="pack-card">
                                    @if(auth()->user()->entreprise->pack->id == 2)
                                        <div class="recommended-badge">ACTUELLEMENT ACTIF</div>
                                    @endif
                                    <div class="pack-header">
                                        <div class="pack-name">Pack Entreprise</div>
                                        <div class="pack-price">30.000XOF</div>
                                        <div class="pack-period">par mois</div>
                                    </div>
                                    <ul class="pack-features">
                                        <li><i class="fas fa-check"></i> Tous les fonctionnalités Pro</li>
                                        <li><i class="fas fa-check"></i> produits illimités</li>
                                        <li><i class="fas fa-check"></i> Multi-utilisateurs (jusqu'à 10)</li>
                                        <li><i class="fas fa-check"></i> 2 To de stockage</li>
                                        <li><i class="fas fa-check"></i> Gestion des rôles et permissions</li>
                                        <li><i class="fas fa-check"></i> Support dédié 24/7</li>
                                        <li><i class="fas fa-check"></i> Analytics avancés</li>
                                        <li><i class="fas fa-check"></i> Formation personnalisée</li>
                                    </ul>
                                    @if(auth()->user()->entreprise->pack->id == 2 && !auth()->user()->entreprise->trialExpire())
                                        <button class="pack-btn">Pack actuel</button>
                                    @elseif(auth()->user()->entreprise->pack->id == 2 && auth()->user()->entreprise->trialExpire())
                                        <button class="pack-btn">Pack actuel</button>
                                        <a href="{{route('abonnement.payer')}}" class="btn btn-success">Payer l'abonnement</a>
                                    @else
                                        <button class="pack-btn">Choisir ce pack</button>
                                    @endif
                                </div>-->
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
                        <p class="mb-0 text-muted">© <?= now()->year ?> B-Manager. Tous droits réservés.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0 text-muted">Version 1.0.0</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    <script>
        // Simulation d'interactions pour la section abonnement
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion du bouton "Gérer l'abonnement"
            const manageBtn = document.querySelector('.manage-btn');
            manageBtn.addEventListener('click', function() {
                alert('Redirection vers la page vers la page de paiement.');
            });
            
            // Gestion des boutons de téléchargement de facture
            const invoiceBtn = document.querySelector('.primary-btn');
            invoiceBtn.addEventListener('click', function() {
                alert('Téléchargement de la dernière facture...');
            });
            
            // Gestion des boutons "Choisir ce pack"
            const packBtns = document.querySelectorAll('.pack-card:not(.recommended) .pack-btn');
            packBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const packName = this.closest('.pack-card').querySelector('.pack-name').textContent;
                    alert(`Vous avez sélectionné le ${packName}. Vous serez redirigé vers la page de paiement.`);
                });
            });
            
            // Animation des cartes au survol
            const packCards = document.querySelectorAll('.pack-card');
            packCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.3s ease';
                });
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
    
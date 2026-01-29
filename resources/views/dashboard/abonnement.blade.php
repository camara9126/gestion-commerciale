<?php

use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BizManager - Gestion Commerciale</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">
    
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
            color: #3b82f6;
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
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
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
            color: #1e40af;
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
            border: 2px solid #3b82f6;
            position: relative;
        }
        
        .recommended-badge {
            position: absolute;
            top: -12px;
            right: 20px;
            background-color: #3b82f6;
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
            color: #1e40af;
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
            background-color: #3b82f6;
            color: white;
        }
        
        .pack-card.recommended .pack-btn:hover {
            background-color: #2563eb;
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
                    @if($entreprise->isOnTrial())
                        <div class="alert alert-info">
                            🎉 Essai gratuit actif – expire le {{ $entreprise->trial_fin }}
                        </div>
                    @endif

                    @if($entreprise->trialExpire())
                        <div class="alert alert-danger">
                            ⛔ Essai expiré – veuillez activer un abonnement
                        </div>
                    @endif
                </div>
                
                <!-- Notifications -->
                <div class="dropdown me-3">
                    <button class="btn btn-light dropdown-toggle" type="button" id="notificationsDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                @if($entreprise->isOnTrial()  || $entreprise->trialExpire())
                                    <span class="badge bg-danger rounded-pill">
                                        1
                                    </span>
                                @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <!--<li><h6 class="dropdown-header">Notifications</h6></li>-->
                        @if($entreprise->isOnTrial())
                        <li>
                            <a class="dropdown-item alert alert-info" href="#">🎉 Essai gratuit actif – expire le {{ $entreprise->trial_fin }}
                            </a>
                        </li>
                        @endif
                        <!--<li><a class="dropdown-item" href="#">Paiement reçu de Client XYZ</a></li>-->
                         @if($entreprise->trialExpire())
                            <li>
                                <a class="dropdown-item alert alert-danger" href="#" >⛔ Essai expiré – veuillez activer un abonnement
                                </a>
                            </li>
                        @endif
                    </ul>
                    
                </div>
                
                <!-- Mobile Search Button -->
                <button class="btn btn-light d-md-none me-2" id="mobileSearchBtn">
                    <i class="fas fa-search"></i>
                </button>
                
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
                        <a href="{{route('abonnement.payer')}}" class="manage-btn">
                            <i class="fa-solid fa-bag-shopping text-success"></i>Payer l'abonnement
                        </a>
                    </div>
                    
                    <!-- Carte d'abonnement actuel -->
                    <div class="subscription-card">
                        <div class="subscription-header">
                            <div class="subscription-title">
                                <h3>Pack : {{strtoupper($entreprise->pack->nom) ?? 'Vide'}}</h3>
                                <p >Statut :  
                                    @if($entreprise->isOnTrial())
                                        <span class="badge bg-success">Essai gratuit actif</span>
                                    @elseif($entreprise->trialExpire())
                                        <span class="badge bg-danger">Essai gratuit termine</span>
                                    @elseif($entreprise->abonnementActif())
                                         <span class="badge bg-success">Actif</span>
                                    @endif
                                 </p>
                            </div>
                            <div class="subscription-badge">{{$entreprise->isOnTrial() ? 'Essai gratuit' : ' '}}</div>
                        </div>
                        
                        <!-- Details abonnement-->
                        <div class="subscription-details">
                            <div class="detail-item">
                                <h4>Prochain paiement</h4>
                                <div class="detail-value">{{$entreprise->abonnement_expire_le}}</div>
                            </div>
                            <div class="detail-item">
                                <h4>Prix mensuel</h4>
                                <div class="detail-value">{{number_format($entreprise->pack->prix, 0, ',', ' ')}} XOF <span style="font-size: 14px; opacity: 0.9;">/mois</span></div>
                            </div>
                            <div class="detail-item">
                                <h4>Utilisateurs inclus</h4>
                                @if($entreprise->pack->nom == 'starter')
                                    <div class="detail-value">1 <span style="font-size: 14px; opacity: 0.9;">utilisateur</span></div>
                                @elseif($entreprise->pack->nom == 'entreprise')
                                    <div class="detail-value">3 <span style="font-size: 14px; opacity: 0.9;">utilisateurs</span></div>
                                @else
                                    <div class="detail-value"><span style="font-size: 14px; opacity: 0.9;">illimités</span></div>
                                @endif
                            </div>
                            <div class="detail-item">
                                <h4>Nombre de produits</h4>
                                @if($entreprise->pack->nom == 'starter')
                                    <div class="detail-value">80 <span style="font-size: 14px; opacity: 0.9;">produits</span></div>
                                @elseif($entreprise->pack->nom == 'entreprise')
                                    <div class="detail-value">200 <span style="font-size: 14px; opacity: 0.9;">produits</span></div>
                                @else
                                    <div class="detail-value"><span style="font-size: 14px; opacity: 0.9;">illimités</span></div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="subscription-actions">
                            @if($entreprise->trialExpire())
                            <a href="{{route('abonnement.payer')}}" class="btn btn-light"><i class="fa fa-card"></i>Abonnement expiré. Veuillez renouveler</a> 
                            </form>
                            @else
                                <button class="action-btn secondary-btn">
                                    <i class="fas fa-history"></i> Historique des paiements
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Section des packs disponibles -->
                    <div class="available-packs">
                            <h3 style="margin-bottom: 20px; color: #1e293b;">Packs disponibles</h3>   
                            <div class="packs-grid">
                                <!-- Pack Basique -->
                                <div class="pack-card">
                                    @if($entreprise->pack->id == 1)
                                        <div class="recommended-badge">ACTUELLEMENT ACTIF</div>
                                    @endif
                                    <div class="pack-header">
                                        <div class="pack-name">Pack Starter</div>
                                        <div class="pack-price">19,99 €</div>
                                        <div class="pack-period">par mois</div>
                                    </div>
                                    <ul class="pack-features">
                                        <li><i class="fas fa-check"></i> Jusqu'à 80 produits</li>
                                        <li><i class="fas fa-check"></i> 100 clients</li>
                                        <li><i class="fas fa-check"></i> 1 utilisateur maximum</li>
                                        <li><i class="fas fa-check"></i> 50 Go de stockage</li>
                                        <li><i class="fas fa-check"></i> Gestion de stock basique</li>
                                        <li><i class="fas fa-check"></i> Support basique</li>
                                        <li><i class="fas fa-times" style="color: red;"></i> Factures illimitées</li>
                                        <li><i class="fas fa-times" style="color: red;"></i> Tableaux de bord avancés</li>
                                        <li><i class="fas fa-times" style="color: red;"></i> Intégrations API</li>
                                        <li><i class="fas fa-times" style="color: red;"></i> Formation personnalisée</li>
                                    </ul>
                                    @if($entreprise->pack->id == 1 && !$entreprise->trialExpire())
                                    <button class="pack-btn">Pack actuel</button>
                                    @elseif($entreprise->pack->id == 1 && $entreprise->trialExpire())
                                        <button class="pack-btn">Pack actuel</button>
                                        <a href="{{route('abonnement.payer')}}" class="btn btn-success">Payer l'abonnement</a>
                                    @else
                                        <button class="pack-btn">Choisir ce pack</button>
                                    @endif
                                </div>
                                
                                <!-- Pack Professionnel (recommandé) -->
                                <div class="pack-card recommended">
                                    @if($entreprise->pack->id == 3)
                                        <div class="recommended-badge">ACTUELLEMENT ACTIF</div>
                                    @endif
                                    <div class="pack-header">
                                        <div class="pack-name">Pack Professionnel</div>
                                        <div class="pack-price">49,99 €</div>
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
                                        <!--<li><i class="fas fa-check"></i> Intégrations API</li>-->
                                        <li><i class="fas fa-times" style="color: red;"></i> Formation personnalisée</li>
                                    </ul>
                                    @if($entreprise->pack->id == 3 && !$entreprise->trialExpire())
                                        <button class="pack-btn">Pack actuel</button>
                                    @elseif($entreprise->pack->id == 3 && $entreprise->trialExpire())
                                        <button class="pack-btn">Pack actuel</button>
                                        <a href="{{route('abonnement.payer')}}" class="btn btn-success">Payer l'abonnement</a>
                                    @else
                                        <button class="pack-btn">Choisir ce pack</button>
                                    @endif
                                </div>
                                
                                <!-- Pack Entreprise -->
                                <div class="pack-card">
                                    @if($entreprise->pack->id == 2)
                                        <div class="recommended-badge">ACTUELLEMENT ACTIF</div>
                                    @endif
                                    <div class="pack-header">
                                        <div class="pack-name">Pack Entreprise</div>
                                        <div class="pack-price">99,99 €</div>
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
                                    @if($entreprise->pack->id == 2 && !$entreprise->trialExpire())
                                        <button class="pack-btn">Pack actuel</button>
                                    @elseif($entreprise->pack->id == 2 && $entreprise->trialExpire())
                                        <button class="pack-btn">Pack actuel</button>
                                        <a href="{{route('abonnement.payer')}}" class="btn btn-success">Payer l'abonnement</a>
                                    @else
                                        <button class="pack-btn">Choisir ce pack</button>
                                    @endif
                                </div>
                            </div>    
                    </div>
                </div>
            </section>
        </div>
        

@include('partials.footer')
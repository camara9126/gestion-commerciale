<?php

    use App\Models\Produit;

    $entreprise = request()->user()->entreprise;

    // Alert sotck
    $alerte = Produit::produitsEnAlerte()->count();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Indexation Google Search -->
    <meta name="google-site-verification" content="VvfP8cx3OjDI0xdEQAn7-lqZIgoaSZ4YaxZt2njFJsw" />
    <title>B-Manager - Gestion Commerciale</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">

    <!-- Icon Image -->
     <link rel="shortcut icon" href="{{asset('asset/logo/Logo B.Manager.png')}}"/>
    
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
                <h2 class="h4 mb-0" id="pageTitle">Bienvenue {{request()->user()->name}}</h2>
            </div>
            
            <div class="d-flex align-items-center">
                <!-- Search Bar - Hidden on mobile -->
                <div class="d-none d-md-block me-3">
                     @if($alerte)
                        <div class="alert alert-danger">
                            ⛔ Vous avez <b><?= $alerte ?></b> produit(s) en rupture de stock. Merci de mettre a jour !
                        </div>
                    @endif
                    
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
                        @if($entreprise->isOnTrial()  || $entreprise->trialExpire() || auth()->user()->entreprise->abonnementExpireBientot() || $alerte)
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

                        @if($alerte)
                            <li>
                                <a class="dropdown-item alert alert-info" href="{{ route('mouvements') }}">⛔ <b><?= $alerte ?></b> produit(s) est en rupture de stock.</a>
                            </li>
                        @endif
                        <!--<li><a class="dropdown-item" href="#">Paiement reçu de Client XYZ</a></li>-->
                         @if($entreprise->trialExpire())
                            <li>
                                <a class="dropdown-item alert alert-danger" href="#" >⛔ Essai expiré – veuillez activer un abonnement
                                </a>
                            </li>
                        @endif
                        <li>
                            @if(auth()->user()->entreprise->abonnementExpireBientot())
                                <p>⚠️ Votre abonnement expire dans <strong>{{ auth()->user()->entreprise->joursRestantsAbonnement() }}</strong> jours.
                                <a href="{{ route('abonnement.payer') }}" class="bg-info">Renouveler maintenant</a></p>
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
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2 text-primary"></i> Mon profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.abonnement') }}"><i class="fas fa-box-open me-2 text-primary"></i> Abonnement</a></li>
                        <li><a class="dropdown-item" href="{{ route('parametre') }}"><i class="fas fa-tools me-2 text-primary"></i> Assistance</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                        @csrf    
                                <a class="dropdown-item" href="{{route('logout')}}"onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out-alt me-2 text-danger"></i> Déconnexion</a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
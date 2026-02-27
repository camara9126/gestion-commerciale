<?php

use App\Models\Message;
use App\Models\Support;

    $entreprise = request()->user()->entreprise;
    $supports = Support::where('statut', false)->get();
    $messages = Message::where('statut', false)->get();

?>
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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">
    
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            @if(Auth::user()->entreprise?->logo)
                <img src="{{ asset('storage/' . Auth::user()->entreprise->logo) }}" alt="Logo entreprise" class="w-50">
            @else
                <h3 class="fw-bold text-warning mb-0">{{ ucfirst(Auth::user()->entreprise->nom) }}</h3>
            @endif
            <small class="text-white">{{ Auth::user()->entreprise->adresse }}</small>
        </div>

        <div class="px-3 py-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('entreprise.index') }}" class=" nav-link" data-section="dashboard">
                        <i class="fas fa-circle-check" style="color: #ff9d1b;"></i> Webmaster
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class=" nav-link" data-section="dashboard">
                        <i class="fas fa-home" style="color: #ff9d1b;"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-0 mt-0">
                    <a href="{{ route('entreprise.utilisateurs') }}" class=" nav-link">
                        <i class="fas fa-users" style="color: #ff9d1b;"></i> Utilisateurs
                    </a>
                </li>
                <li class="nav-item mb-0 mt-0">
                    <a href="{{ route('entreprise.entreprises') }}" class="nav-link">
                        <i class="fas fa-building" style="color: #ff9d1b;"></i> Entreprises
                    </a>
                </li>
                <li class="nav-item mb-0 mt-0">
                    <a href="{{ route('entreprise.produits') }}" class="nav-link">
                        <i class="fas fa-list" style="color: #ff9d1b;"></i> Produits
                    </a>
                </li>
                <li class="nav-item mb-0 mt-0">
                    <a href="{{ route('entreprise.fournisseurs') }}" class="nav-link">
                        <i class="fas fa-truck" style="color: #ff9d1b;"></i> Fournisseurs
                    </a>
                </li>
                <li class="nav-item mb-0 mt-0">
                    <a href="{{ route('entreprise.support') }}" class=" nav-link">
                        <i class="fas fa-tools" style="color: #ff9d1b;"></i> Supports ({{$supports->count()}})
                    </a>
                </li>
                <li class="nav-item mb-0 mt-0">
                    <a href="{{ route('entreprise.message') }}" class=" nav-link">
                        <i class="fas fa-envelope" style="color: #ff9d1b;"></i> Messages ({{$messages->count()}})
                    </a>
                </li>
            </ul>
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
                <h2 class="h4 mb-0" id="pageTitle">Bienvenue {{request()->user()->name }}</h2>
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
                
                <!-- Section utilisateurs -->
                <div class="row mb-5">
                    <div class="stat-card">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between align-items-center mb-0">                          
                                <h5 class="mb-0">Utilisateur ({{$users->count()}})</h5>
                                <a href="{{route('entreprise.index')}}" class="btn btn-outline-danger">
                                        Retour
                                </a>
                            </div>
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <!--<nav class="navbar navbar-light bg-light">-->
                                            <form method="get" action="{{route('entreprise.search')}}" class="form-inline">
                                            
                                                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher utilisateur..." aria-label="Search">                                                            
                                            
                                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>                                                    
                                            
                                            </form>
                                        <!--</nav>-->
                                        <table class="table data-table">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Email</th>
                                                    <th>ID Entreprise</th>
                                                    <th>Role</th>
                                                    <th>Date de creation</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $u)
                                                <tr>
                                                    <td>{{$u->name}}</td>
                                                    <td>{{$u->email}}</td>
                                                    <td>{{$u->entreprise_id}}</td>
                                                    <td>{{$u->role}}</td>
                                                    <td>{{$u->created_at}}</td>
                                                    <td>
                                                        <form action="{{route('user.destroy', $u->id)}}" type="button" method="post" onsubmit="return confirm('Supprimer ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                        {{$users->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
     
                      
            </section>
        </div>
        
@include('partials.footer')
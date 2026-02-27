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
    
                <!-- Section utilisateurs -->
                <div class="row mb-5">
                    <div class="stat-card d-flex">
                        <div class="col-lg-8">    
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    @if ($errors->any())
                                    <div style="color: red; margin-bottom: 10px;">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Formulaire Edit Message -->
                                @if($support->count() > 0)
                                    <form method="post" action="{{route('entreprise.update', $support)}}" class="contact-form" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="row mb-3">
                                            <div class="col-10">
                                                <h2 class="text-center mb-4">Support Client</h2>
                                            </div>
                                            <div class="col-2">
                                                <a href="{{route('entreprise.support')}}" class="btn btn-danger">
                                                    Retour
                                                </a>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Image</label>
                                                    <img src="{{asset('storage/'.$support->image)}}" width="100" alt="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Statut</label><br>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="radio" name="statut" value="0" class="form-radio">&nbsp;En Attente
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="radio" name="statut" value="1" class="form-radio">&nbsp;Confirmer
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom Complet</label>
                                            <input type="text" class="form-control" name="nom_complet" readonly value="{{$support->nom_complet}}" >
                                        </div>

                                        <div class="mb-3">
                                            <label for="telephone" class="form-label">Telephone</label>
                                            <input type="text" class="form-control" name="telephone" readonly value="{{$support->telephone}}" >
                                        </div>

                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" readonly value="{{$support->email}}" >
                                                </div>
                                                <div class="col-6">
                                                    <label for="name" class="form-label">Urgence</label>
                                                    <input type="text" class="form-control" name="urgence" readonly value="{{$support->urgence}}" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="adresse" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" rows="5" readonly>{{$support->description}}</textarea>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-warning btn-lg">Modifier</button>
                                        </div>
                                    </form>
                                @endif                                                        
                                <!-- Formulaire Edit Message -->
                                 @if($message->count() > 0)
                                    <form method="post" action="{{route('message.update', $message)}}" class="contact-form">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-10">
                                                <h2 class="text-center mb-4">Message Contact</h2>
                                            </div>
                                            <div class="col-2">
                                                <a href="{{route('entreprise.message')}}" class="btn btn-danger">
                                                    Retour
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Statut</label><br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="radio" name="statut" value="0" class="form-radio">&nbsp;Non Lus
                                                </div>
                                                <div class="col-6">
                                                    <input type="radio" name="statut" value="1" class="form-radio">&nbsp;Lus
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                             <div class="row">
                                                <div class="col-6">
                                                    <label for="name" class="form-label">Nom Complet</label>
                                                    <input type="text" class="form-control" name="nom_complet" readonly value="{{$message->nom_complet}}" >
                                                </div>
                                                <div class="col-6">
                                                    <label for="telephone" class="form-label">Sujet</label>
                                                    <input type="text" class="form-control" name="sujet" readonly value="{{$message->sujet}}" >
                                                </div>
                                             </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" readonly value="{{$message->email}}" >
                                                </div>
                                                <div class="col-6">
                                                    <label for="name" class="form-label">Entreprise</label>
                                                    <input type="text" class="form-control" name="urgence" readonly value="{{$message->entreprise}}" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="adresse" class="form-label">Description</label>
                                            <textarea class="form-control" name="message" rows="5" readonly>{{$message->message}}</textarea>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-warning btn-lg">Modifier</button>
                                        </div>
                                    </form>
                                @endif  

                                </div>
                            </div>                                
                        </div>
                    </div>
                </div>
     
                      
            </section>
        </div>
        
@include('partials.footer')
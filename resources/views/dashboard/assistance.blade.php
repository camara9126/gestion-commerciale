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
    <title>BizManager - Gestion Commerciale</title>
    
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
     <link rel="shortcut icon" href="{{asset('asset/logo/logo bas.png')}}"/>
     
    <style>

        .support-card {
        max-width: 1500px;
        width: 100%;
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-radius: 3.5rem;
        box-shadow: 0 25px 50px -10px rgba(0,20,60,0.25), inset 0 0 0 1px rgba(255,255,255,0.6);
        padding: 3rem 2.5rem;
        }

        /* en-tête */
        .support-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
        }

        .support-header h1 {
        font-size: 2.2rem;
        font-weight: 100;
        letter-spacing: -0.02em;
        background: linear-gradient(130deg, #0B2A4A, #264d7c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: inline-flex;
        align-items: center;
        gap: 0.7rem;
        }

        .support-header h1 i {
        background: #1e3a5f;
        background: linear-gradient(145deg, #1e3a5f, #2b4f7b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.1rem;
        }

        .header-badge {
        background: white;
        padding: 0.6rem 1.5rem;
        border-radius: 60px;
        font-weight: 500;
        color: #1e3a5f;
        box-shadow: 0 4px 10px rgba(0,30,60,0.08);
        border: 1px solid rgba(0,50,100,0.1);
        font-size: 1rem;
        }

        .header-badge i {
        margin-right: 0.5rem;
        color: #2e7eb0;
        }

        /* Grille principale deux colonnes */
        .support-grid {
        align-items: start;
        }

        /* ========== FORMULAIRE ========= */
        .form-container {
        background: white;
        border-radius: 2.5rem;
        padding: 2rem 1.8rem;
        box-shadow: 0 20px 35px -10px rgba(0,30,60,0.15);
        border: 1px solid rgba(255,255,255,0.7);
        }

        .form-title {
        margin-bottom: 0.4rem;
        color: #0a2647;
        }

        .form-sub {
        color: #456f9c;
        margin-bottom: 2rem;
        border-left: 3px solid #3f7eb6;
        padding-left: 1rem;
        }

        .form-group {
        margin-bottom: 1.5rem;
        }

        .form-group label {
        display: flex;
        align-items: center;
        color: #1e3f5c;
        margin-bottom: 0.4rem;
        }

        .form-group label i {
        color: #3f7eb6;
        width: 1.2rem;
        }

        input, select, textarea {
        width: 100%;
        padding: 1rem 1.2rem;
        border: 1.5px solid #dae3f0;
        border-radius: 1.8rem;
        background: #f9fcff;
        transition: 0.2s;
        font-family: inherit;
        }

        input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: #2b6eae;
        background: white;
        box-shadow: 0 6px 14px rgba(27, 85, 170, 0.1);
        }

        textarea {
        border-radius: 1.5rem;
        resize: vertical;
        }

        .priority-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        }

        .priority-option {
        background: #ecf3fa;
        border-radius: 2.5rem;
        padding: 0.7rem 0.2rem;
        text-align: center;
        color: #1c3f5e;
        border: 1.5px solid transparent;
        transition: all 0.1s;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .priority-option input[type="radio"] {
        display: none;
        }

        .priority-option:has(input:checked) {
        background: #d3e5fc;
        border-color: #1f69b0;
        color: #0b3a61;
        box-shadow: inset 0 2px 6px rgba(32,94,166,0.1);
        }

        .btn-submit {
        background: #0f2d4e;
        border: none;
        padding: 1rem 2rem;
        border-radius: 3rem;
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        cursor: pointer;
        transition: 0.2s;
        border: 1px solid rgba(255,255,255,0.2);
        margin-top: 0.5rem;
        box-shadow: 0 8px 18px rgba(11, 42, 74, 0.2);
        }

        .btn-submit:hover {
        background: #1d4068;
        transform: scale(1.02);
        }

        .legal-note {
        color: #6989aa;
        margin-top: 1.3rem;
        text-align: center;
        }

        /* ========== FOIRE AUX QUESTIONS ========= */
        .faq-container {
        background: rgba(255,255,255,0.5);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        border-radius: 2.5rem;
        padding: 2rem 1.8rem;
        border: 1px solid rgba(255,255,255,0.7);
        box-shadow: 0 20px 30px -10px rgba(0,25,45,0.1);
        }

        .faq-header {
        display: flex;
        align-items: center;
        margin-bottom: 2.2rem;
        }

        .faq-header h2 {
        color: #133855;
        }

        .faq-header i {
        color: #2e7eb0;
        background: white;
        padding: 0.5rem;
        border-radius: 50%;
        box-shadow: 0 8px 18px rgba(21,80,130,0.1);
        }

        .faq-list {
        display: flex;
        flex-direction: column;
        }

        .faq-item {
        background: white;
        border-radius: 1.8rem;
        box-shadow: 0 4px 10px rgba(0,25,45,0.03);
        border: 1px solid rgba(0,40,80,0.05);
        overflow: hidden;
        transition: 0.15s;
        }

        .faq-question {
        padding: 1.2rem 1.8rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        color: #1b3f62;
        background: #ffffff;
        }

        .faq-question span {
        }

        .faq-question i {
        color: #457eb3;
        transition: transform 0.2s;
        }

        .faq-checkbox {
        display: none;
        }

        .faq-answer {
        max-height: 0;
        opacity: 0;
        padding: 0 1.8rem;
        background: #f4faff;
        color: #264e73;
        transition: 0.3s ease-in-out;
        border-top: 0 solid transparent;
        line-height: 1.5;
        pointer-events: none;
        }

        .faq-checkbox:checked + .faq-item .faq-answer {
        max-height: 200px;      /* assez pour les réponses */
        opacity: 1;
        padding: 1.2rem 1.8rem;
        border-top-width: 1px;
        border-color: #c3dffa;
        pointer-events: auto;
        }

        .faq-checkbox:checked + .faq-item .faq-question i {
        transform: rotate(180deg);
        }

        .faq-item:hover {
        background: #f4fbff;
        border-color: #b7d6f3;
        }

        .more-help {
        margin-top: 2rem;
        background: #e1edfc;
        border-radius: 2rem;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        color: #0f3150;
        border: 1px solid #b4d3f3;
        }

        .more-help i {
        font-size: 1.8rem;
        color: #1d5b93;
        }

        .more-help p {
        font-weight: 450;
        }

        hr {
        border: none;
        border-top: 2px dashed rgba(65, 120, 180, 0.2);
        margin: 1rem 0;
        }

        /* adaptatif mobile */
        @media (max-width: 900px) {
        .support-grid {
            grid-template-columns: 1fr;
        }
        .support-card {
            padding: 2rem 1.2rem;
            border-radius: 2rem;
        }
        .support-header {
            flex-direction: column;
            align-items: start;
            gap: 1rem;
        }
        }

        /* petite astuce pour les icônes dans les réponses */
        .faq-answer i {
        margin-right: 0.5rem;
        color: #3f7eb6;
        }

        .note-urgence {
        font-size: 0.9rem;
        color: #4d6e8f;
        margin-top: 0.4rem;
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
                <div class="support-card">
                    <!-- En-tête de la page -->
                    <div class="support-header">
                        <h1>
                            <i class="fas fa-headset"></i> Centre d'assistance
                        </h1>
                        <div class="header-badge">
                            <i class="fas fa-clock"></i> Disponible 24/7 · temps réel
                        </div>
                        @if(Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @elseif(Session::has('danger'))
                                <div class="alert alert-danger" role="alert">
                                    {{ Session::get('danger') }}
                                </div>
                            @endif
                        <P>
                            Besoin d’aide ? <br> Notre équipe est disponible pour vous accompagner dans l’utilisation du logiciel, résoudre vos problèmes techniques ou répondre à vos questions.
                        </P>
                    </div>

                    <!-- Grille : formulaire + FAQ -->
                    <div class="support-grid">

                        <!-- COLONNE DROITE : FAQ INTERACTIVE -->
                        <div class="faq-container">
                            <div class="faq-header">
                                <i class="fas fa-circle-question"></i>
                                <h2><a href="{{ route('faq') }}">Foire aux questions</a></h2>
                            </div>
                        </div>


                        <!-- COLONNE GAUCHE : FORMULAIRE DE CONTACT -->
                        <div class="form-container">
                            <div class="form-title">
                            <i class="fas fa-paper-plane" style="color: #1e5b9e; margin-right: 0.3rem;"></i> Contacter le support
                            </div>
                            <div class="form-sub">
                            Remplissez ce formulaire, nous vous répondons sous 24h (souvent moins ⚡)
                            </div>

                             @if ($errors->any())
                                <div style="color: red; margin-bottom: 10px;">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <form id="supportForm" method="post" action="{{route('dashboard.support')}}" enctype="multipart/form-data">
                                @csrf
                                <!-- Nom complet -->
                                <div class="form-group">
                                    <label><i class="fas fa-user-circle"></i> Nom complet</label>
                                    <input type="text" name="nom_complet" placeholder="ex. Marie Dubois" required>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label><i class="fas fa-envelope"></i> Adresse email</label>
                                    <input type="email" name="email" placeholder="prenom@exemple.com" required>
                                </div>

                                <!-- Telephone -->
                                <div class="form-group">
                                    <label><i class="fas fa-envelope"></i> Telephone</label>
                                    <input type="text" name="telephone" placeholder="77 123 45 67" required>
                                </div>

                                <!-- Priorité avec 3 boutons radio stylisés -->
                                <div class="form-group">
                                    <label><i class="fas fa-exclamation-triangle"></i> Niveau d'urgence</label>
                                    <div class="priority-row">
                                    <label class="priority-option">
                                        <input type="radio" name="urgence" value="basse" checked> <i class="fas fa-chevron-circle-down"></i> Basse
                                    </label>
                                    <label class="priority-option">
                                        <input type="radio" name="urgence" value="moyenne"> <i class="fas fa-minus-circle"></i> Moyenne
                                    </label>
                                    <label class="priority-option">
                                        <input type="radio" name="urgence" value="haute"> <i class="fas fa-exclamation-circle"></i> Haute
                                    </label>
                                    </div>
                                    <div class="note-urgence"><i class="fas fa-info-circle"></i> priorité haute = incident bloquant</div>
                                </div>

                                <!-- Message -->
                                <div class="form-group">
                                    <label><i class="fas fa-comment-dots"></i> Description du problème</label>
                                    <textarea rows="4" name="description" placeholder="Décrivez les étapes, messages d'erreur, captures éventuelles..."></textarea>
                                </div>

                                <!-- Pièce jointe fictive (juste pour l'UX) -->
                                <div class="form-group">
                                    <label><i class="fas fa-paperclip"></i> Joindre un fichier (optionnel)</label>
                                    <input type="file" name="image" style="border: none; padding: 0.5rem 0; background: transparent;">
                                </div>

                                <!-- Bouton d'envoi -->
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-rocket"></i> Envoyer la demande
                                </button>
                                <div class="legal-note">
                                    <i class="fas fa-shield-alt"></i> Aucun spam, données protégées.
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>

  @include('partials.footer')
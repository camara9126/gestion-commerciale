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
     <link rel="shortcut icon" href="{{asset('asset/logo/logo bas.png')}}"/>
     
    <style>

    .support-card {
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
      font-size: 2.5rem;
      font-weight: 400;
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
      font-size: 2.6rem;
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
      display: grid;
      grid-template-columns: 1.1fr 1.9fr;
      gap: 2.5rem;
      align-items: start;
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

   /* ========== FORMULAIRE ========= */
    .form-container {
      background: white;
      border-radius: 2.5rem;
      padding: 2rem 1.8rem;
      box-shadow: 0 20px 35px -10px rgba(0,30,60,0.15);
      border: 1px solid rgba(255,255,255,0.7);
    }

    .form-title {
      font-size: 1.9rem;
      font-weight: 600;
      margin-bottom: 0.4rem;
      color: #0a2647;
    }

    .form-sub {
      color: #456f9c;
      font-size: 0.95rem;
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
      gap: 0.5rem;
      font-weight: 500;
      color: #1e3f5c;
      margin-bottom: 0.4rem;
      font-size: 0.95rem;
    }

    .form-group label i {
      color: #3f7eb6;
      width: 1.2rem;
      font-size: 1rem;
    }

    input, select, textarea {
      width: 100%;
      padding: 1rem 1.2rem;
      border: 1.5px solid #dae3f0;
      border-radius: 1.8rem;
      font-size: 1rem;
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
        padding: 0.7rem 3.5rem;
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
      border: 1px solid rgba(255,255,255,0.7);
      box-shadow: 0 20px 30px -10px rgba(0,25,45,0.1);
    }

    .faq-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 2.2rem;
    }

    .faq-header h2 {
      font-size: 1.5rem;
      font-weight: 400;
      color: #133855;
    }
    .liste-faq {
      font-size: 1rem;
      font-weight: 200;
      color: #133855;
    }

    .faq-header i {
      font-size: 2rem;
      color: #2e7eb0;
      background: white;
      border-radius: 50%;
      box-shadow: 0 8px 18px rgba(21,80,130,0.1);
    }

    .faq-list {
      display: flex;
      flex-direction: column;
      gap: 1rem;
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
      padding: 1.2rem 1.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      font-weight: 500;
      color: #1b3f62;
      background: #ffffff;
      gap: 0.5rem;
    }

    .faq-question span {
      font-size: 1.1rem;
    }

    .faq-question i {
      color: #457eb3;
      font-size: 1.1rem;
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
      padding: 1.2rem 1.5rem;
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
        margin-right: 1.5rem;
        color: #3f7eb6;
        }

        .note-urgence {
        font-size: .9rem;
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
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2 text-primary"></i> Mon profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.abonnement') }}"><i class="fas fa-box-open me-2 text-primary"></i> Abonnement</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('parametre') }}"><i class="fas fa-tools me-2 text-primary"></i> Assistance</a></li>
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
                        
                    <!-- Grille : formulaire + FAQ -->
                    <div class="support-grid">
                      
                       <!-- COLONNE DROITE : FAQ INTERACTIVE -->
                        <div class="faq-container">
                            <div class="faq-header">
                                <i class="fas fa-circle-question"></i>
                                <h2>Foire aux questions</h2>
                            </div>

                            <div class="faq-list">
                                <!-- QUESTION 1 (utilisation du logiciel sur mobile) -->
                                <input type="checkbox" id="faq1" class="faq-checkbox" style="display: none;">
                                <div class="faq-item">
                                    <label for="faq1" class="faq-question">
                                        <span> 1. Puis-je utiliser le logiciel sur mobile ?</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </label>
                                    <div class="faq-answer">
                                        <i class="fas fa-arrow-right"></i> Oui, notre logiciel est responsive et accessible depuis n’importe quel navigateur mobile. Une application native est également prévue bientot.
                                    </div>
                                </div>
                                <!-- QUESTION 2 securisation des donnees) -->
                                <input type="checkbox" id="faq2" class="faq-checkbox" style="display: none;">
                                <div class="faq-item">
                                    <label for="faq2" class="faq-question">
                                        <span> 2.  Mes données sont-elles sécurisées ?</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </label>
                                    <div class="faq-answer">
                                        <i class="fas fa-arrow-right"></i> Absolument. Toutes les données sont chiffrées (SSL 256 bits) et hébergées. Nous effectuons des sauvegardes quotidiennes. 
                                    </div>
                                </div>
                                <!-- QUESTION 3 (abonnement inactive) -->
                                <input type="checkbox" id="faq3" class="faq-checkbox" style="display: none;">
                                <div class="faq-item">
                                    <label for="faq3" class="faq-question">
                                        <span> 3. Mon paiement a été débité mais mon abonnement n’est pas activé, que faire ?</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </label>
                                    <div class="faq-answer">
                                        <i class="fas fa-arrow-right"></i> OPatientez 5 à 10 minutes (parfois le temps de confirmation). Si toujours rien, contactez le support, nous activerons manuellement.
                                    </div>
                                </div>
                                <!-- QUESTION 4 (changement pack) -->
                                <input type="checkbox" id="faq4" class="faq-checkbox" style="display: none;">
                                <div class="faq-item">
                                    <label for="faq4" class="faq-question">
                                        <span> 4. Puis-je changer de pack à tout moment ?</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </label>
                                    <div class="faq-answer">
                                        <i class="fas fa-arrow-right"></i> Oui, vous pouvez évoluer vers un pack supérieur immédiatement (prorata). Pour un pack inférieur, le changement se fait en fin de cycle.
                                    </div>
                                </div>
                                <!-- QUESTION 5 (expiration abonnement) -->
                                <input type="checkbox" id="faq5" class="faq-checkbox" style="display: none;">
                                <div class="faq-item">
                                    <label for="faq5" class="faq-question">
                                        <span> 5. Que se passe-t-il si mon abonnement expire ?</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </label>
                                    <div class="faq-answer">
                                        <i class="fas fa-arrow-right"></i> Vous basculez en mode lecture seule pendant 15 jours. Passé ce délai, certaines fonctionnalités seront désactivées. Pensez à renouveler !
                                    </div>
                                </div>
                                <!-- QUESTION 6 (ajout, modification et suppression produit) -->
                                <input type="checkbox" id="faq6" class="faq-checkbox" style="display: none;">
                                <div class="faq-item">
                                    <label for="faq6" class="faq-question">
                                        <span> 6. Comment ajouter, modifier ou supprimer un produit ?</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </label>
                                    <div class="faq-answer">
                                        <i class="fas fa-arrow-right"></i> Dans la section "Produit", cliquez sur le bouton <b>Nouveau produit</b> en haut à droite. Pour modifier, cliquer sur l'icon bleu du colonne "Statut" dans la liste. Modifier les infos souhaitées et enregistrer. Pour supprimer un produit , il suffit de cliquer sur l'icon rouge et confirmer la suppréssion. Attention : suppression définitive.
                                    </div>
                                </div>
                                <!-- QUESTION 7 (gestion de stocks) -->
                                <input type="checkbox" id="faq7" class="faq-checkbox" style="display: none;">
                                <div class="faq-item">
                                    <label for="faq7" class="faq-question">
                                        <span> 7. Comment gérer le stock ?</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </label>
                                    <div class="faq-answer">
                                        <i class="fas fa-arrow-right"></i> VoChaque vente diminue le stock automatiquement. Vous pouvez aussi faire des ajustements manuels via "Inventaire" > "Stocks".
                                    </div>
                                </div>
                                <!-- QUESTION 8 (ajout utilisateur) -->
                                <input type="checkbox" id="faq8" class="faq-checkbox" style="display: none;">
                                <div class="faq-item">
                                    <label for="faq8" class="faq-question">
                                        <span> 8. Comment ajouter un utilisateur ?</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </label>
                                    <div class="faq-answer">
                                        <i class="fas fa-arrow-right"></i> Dans la section "Utilisateurs", cliquez sur "Nouveau utilisateur". Saisissez son email et choisissez son rôle.
                                    </div>
                                </div>
                            </div>
                            <div class="faq-header">
                                <p class="liste-faq">
                                    Visiter la liste des <b>FAQ</b> en cliquant sur <a href="{{route('faq')}}" class="btn btn-info">Ce bouton</a>.
                                </p>
                            </div>
                             <div class="px-2 py-2 mt-0">
                            <h2 class="fw-bold mb-2">Nous Contactez</h2>
                            <ul class="nav flex-column mb-3">
                                <li>Email : bmanager@bcmgroupe.com</li>
                                <li>Telephone : +221 76 280 88 39</li>
                                <li>Whatsapp : <a href="https://wa.me/+221783739364" class="btn btn-outline-success" title="cliquer" target="_blank"><i class="fa-brands fa-whatsapp" ></i></a></li>
                                <li></li>
                                <li></li>
                            </ul>
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
                                <!-- <div class="form-group">
                                    <label><i class="fas fa-envelope"></i> Adresse email</label>
                                    <input type="email" name="email" placeholder="prenom@exemple.com" required>
                                </div> -->

                                <!-- Telephone -->
                                <!-- <div class="form-group">
                                    <label><i class="fas fa-phone"></i> Telephone</label>
                                    <input type="text" name="telephone" placeholder="77 123 45 67" required>
                                </div> -->

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
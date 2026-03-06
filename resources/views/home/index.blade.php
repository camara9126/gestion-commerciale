<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B-manager | Solution de Gestion Commerciale Intelligente</title>
    
    <!-- Indexation Google Search -->
    <meta name="google-site-verification" content="VvfP8cx3OjDI0xdEQAn7-lqZIgoaSZ4YaxZt2njFJsw" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Icon Image -->
     <link rel="shortcut icon" href="{{asset('asset/logo/Logo B.Manager.png')}}"/>
    <style>
        :root {
            --primary: #ff9d1b;
            --secondary: #00778b;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #045765;
            --success: #2ecc71;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 0;
        }
        
        /* Header & Navigation */
        header {
            background-color: white;
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .logo i {
            margin-right: 10px;
            color: var(--secondary);
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 30px;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--primary);
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: var(--secondary);
        }
        
        .cta-button {
            background-color: var(--secondary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        
        .cta-button:hover {
            background-color: #00778b;
            transform: translateY(-2px);
        }

        .nav-button {
            background-color: var(--secondary);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            font-weight: 100;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        
        .nav-button:hover {
            background-color: #00778b;
            transform: translateY(-2px);
        }
        
        .mobile-menu {
            display: none;
            font-size: 1.5rem;
            padding-left: 0;
            cursor: pointer;
        }
        
        /* Hero Section */
        .hero {
            padding: 100px 0 50px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            text-align: center;
        }
        
        .hero h4 {
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 20px;
            margin-top: 20px;
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 40px;
            color: #555;
        }
        
        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        
        .secondary-button {
            background-color: white;
            color: var(--secondary);
            border: 2px solid var(--secondary);
            padding: 12px 24px;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .secondary-button:hover {
            background-color: var(--secondary);
            color: white;
        }
        
        .hero-image {
            max-width: 800px;
            margin: 50px auto 0;
            box-shadow: var(--shadow);
            border-radius: var(--border-radius);
            overflow: hidden;
        }
        
        .hero-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        /* Features Section */
        .features {
            padding: 50px 0;
            background-color: white;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }
        
        .section-title p {
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }
        
        .feature-card {
            text-align: center;
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background-color: rgba(52, 152, 219, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .feature-icon i {
            font-size: 1.8rem;
            color: var(--secondary);
        }
        
        .feature-card h3 {
            margin-bottom: 15px;
            color: var(--primary);
        }
        
        /* Pricing Section */
        .pricing {
            padding: 50px 0;
            background-color: #f5f7fa;
        }
        
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .pricing-card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 40px 30px;
            text-align: center;
            transition: transform 0.3s;
            position: relative;
        }
        
        .pricing-card:hover {
            transform: translateY(-10px);
        }
        
        .pricing-card.popular {
            border-top: 5px solid var(--secondary);
            transform: scale(1.05);
        }
        
        .popular-tag {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--secondary);
            color: white;
            padding: 6px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .pricing-header h3 {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .price {
            margin: 20px 0;
        }
        
        .price-amount {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .price-period {
            color: #777;
            font-size: 1rem;
        }
        
        .price-savings {
            display: inline-block;
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--success);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-top: 10px;
        }
        
        .pricing-features {
            list-style: none;
            margin: 30px 0;
            text-align: left;
        }
        
        .pricing-features li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        
        .pricing-features li i {
            margin-right: 10px;
            color: var(--success);
        }
        
        .pricing-features li.disabled {
            color: #aaa;
        }
        
        .pricing-features li.disabled i {
            color: #ccc;
        }
        
        /* CTA Section */
        .cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
            color: white;
            text-align: center;
        }
        
        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        
        .cta-section p {
            max-width: 700px;
            margin: 0 auto 40px;
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 70px 0 30px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 50px;
        }
        
        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 25px;
            color: white;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #bbb;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #444;
            color: #bbb;
            font-size: 0.9rem;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .pricing-card.popular {
                transform: none;
            }
        }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .mobile-menu {
                display: block;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .hero-buttons button {
                width: 100%;
                max-width: 300px;
            }
            
            .hero {
                padding: 120px 0 60px;
            }
        }
        
        @media (max-width: 480px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .pricing-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header & Navigation -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <a href="/">
                        <img src="{{asset('asset/logo/Logo B.Manager.png')}}" width="70" alt="">
                    </a>
                    <!--<i class="fas fa-chart-line"></i>-->
                    <span>Bmanager</span>
                </div>
                <ul class="nav-links">
                    <li><a href="#features">Fonctionnalités</a></li>
                    <li><a href="#pricing">Offres</a></li>
                    <li><a href="{{route('apropos')}}">À propos</a></li>
                    <li><a href="{{route('contact')}}">Contact</a></li>
                </ul>
               

                @auth
                    <a href="{{route('dashboard.index')}}" class="nav-button">Dashboard</a>
                @else 
                <a href="{{route('login')}}">
                    <button class="nav-button">Connexion</button>
                </a>
                @endauth
                <div class="mobile-menu">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero mt-0 mb-1">
        <div class="container">
            <h4>Gérez votre activité commerciale avec simplicité</h4>
            <p><span style="color: #045765;">B-manager</span> est la solution tout-en-un pour gérer vos clients, ventes, factures et stocks. Optimisez vos processus commerciaux et augmentez votre productivité dès aujourd'hui.</p>
            <div class="hero-buttons">
                <a href="{{route('register')}}" class="cta-button">Commencer l'essai gratuit</a>
                <button class="secondary-button">
                    <i class="fas fa-play-circle"></i> Voir la démo
                </button>
            </div>
            <div class="hero-image">
                <!-- Image placeholder - would be replaced with actual app screenshot -->
                <div style="background: linear-gradient(135deg, #00778b 0%, #ff9d1b 100%); height: 400px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                    <div style="text-align: center;">
                        <i class="fas fa-desktop" style="font-size: 4rem; margin-bottom: 20px;"></i>
                        <p>Interface de B-Manager</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features mt-0 mb-1">
        <div class="container">
            <div class="section-title">
                <h2>Fonctionnalités puissantes</h2>
                <p>Découvrez les outils qui transformeront votre gestion commerciale</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Gestion des clients</h3>
                    <p>Centralisez les informations de vos clients, suivez les interactions et personnalisez votre relation client.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3>Analytique des ventes</h3>
                    <p>Visualisez vos performances commerciales avec des tableaux de bord interactifs et des rapports détaillés.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h3>Facturation automatisée</h3>
                    <p>Créez et envoyez des factures professionnelles en quelques clics, avec suivi des paiements intégré.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing mt-0 mb-1">
        <div class="container">
            <div class="section-title">
                <h2>Choisissez votre formule</h2>
                <p>Des offres adaptées à la taille et aux besoins de votre entreprise</p>
            </div>
            <div class="pricing-grid">
                <!-- Pack Starter -->
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Starter</h3>
                        <p>Parfait pour les indépendants et petites entreprises</p>
                    </div>
                    <div class="price">
                        <div class="price-amount">15.000 XOF</div>
                        <div class="price-period">par mois</div>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> Jusqu'à 50 produits</li>
                        <li><i class="fas fa-check"></i> 50 clients</li>
                        <li><i class="fas fa-check"></i> 1 utilisateur maximum</li>
                        <li><i class="fas fa-check"></i> 50 Go de stockage</li>
                        <li><i class="fas fa-check"></i> Gestion de stock basique</li>
                        <li><i class="fas fa-check"></i> Support basique</li>
                        <li class="disabled"><i class="fas fa-times text-danger"></i> Factures illimitées</li>
                        <li class="disabled"><i class="fas fa-times text-danger"></i> Tableaux de bord avancés</li>
                        <li class="disabled"><i class="fas fa-times text-danger"></i> Intégrations API</li>
                        <li class="disabled"><i class="fas fa-times text-danger"></i> Formation personnalisée</li>
                    </ul>
                    <!--<a href="{{route('register')}}" class="cta-button" style="width: 100%;">Souscrire</a>-->
                </div>

                <!-- Pack Professionnel (Most Popular) -->
                <div class="pricing-card popular">
                    <div class="popular-tag">Le plus populaire</div>
                    <div class="pricing-header">
                        <h3>Professionnel</h3>
                        <p>Idéal pour les PME en croissance</p>
                    </div>
                    <div class="price">
                        <div class="price-amount">25.000 XOF</div>
                        <div class="price-period">par mois</div>
                        <div class="price-savings">Économisez 20% avec l'abonnement annuel</div>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> 500 produits</li>
                        <li><i class="fas fa-check"></i> 500 Clients</li>
                        <li><i class="fas fa-check"></i> 3 utilisateurs</li>
                        <li><i class="fas fa-check"></i> Factures illimitées</li>
                        <li><i class="fas fa-check"></i> 500 Go de stockage</li>
                        <li><i class="fas fa-check"></i> Support prioritaire 24/7</li>
                        <li><i class="fas fa-check"></i> Analytics avancés</li>
                        <!--<li><i class="fas fa-check"></i> Intégrations API</li>-->
                        <li class="disabled"><i class="fas fa-times"></i> Formation personnalisée</li>
                    </ul>
                    <!--<a href="{{route('register')}}" class="cta-button" style="width: 100%; background-color: var(--accent);">Souscrire</a>-->
                </div>

                <!-- Pack Entreprise -->
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Entreprise</h3>
                        <p>Solution complète pour les grandes entreprises</p>
                    </div>
                    <div class="price">
                        <div class="price-amount">40.000 XOF</div>
                        <div class="price-period">par mois</div>
                        <div class="price-savings">Économisez 25% avec l'abonnement annuel</div>
                    </div>
                    <ul class="pricing-features">
                         <li><i class="fas fa-check"></i> Tous les fonctionnalités Pro</li>
                        <li><i class="fas fa-check"></i> produits illimités</li>
                        <li><i class="fas fa-check"></i> Multi-utilisateurs (jusqu'à 10)</li>
                        <li><i class="fas fa-check"></i> 2 To de stockage</li>
                        <li><i class="fas fa-check"></i> Gestion des rôles et permissions</li>
                        <li><i class="fas fa-check"></i> Support dédié 24/7</li>
                        <li><i class="fas fa-check"></i> Analytics avancés</li>
                        <li><i class="fas fa-check"></i> Formation personnalisée</li>
                    </ul>
                    <!--<a href="{{route('register')}}" class="cta-button" style="width: 100%;">Nous contacter</a>-->
                </div>
            </div>
            <p style="text-align: center; margin-top: 40px; color: #666;">
                Tous les plans incluent un essai gratuit de 25 jours. Aucune carte de crédit requise. <br><br>
                <a href="{{route('register')}}" class="cta-button" style="width: 100%;">Commencer l'essai gratuit</a>
            </p>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Prêt à transformer votre gestion commerciale ?</h2>
            <p>Rejoignez plus de 5 000 entreprises qui utilisent déjà B-Manager pour optimiser leurs processus et augmenter leurs revenus.</p>
            <a href="{{route('register')}}" class="cta-button" style="font-size: 1.1rem;">Commencer maintenant</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>B-Manager</h3>
                    <p>La solution tout-en-un pour la gestion commerciale moderne. Simplifiez vos processus, augmentez votre productivité et développez votre entreprise.</p>
                </div>
                <div class="footer-column">
                    <h3>Liens rapides</h3>
                    <ul class="footer-links">
                        <li><a href="#features">Fonctionnalités</a></li>
                        <li><a href="#pricing">Tarifs</a></li>
                        <li><a href="#">Témoignages</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Légal</h3>
                    <ul class="footer-links">
                        <li><a href="{{route('politiques')}}" target="_blank">Conditions d'utilisation</a></li>
                        <li><a href="{{route('politiques')}}" target="_blank">Politique de confidentialité</a></li>
                        <li><a href="#">Mentions légales</a></li>
                        <li><a href="#">CGV</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact</h3>
                    <ul class="footer-links">
                        <li><i class="fas fa-envelope"></i> contact@bcmgroupe.com</li>
                        <li><i class="fas fa-phone"></i> +221 77 794 72 58</li>
                        <li><i class="fas fa-map-marker-alt"></i> Saint-Louis, Senegal</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; <?=now()->year ?> B-Manager. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'block';
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    if(window.innerWidth <= 768) {
                        document.querySelector('.nav-links').style.display = 'none';
                    }
                }
            });
        });

        // Pricing card interactions
        document.querySelectorAll('.pricing-card .cta-button').forEach(button => {
            button.addEventListener('click', function() {
                const plan = this.closest('.pricing-card').querySelector('h3').textContent;
                  alert(`Merci pour votre intérêt pour le plan ${plan}! Vous allez être redirigé vers le formulaire d'inscription.`);
            });
        });

        // CTA buttons
        document.querySelectorAll('.cta-button:not(.pricing-card .cta-button)').forEach(button => {
            button.addEventListener('click', function() {
                alert("Excellent choix! Vous allez être redirigé vers le formulaire de connexion.");
            });
        });
        
        // Hero secondary button
        document.querySelector('.secondary-button').addEventListener('click', function() {
            alert("La démo vidéo de B-Manager va s'ouvrir dans une nouvelle fenêtre.");
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos | B-Manager </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header */
        header {
            background: linear-gradient(135deg, #00778b 0%, #ff9d1b 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logo-icon {
            background-color: #ff9d1b;
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
        }
        
        .logo-text h1 {
            font-size: 28px;
            font-weight: 700;
        }
        
        .logo-text span {
            color: #c5cae9;
            font-weight: 400;
            font-size: 16px;
        }
        
        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            padding: 5px 0;
            position: relative;
        }
        
        nav a:hover {
            color: #c5cae9;
        }
        
        nav a.active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #ff9d1b;
            border-radius: 2px;
        }
        
        /* Hero Section */
        .hero {
            padding: 80px 0 50px;
            background-color: white;
            text-align: center;
        }
        
        .hero h2 {
            font-size: 42px;
            color: #00778b;
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        .hero p {
            font-size: 20px;
            color: #555;
            max-width: 800px;
            margin: 0 auto 30px;
        }
        
        .cta-button {
            display: inline-block;
            background: linear-gradient(to right, #00778b, #ff9d1b);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px #ff9d1b;
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px #ff9d1b;
        }
        
        /* Main Content */
        .content-section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .section-title h2 {
            font-size: 36px;
            color: #00778b;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }
        
        .section-title h2:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: #ff9d1b;
            border-radius: 2px;
        }
        
        .section-title p {
            font-size: 18px;
            color: #666;
            max-width: 700px;
            margin: 25px auto 0;
        }
        
        /* About Features */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-bottom: 80px;
        }
        
        .feature-card {
            background-color: white;
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #e8eaf6 0%, #c5cae9 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 32px;
            color: #00778b;
        }
        
        .feature-card h3 {
            font-size: 24px;
            color: #00778b;
            margin-bottom: 15px;
        }
        
        .feature-card p {
            color: #666;
        }
        
        /* History Section */
        .history {
            background-color: white;
            border-radius: 15px;
            padding: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 80px;
        }
        
        .history h3 {
            font-size: 28px;
            color: #00778b;
            margin-bottom: 25px;
        }
        
        .history-content {
            display: flex;
            align-items: center;
            gap: 50px;
        }
        
        .history-text {
            flex: 1;
        }
        
        .history-text p {
            margin-bottom: 20px;
            font-size: 17px;
        }
        
        .history-image {
            flex: 1;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .history-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        /* Team Section */
        .team {
            margin-bottom: 80px;
        }
        
        .team-members {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .team-member {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .team-member:hover {
            transform: translateY(-10px);
        }
        
        .member-photo {
            height: 200px;
            background-color: #e8eaf6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            color: #ff9d1b;
        }
        
        .member-info {
            padding: 25px;
        }
        
        .member-info h4 {
            font-size: 22px;
            color: #00778b;
            margin-bottom: 5px;
        }
        
        .member-info p {
            color: #ff9d1b;
            font-weight: 500;
            margin-bottom: 15px;
        }
        
        .member-info .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .social-links a {
            color: #666;
            font-size: 18px;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: #00778b;
        }
        
        /* Stats Section */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 80px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #00778b 0%, #ff9d1b 100%);
            color: white;
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(57, 73, 171, 0.2);
        }
        
        .stat-number {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .stat-label {
            font-size: 18px;
            opacity: 0.9;
        }
        
        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #00778b 0%, #ff9d1b 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
            border-radius: 20px;
            margin-bottom: 80px;
        }
        
        .cta-section h3 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        
        .cta-section p {
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto 40px;
            opacity: 0.9;
        }
        
        .cta-button.secondary {
            background: white;
            color: #00778b;
        }
        
        .cta-button.secondary:hover {
            background: #f5f5f5;
        }
        
        /* Footer */
        footer {
            background-color: #00778b;
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-column h4 {
            font-size: 20px;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-column h4:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: #ff9d1b;
        }
        
        .footer-column ul {
            list-style: none;
        }
        
        .footer-column ul li {
            margin-bottom: 12px;
        }
        
        .footer-column ul li a {
            color: #c5cae9;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-column ul li a:hover {
            color: white;
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #c5cae9;
            font-size: 15px;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .history-content {
                flex-direction: column;
            }
            
            .hero h2 {
                font-size: 36px;
            }
            
            .section-title h2 {
                font-size: 32px;
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 20px;
            }
            
            nav ul {
                gap: 15px;
            }
            
            .hero {
                padding: 60px 0 40px;
            }
            
            .hero h2 {
                font-size: 30px;
            }
            
            .hero p {
                font-size: 18px;
            }
            
            .content-section {
                padding: 60px 0;
            }
            
            .history {
                padding: 30px;
            }
        }
        
        @media (max-width: 576px) {
            .features, .team-members, .stats {
                grid-template-columns: 1fr;
            }
            
            .cta-section h3 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <div class="logo-icon">
                    <a href="/">
                        <img src="{{asset('asset/logo/Logo B.Manager.png')}}" width="70" alt="">
                    </a>
                </div>
                <div class="logo-text">
                    <h1>B-Manager</h1>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <li><a href="{{route('apropos')}}" class="active">À Propos</a></li>
                    <li><a href="{{route('contact')}}">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h2>Notre Mission : Réinventer la Gestion d'Entreprise</h2>
            <p>B-Manager est bien plus qu'un simple logiciel. C'est une solution complète qui transforme la façon dont vous gérez votre entreprise, en automatisant les processus complexes et en vous donnant les outils pour prendre des décisions éclairées.</p>
            <a href="/" class="cta-button">Découvrir B-Manager</a>
        </div>
    </section>

    <!-- Main Content -->
    <main>
        <!-- Features Section -->
        <section class="content-section" id="features">
            <div class="container">
                <div class="section-title">
                    <h2>Pourquoi Choisir B-Manager ?</h2>
                    <p>Découvrez les fonctionnalités qui font de B-Manager la solution de gestion la plus complète du marché</p>
                </div>
                
                <div class="features">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Analyses Avancées</h3>
                        <p>Des tableaux de bord personnalisables et des analyses en temps réel pour suivre la performance de votre entreprise et identifier les opportunités de croissance.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3>Automatisation Intelligente</h3>
                        <p>Automatisez vos processus métier répétitifs pour gagner du temps, réduire les erreurs et permettre à vos équipes de se concentrer sur l'essentiel.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Collaboration d'Équipe</h3>
                        <p>Des outils de collaboration intégrés qui permettent à vos équipes de travailler ensemble efficacement, quel que soit leur emplacement.</p>
                    </div>
                </div>
                
                <!-- History Section -->
                <div class="section-title">
                    <h2>Notre Histoire</h2>
                    <p>Découvrez comment B-Manager est devenu le leader des solutions de gestion d'entreprise</p>
                </div>
                
                <div class="history">
                    <div class="history-content">
                        <div class="history-text">
                            <h3>Une vision qui a transformé la gestion d'entreprise</h3>
                            <p>Fondé par <a href="https://www.bcmgroupe.com" target="_blank">BCM Groupe</a>, B-Manager est né d'un constat simple : la plupart des logiciels de gestion étaient trop complexes, trop chers et ne répondaient pas aux besoins réels des PME.</p>
                            <p>Notre mission était claire : créer une solution intuitive, puissante et abordable qui permettrait aux entreprises de toutes tailles de gérer leurs opérations efficacement. Après des années de recherche et développement, nous avons lancé la première version de B-Manager en 2018.</p>
                            <p>Aujourd'hui, B-Manager est utilisé par plus de 10 000 entreprises dans 15 pays différents, et notre équipe s'agrandit constamment pour continuer à innover et répondre aux besoins changeants du marché.</p>
                        </div>
                        <div class="history-image">
                            <div style="background-color: #e8eaf6; height: 100%; display: flex; align-items: center; justify-content: center; color: #ff9d1b; font-size: 24px; padding: 20px;">
                                <i class="fas fa-rocket" style="font-size: 100px; margin-bottom: 20px;"></i>
                                <div>Évolution de B-Manager</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Team Section -->
                <div class="section-title">
                    <h2>Notre Équipe</h2>
                    <p>Rencontrez les talents derrière B-Manager</p>
                </div>
                
                <div class="team">
                    <div class="team-members">
                        <div class="team-member">
                            <div class="member-photo">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="member-info">
                                <h4>Oumar Ndiaye</h4>
                                <p>Fondateur & CEO</p>
                                <div class="social-links">
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="team-member">
                            <div class="member-photo">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="member-info">
                                <h4>Amadou Camara</h4>
                                <p>Responsable Technique</p>
                                <div class="social-links">
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                    <a href="#"><i class="fab fa-github"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="team-member">
                            <div class="member-photo">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="member-info">
                                <h4>Amadou Camara</h4>
                                <p>Responsable Informatique</p>
                                <div class="social-links">
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="team-member">
                            <div class="member-photo">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="member-info">
                                <h4>Patrick Badji</h4>
                                <p>Chef de Projet</p>
                                <div class="social-links">
                                    <a href="#"><i class="fab fa-linkedin"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Section -->
                <div class="stats">
                    <div class="stat-card">
                        <div class="stat-number">10,000+</div>
                        <div class="stat-label">Entreprises Satisfaites</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-number">15</div>
                        <div class="stat-label">Pays</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support Client</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">Disponibilité</div>
                    </div>
                </div>
                
                <!-- CTA Section -->
                <div class="cta-section">
                    <h3>Prêt à transformer votre gestion d'entreprise ?</h3>
                    <p>Rejoignez les milliers d'entreprises qui font déjà confiance à B-Manager pour simplifier leurs opérations et booster leur productivité.</p>
                    <a href="{{route('register')}}" class="cta-button secondary">Essai Gratuit de 30 Jours</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h4>B-Manager</h4>
                    <p>Logiciel de gestion d'entreprise tout-en-un conçu pour simplifier vos opérations et booster votre productivité.</p>
                </div>
                
                <div class="footer-column">
                    <h4>Liens Rapides</h4>
                    <ul>
                        <li><a href="/">Accueil</a></li>
                        <li><a href="{{route('apropos')}}">À Propos</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Contact</h4>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Saint-Louis, Senegal</li>
                        <li><i class="fas fa-phone"></i> +221 77 794 72 58</li>
                        <li><i class="fas fa-envelope"></i> contact@bcmgroupe.com</li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Suivez-nous</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; <?= now()->year ?> B-Manager. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Animation simple pour les statistiques
        document.addEventListener('DOMContentLoaded', function() {
            const statNumbers = document.querySelectorAll('.stat-number');
            
            statNumbers.forEach(stat => {
                const target = parseInt(stat.textContent);
                let current = 0;
                const increment = target / 100;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        stat.textContent = target + (stat.textContent.includes('+') ? '+' : '');
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(current) + (stat.textContent.includes('+') ? '+' : '');
                    }
                }, 20);
            });
            
            // Animation au défilement
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.feature-card, .team-member').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>
</html>
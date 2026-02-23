<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Foire aux questions complète</title>
    <!-- Font Awesome 6 (gratuit) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f8fafc;
            font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #00778b;
            padding: 2rem 1.5rem;
        }

        .container {
            max-width: 1000px;
            margin-top: 530px;
            margin: auto;
            background: white;
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);
            overflow: hidden;
            padding: 3rem 2rem 3rem 2rem;
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
            padding: 10px 0;
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
            background-color: #00778b;
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
            cursor: pointer;
        }
        
        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #00778b, #ff9d1b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: inline-block;
        }

        .subtitle {
            color: #64748b;
            font-size: 1.1rem;
            margin-bottom: 2.5rem;
            border-left: 4px solid #00778b;
            padding-left: 1.2rem;
        }

        /* Navigation rapide par catégories */
        .faq-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-bottom: 2.5rem;
            background: #f1f5f9;
            padding: 1.2rem 1.5rem;
            border-radius: 60px;
            justify-content: center;
        }

        .faq-nav a {
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            background: white;
            color: #334155;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
            transition: 0.2s;
            border: 1px solid #e2e8f0;
        }

        .faq-nav a:hover {
            background: #00778b;
            color: white;
            border-color: #00778b;
        }

        /* Sections */
        .faq-section {
            margin-bottom: 2.5rem;
            scroll-margin-top: 1rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 1.5rem;
            font-weight: 550;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #e2e8f0;
        }

        .section-title i {
            color: #00778b;
            font-size: 1.8rem;
            width: 2rem;
        }

        /* items FAQ */
        .faq-item {
            background: #ffffff;
            border: 1px solid #e9eef3;
            border-radius: 20px;
            margin-bottom: 1rem;
            padding: 0 1.5rem;
            transition: all 0.2s;
            box-shadow: 0 4px 10px -5px rgba(0,0,0,0.05);
        }

        .faq-item:hover {
            border-color: #b1c5de;
            box-shadow: 0 8px 20px -8px rgba(37, 99, 235, 0.15);
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.3rem 0;
            cursor: pointer;
            font-weight: 500;
            color: #0f172a;
        }

        .faq-question span {
            font-size: 1rem;
        }

        .faq-question i {
            color: #00778b;
            transition: transform 0.3s;
            font-size: 1.1rem;
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.3s;
            background: #f8fafc;
            border-radius: 16px;
            margin: 0 0 0 0;
            color: #334155;
        }

        .faq-item.active .faq-answer {
            max-height: 300px;   /* assez grand pour les réponses */
            padding: 1.2rem 1.5rem;
            margin-bottom: 1.2rem;
        }

        .faq-answer p {
            margin-bottom: 0.3rem;
        }

        .faq-answer ul, .faq-answer ol {
            margin-left: 1.5rem;
            margin-top: 0.3rem;
        }

        .badge {
            background: #dbeafe;
            color: #00778b;
            font-size: 0.5rem;
            font-weight: 500;
            padding: 0.2rem 0.7rem;
            border-radius: 30px;
            margin-left: 0.8rem;
            vertical-align: middle;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        footer {
            text-align: center;
            margin-top: 2rem;
            color: #64748b;
            font-size: 0.7rem;
        }

        hr {
            border: none;
            border-top: 2px dashed #cbd5e1;
            margin: 1.5rem 0 0.5rem 0;
        }

        /* responsive */
        @media (max-width: 600px) {
            .container { padding: 1.5rem; }
            h1 { font-size: 1.9rem; }
            .faq-nav { border-radius: 30px; }
            .section-title { font-size: 1.3rem; }
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
        <header>
            <nav>
                <div class="logo">
                    <a href="/">
                        <img src="{{asset('asset/logo/Logo B.Manager.png')}}" width="70" alt="">
                    </a>
                    <!--<i class="fas fa-chart-line"></i>-->
                    <span>Bmanager</span>
                </div>

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
        </div>
    </header>
    <div class="container">
        <h1>❓ Foire Aux Questions</h1>
        <div class="subtitle">
            Tout ce que vous devez savoir sur le logiciel — réponses claires et rapides. 
            @auth
                <h3><a href="{{route('parametre')}}" style="color: #ff9d1b;" class="btn btn-warning">Retour Dashboard</a></h3>
            @endauth
        </div>
        

        <!-- Menu rapide catégories -->
        <div class="faq-nav">
            <a href="#generales">1️⃣ Générales</a>
            <a href="#paiement">2️⃣ Paiement</a>
            <a href="#produits">3️⃣ Produits</a>
            <a href="#utilisateurs">4️⃣ Utilisateurs</a>
            <a href="#ventes">5️⃣ Ventes</a>
            <a href="#technique">6️⃣ Technique</a>
            <a href="#securite">7️⃣ Sécurité</a>
            <a href="#bonus">🚀 Bonus</a>
        </div>

        <!-- 1️⃣ Générales -->
        <section id="generales" class="faq-section">
            <div class="section-title"><i class="fas fa-circle-info"></i> 1️⃣ Questions générales</div>
            <div class="faq-item">
                <div class="faq-question"><span>1. Comment créer un compte sur le logiciel ?</span> <i class="fas fa-chevron-down"></i></div>
                <div class="faq-answer"><p>Rendez-vous sur la page d'inscription, remplissez le formulaire avec votre nom, email, entreprise, choix du pack, TVA et mot de passe. Cliquez sur  <b>Creer mon conpte</b> pour activer votre compte.</p></div>
            </div>
            <div class="faq-item">
                <div class="faq-question"><span>2. Comment se connecter à mon espace ?</span> <i class="fas fa-chevron-down"></i></div>
                <div class="faq-answer"><p>Utilisez votre adresse email et votre mot de passe sur la page de connexion.</p></div>
            </div>
            <div class="faq-item">
                <div class="faq-question"><span>3. J’ai oublié mon mot de passe, que faire ?</span> <i class="fas fa-chevron-down"></i></div>
                <div class="faq-answer"><p>Cliquez sur "Mot de passe oublié" sur la page de connexion. Saisissez votre email, vous recevrez un lien pour le réinitialiser sous quelques minutes.</p></div>
            </div>
            <div class="faq-item">
                <div class="faq-question"><span>4. Puis-je utiliser le logiciel sur mobile ?</span> <i class="fas fa-chevron-down"></i></div>
                <div class="faq-answer"><p>Oui, notre logiciel est responsive et accessible depuis n’importe quel navigateur mobile. Une application native est également prévue bientot.</p></div>
            </div>
            <div class="faq-item">
                <div class="faq-question"><span>5. Mes données sont-elles sécurisées ?</span> <i class="fas fa-chevron-down"></i></div>
                <div class="faq-answer"><p>Absolument. Toutes les données sont chiffrées (SSL 256 bits) et hébergées. Nous effectuons des sauvegardes quotidiennes. Voir aussi section 7️⃣.</p></div>
            </div>
        </section>

        <!-- 2️⃣ Paiement & Abonnement -->
        <section id="paiement" class="faq-section">
            <div class="section-title"><i class="fas fa-credit-card"></i> 2️⃣ Paiement & Abonnement</div>
            <div class="faq-item"><div class="faq-question"><span>6. Comment souscrire à un abonnement ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p> Votre abonnement est en place dés que vous créer un compte avec le pack choisi. Allez dans l'onglet "Abonnement" de votre espace, cliqué sur le bouton <b>Payer mon abonnement</b> et suivez les instructions de paiement.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>7. Quels moyens de paiement sont acceptés ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Carte bancaire (Visa, Mastercard), Mobile Money (Orange Money, Wave, Free Money, ...).D'autres options peuvent être disponibles.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>8. Mon paiement a été débité mais mon abonnement n’est pas activé, que faire ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Patientez 5 à 10 minutes (parfois le temps de confirmation). Si toujours rien, contactez le support, nous activerons manuellement.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>9. Puis-je changer de pack à tout moment ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Oui, vous pouvez évoluer vers un pack supérieur immédiatement (prorata). Pour un pack inférieur, le changement se fait en fin de cycle.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>10. Que se passe-t-il si mon abonnement expire ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Vous basculez en mode lecture seule pendant 15 jours. Passé ce délai, certaines fonctionnalités seront désactivées. Pensez à renouveler !</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>11. Puis-je annuler mon abonnement ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Oui, l'annulation prend effet à la fin de la période en cours, sans frais.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>12. Comment télécharger ma facture ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Dans "Mon compte" > "Ventes & Factures", vous trouverez la liste de toutes vos ventes et factures au format PDF téléchargeable.</p></div></div>
        </section>

        <!-- 3️⃣ Produits & Gestion -->
        <section id="produits" class="faq-section">
            <div class="section-title"><i class="fas fa-boxes"></i> 3️⃣ Produits & Gestion</div>
            <div class="faq-item"><div class="faq-question"><span>13. Comment ajouter un produit ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Menu "Produits" > "Ajouter un produit". Remplissez les champs : nom, prix, stock initial, etc. Validez.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>14. Comment modifier ou supprimer un produit ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Cliquez sur l'icon bleu du colonne "Statut" dans la liste. Modifier les infos souhaitées. Pour supprimer un produit , il suffit de cliquer sur l'icon rouge et confirmer la suppréssion. Attention : suppression définitive.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>15. Comment gérer le stock ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Chaque vente diminue le stock automatiquement. Vous pouvez aussi faire des ajustements manuels via "Inventaire" > "Stock".</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>16. Pourquoi mon stock devient négatif ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Cela arrive si vous vendez plus que le stock disponible. Activez l'option "Bloquer les ventes en stock négatif" dans les paramètres pour l'éviter.</p></div></div>
        </section>

        <!-- 4️⃣ Utilisateurs & Accès -->
        <section id="utilisateurs" class="faq-section">
            <div class="section-title"><i class="fas fa-users"></i> 4️⃣ Utilisateurs & Accès</div>
            <div class="faq-item"><div class="faq-question"><span>18. Comment ajouter un utilisateur ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Dans la section "Utilisateurs", cliquez sur "Nouveau utilisateur". Saisissez son email et choisissez son rôle.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>19. Puis-je limiter les droits d’un utilisateur ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Oui, plusieurs rôles existent : Administrateur, Gestionnaire de stock et  Comptable.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>20. Combien d’utilisateurs puis-je ajouter selon mon pack ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Pack Starter : 1 utilisateur, Professionnel : 3 utilisateurs, Enterprise : illimité.</p></div></div>
        </section>

        <!-- 5️⃣ Ventes & Rapports -->
        <section id="ventes" class="faq-section">
            <div class="section-title"><i class="fas fa-chart-line"></i> 5️⃣ Ventes & Rapports</div>
            <div class="faq-item"><div class="faq-question"><span>22. Comment enregistrer une vente ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Depuis le menu "Ventes & Factures" ou le raccourci "Nouvelle commande". Ajoutez le nom du client, le produit, choisissez la quantité, validez.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>23. Comment voir le chiffre d’affaires du mois ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Le tableau de bord affiche le CA du mois. Pour plus de détails, utilisez l'onglet "Rapports".</p></div></div>
            <!--<div class="faq-item"><div class="faq-question"><span>24. Puis-je exporter mes rapports en PDF ou Excel ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Oui, chaque rapport (ventes, stocks, CA) propose un bouton d'export aux formats PDF, Excel ou CSV.</p></div></div>-->
            <div class="faq-item"><div class="faq-question"><span>25. Comment voir les top produits ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Allez dans "Rapports" > "Top produits". Vous verrez les meilleures ventes par quantité et par chiffre.</p></div></div>
        </section>

        <!-- 6️⃣ Problèmes techniques -->
        <section id="technique" class="faq-section">
            <div class="section-title"><i class="fas fa-screwdriver-wrench"></i> 6️⃣ Problèmes techniques</div>
            <div class="faq-item"><div class="faq-question"><span>26. Le logiciel est lent, que faire ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Vérifiez votre connexion. Essayez de vider le cache du navigateur. Si persiste, contactez le support avec votre identifiant.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>27. Une page ne s’affiche pas correctement.</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Rafraîchissez la page (Ctrl+F5). Testez avec un autre navigateur. Signalez-nous le problème via le formulaire.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>28. Je reçois une erreur après paiement.</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Notez le code erreur et contactez le support. Ne faites pas un second paiement sans vérification.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>29. Je ne reçois pas les emails du système.</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Vérifiez vos spams. Ajoutez notre adresse à vos contacts. Si rien, demandez un renvoi depuis votre espace.</p></div></div>
        </section>

        <!-- 7️⃣ Sécurité & Données -->
        <section id="securite" class="faq-section">
            <div class="section-title"><i class="fas fa-shield-halved"></i> 7️⃣ Sécurité & Données</div>
            <div class="faq-item"><div class="faq-question"><span>30. Qui peut voir mes données ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Seuls vous et les utilisateurs que vous avez autorisés. Nos équipes n'y ont accès que dans le cadre du support avec votre accord explicite.</p></div></div>
            <!--<div class="faq-item"><div class="faq-question"><span>31. Puis-je sauvegarder mes données ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Oui, exportez vos données à tout moment via "Paramètres" > "Exporter mes données". Nous effectuons aussi des backups automatiques.</p></div></div>-->
            <div class="faq-item"><div class="faq-question"><span>32. Que se passe-t-il si je supprime mon compte ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Toutes vos données personnelles seront anonymisées. Vos factures restent conservées 10 ans (obligation légale). La suppression est irréversible.</p></div></div>
        </section>

        <!-- 🚀 BONUS -->
        <section id="bonus" class="faq-section">
            <div class="section-title"><i class="fas fa-rocket"></i> 🚀 Bonus</div>
            <div class="faq-item"><div class="faq-question"><span>33. Puis-je demander une formation ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Oui, nous proposons des formations en ligne individuelles ou collectives. Contactez le service commercial pour réserver un créneau.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>34. Proposez-vous un accompagnement personnalisé ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Pour les packs Professionnnel et Enterprise, un account manager dédié vous suit. Pour les autres, du support prioritaire est disponible en option.</p></div></div>
            <div class="faq-item"><div class="faq-question"><span>35. Comment contacter le support ?</span><i class="fas fa-chevron-down"></i></div><div class="faq-answer"><p>Via le formulaire, par email (bmanager@bcmgroupe.com) ou par téléphone au +221 77 794 72 58 (lun-ven 9h-18h).</p></div></div>
        </section>

        <hr>
        <footer>
            <i class="fas fa-comment-dots" style="color: #00778b;"></i> Une autre question ? <strong>Contactez notre support</strong> — nous répondons sous 2h ouvrées.
        </footer>
    </div>

    <!-- Script pour l'accordéon -->
    <script>
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', function(e) {
                // Empêche la fermeture si on clique sur un lien interne (mais pas de lien ici)
                this.classList.toggle('active');
            });
        });
    </script>
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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conditions & Confidentialité | B-manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Icon Image -->
    <link rel="shortcut icon" href="{{asset('asset/logo/Logo B.Manager.png')}}"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8fafc;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: linear-gradient(135deg, #00778b 0%, #ff9d1b 100%);
            color: white;
            padding: 25px 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
        }
        
        .logo i {
            font-size: 2.2rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 50%;
        }
        
        .logo-text h1 {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .logo-text p {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .page-title {
            text-align: center;
            margin: 30px 0;
            color: #00778b;
        }
        
        .page-title h2 {
            font-size: 2.2rem;
            margin-bottom: 10px;
        }
        
        .page-title p {
            color: #666;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            border-bottom: 1px solid #e1e8f0;
        }
        
        .tab-button {
            background: none;
            border: none;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .tab-button.active {
            color: #00778b;
        }
        
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 3px;
            background: #00778b;
        }
        
        .tab-button:hover {
            color: #00778b;
        }
        
        .tab-content {
            display: none;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        h3 {
            color: #00778b;
            margin: 25px 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 1px solid #eef2ff;
        }
        
        h4 {
            color: #333;
            margin: 20px 0 10px 0;
        }
        
        p {
            margin-bottom: 15px;
            color: #444;
        }
        
        ul, ol {
            margin-left: 20px;
            margin-bottom: 20px;
        }
        
        li {
            margin-bottom: 8px;
            color: #444;
        }
        
        .highlight {
            background-color: #f0f4ff;
            padding: 15px;
            border-left: 4px solid #00778b;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        
        .update-date {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            text-align: center;
            font-style: italic;
            color: #666;
            border: 1px solid #e9ecef;
        }
        
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #00778b;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(26, 58, 143, 0.3);
            transition: all 0.3s ease;
            z-index: 100;
        }
        
        .back-to-top:hover {
            background: #16327c;
            transform: translateY(-5px);
        }
        
        .quick-nav {
            position: sticky;
            top: 20px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            border: 1px solid #eef2ff;
        }
        
        .quick-nav h4 {
            margin-top: 0;
            color: #00778b;
        }
        
        .quick-nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .quick-nav li {
            margin-bottom: 8px;
        }
        
        .quick-nav a {
            color: #555;
            text-decoration: none;
            transition: color 0.2s;
            display: block;
            padding: 5px 0;
        }
        
        .quick-nav a:hover {
            color: #00778b;
            text-decoration: underline;
        }
        
        .content-wrapper {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .main-content {
            flex: 3;
            min-width: 300px;
        }
        
        .sidebar {
            flex: 1;
            min-width: 250px;
        }
        
        footer {
            text-align: center;
            margin-top: 50px;
            padding: 25px;
            color: #666;
            border-top: 1px solid #e1e8f0;
            background: white;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        
        .footer-links a {
            color: #00778b;
            text-decoration: none;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
            }
            
            .tabs {
                flex-wrap: wrap;
            }
            
            .tab-button {
                padding: 12px 20px;
                font-size: 1rem;
            }
            
            .tab-content {
                padding: 25px;
            }
            
            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
            }
        }
        
        .consent-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin: 25px 0;
            border-left: 4px solid #ff9d1b;
        }
        
        .definition-list dt {
            font-weight: bold;
            color: #00778b;
            margin-top: 15px;
        }
        
        .definition-list dd {
            margin-left: 20px;
            margin-bottom: 15px;
            color: #444;
        }
        
        .contact-ref {
            background: #f0f4ff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 25px;
            text-align: center;
        }
        
        .contact-ref a {
            color: #00778b;
            font-weight: 600;
            text-decoration: none;
        }
        
        .contact-ref a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="/">
                    <img src="{{asset('asset/logo/Logo B.Manager.png')}}" width="70" alt="">
                </a>
                <div class="logo-text">
                    <h1>B-Manager</h1>
                    <p>Logiciel de gestion commerciale intégré</p>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="page-title">
            <h2>Conditions d'utilisation & Politique de confidentialité</h2>
            <p>Veuillez lire attentivement les conditions générales d'utilisation et la politique de confidentialité de notre logiciel de gestion commerciale.</p>
        </div>
        
        <div class="tabs">
            <button class="tab-button active" data-tab="terms">Conditions d'utilisation</button>
            <button class="tab-button" data-tab="privacy">Politique de confidentialité</button>
        </div>
        
        <div class="content-wrapper">
            <div class="main-content">
                <div id="terms" class="tab-content active">
                    <h3>Conditions Générales d'Utilisation</h3>
                    <p>Les présentes conditions générales d'utilisation (ci-après "CGU") régissent votre utilisation du logiciel B-Manager (ci-après "le Logiciel"), édité par B-Manager.</p>
                    
                    <div class="highlight">
                        <p><strong>Important :</strong> En utilisant le Logiciel, vous acceptez sans réserve les présentes CGU. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser le Logiciel.</p>
                    </div>
                    
                    <h4>1. Objet du Logiciel</h4>
                    <p>B-Manager est un logiciel de gestion commerciale intégré offrant des fonctionnalités de :</p>
                    <ul>
                        <li>Gestion de la relation client (CRM)</li>
                        <li>Facturation et gestion comptable</li>
                        <li>Suivi des stocks et inventaire</li>
                        <li>Gestion des ventes et achats</li>
                        <li>Reporting et analyse commerciale</li>
                        <li>Gestion des projets et tâches</li>
                    </ul>
                    
                    <h4>2. Comptes utilisateurs</h4>
                    <p>Pour accéder au Logiciel, vous devez créer un compte utilisateur en fournissant des informations exactes, complètes et à jour. Vous êtes responsable :</p>
                    <ol>
                        <li>De la confidentialité de vos identifiants de connexion</li>
                        <li>De toutes les activités effectuées depuis votre compte</li>
                        <li>De la sécurité de votre matériel et de vos données d'accès</li>
                    </ol>
                    
                    <h4>3. Licence d'utilisation</h4>
                    <p>B-Manager vous concède une licence d'utilisation non exclusive, non transférable et révocable, limitée à :</p>
                    <ul>
                        <li>Un usage professionnel interne</li>
                        <li>Le nombre d'utilisateurs souscrits dans votre abonnement</li>
                        <li>La durée de validité de votre abonnement</li>
                    </ul>
                    <p>Tous droits de propriété intellectuelle sur le Logiciel restent la propriété exclusive de B-Manager.</p>
                    
                    <h4>4. Obligations de l'utilisateur</h4>
                    <p>Vous vous engagez à :</p>
                    <ul>
                        <li>Utiliser le Logiciel conformément à sa documentation</li>
                        <li>Ne pas tenter de contourner les mesures de sécurité</li>
                        <li>Ne pas reproduire, modifier ou distribuer le Logiciel</li>
                        <li>Ne pas utiliser le Logiciel à des fins illégales</li>
                        <li>Respecter les droits de propriété intellectuelle</li>
                    </ul>
                    
                    <h4>5. Tarifs et facturation</h4>
                    <p>L'utilisation du Logiciel est soumise à un abonnement mensuel ou annuel. Les tarifs sont disponibles sur notre site web et peuvent être modifiés avec un préavis de 30 jours.</p>
                    
                    <h4>6. Responsabilités et garanties</h4>
                    <p>Le Logiciel est fourni "en l'état" sans garantie d'aucune sorte. B-Manager ne garantit pas :</p>
                    <ul>
                        <li>L'absence d'erreurs ou d'interruptions</li>
                        <li>La compatibilité avec tous les systèmes d'exploitation</li>
                        <li>La sécurité absolue des données</li>
                    </ul>
                    
                    <h4>7. Résiliation</h4>
                    <p>Vous pouvez résilier votre abonnement à tout moment. B-Manager se réserve le droit de suspendre ou résilier votre accès en cas de violation des CGU.</p>
                    
                    <h4>8. Droit applicable</h4>
                    <p>Les présentes CGU sont régies par le droit français. Tout litige relèvera des tribunaux compétents de Paris.</p>
                    
                    <div class="update-date">
                        <p><strong>Dernière mise à jour :</strong> 15 octobre 2023</p>
                    </div>
                </div>
                
                <div id="privacy" class="tab-content">
                    <h3>Politique de Confidentialité</h3>
                    <p>B-Manager s'engage à protéger la vie privée de ses utilisateurs. Cette politique explique comment nous collectons, utilisons et protégeons vos données personnelles.</p>
                    
                    <div class="consent-section">
                        <p><strong>Consentement :</strong> En utilisant notre Logiciel, vous consentez à la collecte et à l'utilisation de vos données personnelles conformément à cette politique et au Règlement Général sur la Protection des Données (RGPD).</p>
                    </div>
                    
                    <h4>1. Données collectées</h4>
                    <p>Nous pouvons collecter les types de données suivants :</p>
                    
                    <dl class="definition-list">
                        <dt>Données d'identification</dt>
                        <dd>Nom, prénom, adresse email, numéro de téléphone, adresse postale</dd>
                        
                        <dt>Données professionnelles</dt>
                        <dd>Nom de l'entreprise, SIRET, fonction, secteur d'activité</dd>
                        
                        <dt>Données d'utilisation</dt>
                        <dd>Historique de connexion, fonctionnalités utilisées, préférences</dd>
                        
                        <dt>Données de contenu</dt>
                        <dd>Données que vous saisissez dans le Logiciel (clients, factures, stocks, etc.)</dd>
                        
                        <dt>Données techniques</dt>
                        <dd>Adresse IP, type de navigateur, système d'exploitation, appareil utilisé</dd>
                    </dl>
                    
                    <h4>2. Finalités du traitement</h4>
                    <p>Nous utilisons vos données pour :</p>
                    <ul>
                        <li>Fournir et améliorer le Logiciel</li>
                        <li>Gérer votre compte et votre abonnement</li>
                        <li>Vous assister et répondre à vos demandes</li>
                        <li>Envoyer des communications importantes</li>
                        <li>Assurer la sécurité du Logiciel</li>
                        <li>Respecter nos obligations légales</li>
                    </ul>
                    
                    <h4>3. Base légale du traitement</h4>
                    <p>Le traitement de vos données repose sur :</p>
                    <ul>
                        <li>L'exécution du contrat (abonnement au Logiciel)</li>
                        <li>Votre consentement (pour les communications marketing)</li>
                        <li>L'intérêt légitime (sécurité, amélioration du service)</li>
                        <li>Les obligations légales (facturation, conservation)</li>
                    </ul>
                    
                    <h4>4. Partage des données</h4>
                    <p>Nous ne vendons pas vos données. Nous pouvons les partager avec :</p>
                    <ul>
                        <li><strong>Prestataires techniques :</strong> Hébergeurs, services de paiement</li>
                        <li><strong>Partenaires :</strong> Uniquement avec votre consentement explicite</li>
                        <li><strong>Autorités légales :</strong> Si requis par la loi</li>
                    </ul>
                    <p>Tous nos prestataires sont soumis à des accords de confidentialité stricts.</p>
                    
                    <h4>5. Transferts internationaux</h4>
                    <p>Vos données sont principalement hébergées dans l'Union Européenne. En cas de transfert hors UE, nous nous assurons que des garanties appropriées sont en place.</p>
                    
                    <h4>6. Sécurité des données</h4>
                    <p>Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles appropriées :</p>
                    <ul>
                        <li>Chiffrement des données en transit et au repos</li>
                        <li>Sauvegardes régulières et sécurisées</li>
                        <li>Contrôles d'accès stricts</li>
                        <li>Surveillance continue de la sécurité</li>
                        <li>Formation du personnel à la protection des données</li>
                    </ul>
                    
                    <h4>7. Conservation des données</h4>
                    <p>Nous conservons vos données :</p>
                    <ul>
                        <li><strong>Données de compte :</strong> 3 ans après la fin de l'abonnement</li>
                        <li><strong>Données de facturation :</strong> 10 ans (obligation légale)</li>
                        <li><strong>Données d'activité :</strong> 2 ans après la dernière connexion</li>
                        <li><strong>Données de contenu :</strong> Selon votre choix à la résiliation</li>
                    </ul>
                    
                    <h4>8. Vos droits</h4>
                    <p>Conformément au RGPD, vous disposez des droits suivants :</p>
                    <ul>
                        <li><strong>Droit d'accès :</strong> Accéder à vos données personnelles</li>
                        <li><strong>Droit de rectification :</strong> Corriger des données inexactes</li>
                        <li><strong>Droit à l'effacement :</strong> Supprimer vos données ("droit à l'oubli")</li>
                        <li><strong>Droit à la limitation :</strong> Limiter le traitement de vos données</li>
                        <li><strong>Droit d'opposition :</strong> Vous opposer au traitement</li>
                        <li><strong>Droit à la portabilité :</strong> Récupérer vos données dans un format structuré</li>
                    </ul>
                    
                    <div class="contact-ref">
                        <p>Pour exercer vos droits ou pour toute question sur la protection de vos données, contactez notre Délégué à la Protection des Données (CDP) :</p>
                        <p><a href="https://www.cdp.sn/" target="_blank">www.cdp.sn</a> ou par courrier à l'adresse indiquée dans nos informations légales.</p>
                    </div>
                    
                    <h4>9. Cookies et technologies similaires</h4>
                    <p>Nous utilisons des cookies essentiels au fonctionnement du Logiciel. Vous pouvez configurer votre navigateur pour refuser les cookies non essentiels.</p>
                    
                    <h4>10. Modifications de cette politique</h4>
                    <p>Nous pouvons modifier cette politique de confidentialité. Les modifications importantes vous seront notifiées par email ou via le Logiciel.</p>
                    
                    <div class="update-date">
                        <p><strong>Dernière mise à jour :</strong> 15 octobre 2023</p>
                        <p>Cette politique est conforme au RGPD et à la Loi Informatique et Libertés modifiée.</p>
                    </div>
                </div>
            </div>
            
            <div class="sidebar">
                <div class="quick-nav">
                    <h4>Navigation rapide</h4>
                    <ul>
                        <li><a href="#" data-scroll="terms">Conditions d'utilisation</a></li>
                        <li><a href="#" data-scroll="privacy">Politique de confidentialité</a></li>
                        <li><a href="#" data-scroll="license">Licence d'utilisation</a></li>
                        <li><a href="#" data-scroll="obligations">Obligations de l'utilisateur</a></li>
                        <li><a href="#" data-scroll="data-collection">Données collectées</a></li>
                        <li><a href="#" data-scroll="data-rights">Vos droits sur vos données</a></li>
                        <li><a href="" data-scroll="contact">Contact CDP</a></li>
                    </ul>
                </div>
                
                <div class="contact-ref">
                    <h4>Questions ?</h4>
                    <p>Pour toute question concernant nos conditions ou notre politique de confidentialité :</p>
                    <p><a href="{{route('contact')}}">Contactez notre équipe</a></p>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; <?= now()->year ?> B-Manager. Tous droits réservés.</p>
            <div class="footer-links">
                <a href="index.html">Accueil</a>
                <a href="contact.html">Contact</a>
                <a href="terms.html">Conditions d'utilisation</a>
                <a href="privacy.html">Politique de confidentialité</a>
                <a href="cookies.html">Politique des cookies</a>
            </div>
            <p style="margin-top: 15px; font-size: 0.9rem;">SIRET : 123 456 789 00045 - Siège social : 123 Avenue des Affaires, 75008 Paris</p>
        </div>
    </footer>
    
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </a>

    <script>
        // Gestion des onglets
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabId = button.getAttribute('data-tab');
                
                // Retirer la classe active de tous les boutons et contenus
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Ajouter la classe active au bouton et au contenu correspondant
                button.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
        
        // Navigation rapide
        const quickNavLinks = document.querySelectorAll('.quick-nav a');
        
        quickNavLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = link.getAttribute('data-scroll');
                
                if (targetId === 'contact') {
                    // Pour "Contact DPO", on change d'onglet
                    document.querySelector('[data-tab="privacy"]').click();
                    setTimeout(() => {
                        const contactSection = document.querySelector('.contact-ref');
                        if (contactSection) {
                            contactSection.scrollIntoView({ behavior: 'smooth' });
                        }
                    }, 100);
                } else if (targetId === 'license' || targetId === 'obligations') {
                    // Pour les sections des Conditions
                    document.querySelector('[data-tab="terms"]').click();
                    setTimeout(() => {
                        const element = document.querySelector(`#terms h4:nth-of-type(${targetId === 'license' ? 3 : 4})`);
                        if (element) {
                            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }, 100);
                } else if (targetId === 'data-collection' || targetId === 'data-rights') {
                    // Pour les sections de la Politique
                    document.querySelector('[data-tab="privacy"]').click();
                    setTimeout(() => {
                        const sectionIndex = targetId === 'data-collection' ? 1 : 7;
                        const element = document.querySelector(`#privacy h4:nth-of-type(${sectionIndex})`);
                        if (element) {
                            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }, 100);
                } else {
                    // Pour les onglets principaux
                    document.querySelector(`[data-tab="${targetId}"]`).click();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });
        
        // Bouton retour en haut
        const backToTop = document.getElementById('backToTop');
        
        backToTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        
        // Afficher/masquer le bouton retour en haut
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.style.display = 'flex';
            } else {
                backToTop.style.display = 'none';
            }
        });
        
        // Initialisation : masquer le bouton au chargement
        backToTop.style.display = 'none';
        
        // Simulation d'acceptation des conditions (pour démonstration)
        console.log('Page Conditions d\'utilisation et Politique de confidentialité chargée');
        console.log('Pour un site réel, ajoutez un mécanisme d\'enregistrement du consentement conforme au RGPD');
    </script>
</body>
</html>
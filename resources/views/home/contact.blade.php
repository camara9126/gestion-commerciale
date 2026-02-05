<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous | B-manager</title>
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
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: linear-gradient(135deg, #00778b 0%, #ff9d1b 100%);
            color: white;
            padding: 30px 0;
            text-align: center;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .logo i {
            font-size: 2.5rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 50%;
        }
        
        .logo-text h1 {
            font-size: 2.2rem;
            margin-bottom: 5px;
        }
        
        .logo-text p {
            font-size: 1rem;
            opacity: 0.9;
        }
        
        .tagline {
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.9;
        }
        
        main {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            margin-top: 40px;
        }
        
        .contact-info {
            flex: 1;
            min-width: 300px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .contact-form {
            flex: 1;
            min-width: 300px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        h2 {
            color: #00778b;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eef2ff;
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
        }
        
        .info-icon {
            background: #eef2ff;
            color: #00778b;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .info-text h3 {
            margin-bottom: 5px;
            color: #333;
        }
        
        .info-text p {
            color: #666;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            background: #eef2ff;
            color: #00778b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            background: #00778b;
            color: white;
            transform: translateY(-3px);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }
        
        input, textarea, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.3s;
        }
        
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #00778b;
            box-shadow: 0 0 0 2px rgba(26, 58, 143, 0.1);
        }
        
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #00778b 0%, #ff9d1b 100%);
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn:hover {
            background: linear-gradient(135deg, #00778b 0%, #ff9d1b 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 58, 143, 0.2);
        }
        
        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            color: #666;
            border-top: 1px solid #eee;
        }
        
        @media (max-width: 768px) {
            main {
                flex-direction: column;
            }
            
            .contact-info, .contact-form {
                width: 100%;
            }
            
            .logo {
                flex-direction: column;
                text-align: center;
            }
        }
        
        .success-message {
            display: none;
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
            border: 1px solid #c3e6cb;
        }
        
        .required {
            color: #e74c3c;
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
            <p class="tagline">Optimisez votre gestion commerciale avec notre solution tout-en-un. Contactez-nous pour une démonstration gratuite.</p>
        </div>
    </header>
    
    <div class="container">
        <main>
            <section class="contact-info">
                <h2>Informations de contact</h2>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-text">
                        <h3>Adresse</h3>
                        <p>Corniche Diawling,<br>Sor, Saint-Louis</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="info-text">
                        <h3>Téléphone</h3>
                        <p>+221 33 485 65 23<br>Lun-Ven: 9h-18h</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-text">
                        <h3>Email</h3>
                        <p>contact@bcmgroupe.com<br>support@bcmgroupe.com</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="info-text">
                        <h3>Horaires d'ouverture</h3>
                        <p>Lundi - Vendredi: 9h00 - 16h00<br>Samedi: 10h00 - 14h00</p>
                    </div>
                </div>
                
                <h3 style="margin-top: 30px;">Suivez-nous</h3>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </section>
            
            <section class="contact-form">
                <h2>Envoyez-nous un message</h2>
                <p>Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
                
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Nom complet <span class="required">*</span></label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="company">Entreprise</label>
                        <input type="text" id="company" name="company">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Sujet <span class="required">*</span></label>
                        <select id="subject" name="subject" required>
                            <option value="" disabled selected>Sélectionnez un sujet</option>
                            <option value="demo">Demande de démonstration</option>
                            <option value="pricing">Demande de tarifs</option>
                            <option value="support">Support technique</option>
                            <option value="partnership">Partenariat</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message <span class="required">*</span></label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn">
                        <i class="fas fa-paper-plane"></i> Envoyer le message
                    </button>
                    
                    <div id="successMessage" class="success-message">
                        <i class="fas fa-check-circle"></i> Votre message a été envoyé avec succès. Nous vous répondrons dans les 24h.
                    </div>
                </form>
            </section>
        </main>
        
        <footer>
            <p>&copy; <?= now()->year ?> BusinessPro Manager. Tous droits réservés.</p>
            <p>Logiciel de gestion commerciale - CRM - Facturation - Suivi des stocks</p>
        </footer>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Récupérer les valeurs du formulaire
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            
            // Simulation d'envoi du formulaire
            // Dans un cas réel, vous enverriez les données à un serveur
            console.log('Formulaire soumis:');
            console.log('Nom:', name);
            console.log('Email:', email);
            console.log('Sujet:', subject);
            
            // Afficher le message de succès
            const successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';
            
            // Faire défiler jusqu'au message de succès
            successMessage.scrollIntoView({ behavior: 'smooth' });
            
            // Réinitialiser le formulaire après 3 secondes
            setTimeout(function() {
                document.getElementById('contactForm').reset();
            }, 3000);
        });
    </script>
</body>
</html>
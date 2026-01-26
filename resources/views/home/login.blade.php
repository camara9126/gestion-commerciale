<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | GestionPro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .container {
            display: flex;
            flex: 1;
            min-height: 100vh;
        }
        
        /* Section gauche avec formulaire */
        .form-section {
            flex: 1;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 500px;
            margin: 0 auto;
            width: 100%;
        }
        
        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 2.5rem;
            color: #3b82f6;
        }
        
        .logo i {
            font-size: 2rem;
            margin-right: 0.75rem;
        }
        
        .logo h1 {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .header-text h2 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }
        
        .header-text p {
            color: #64748b;
            margin-bottom: 2rem;
        }
        
        .form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #475569;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
        
        .input-with-icon input {
            width: 100%;
            padding: 12px 12px 12px 45px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        
        .input-with-icon input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
        }
        
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 8px;
        }
        
        .forgot-password {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .btn-primary {
            width: 100%;
            padding: 14px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 1.5rem;
        }
        
        .btn-primary:hover {
            background-color: #2563eb;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #94a3b8;
        }
        
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #e2e8f0;
        }
        
        .divider span {
            padding: 0 1rem;
            font-size: 0.9rem;
        }
        
        .social-login {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .social-btn {
            flex: 1;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .social-btn:hover {
            background-color: #f8fafc;
        }
        
        .social-btn i {
            margin-right: 8px;
            font-size: 1.1rem;
        }
        
        .google-btn {
            color: #db4437;
        }
        
        .microsoft-btn {
            color: #00a4ef;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #64748b;
        }
        
        .signup-link a {
            color: #3b82f6;
            font-weight: 500;
            text-decoration: none;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
        
        /* Section droite avec statistiques */
        .stats-section {
            flex: 1;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            display: none;
        }
        
        .stats-container {
            max-width: 500px;
            text-align: center;
        }
        
        .stats-container h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .stats-container p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .stat-item {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            backdrop-filter: blur(10px);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        /* Messages */
        .error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.25rem;
            display: none;
        }
        
        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            display: none;
        }
        
        .demo-credentials {
            background-color: #f0f9ff;
            border-left: 4px solid #3b82f6;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 4px;
        }
        
        .demo-credentials h4 {
            color: #1e40af;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .demo-credentials p {
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 0.25rem;
        }
        
        /* Responsive */
        @media (min-width: 992px) {
            .stats-section {
                display: flex;
            }
        }
        
        @media (max-width: 768px) {
            .form-section {
                padding: 2rem 1.5rem;
            }
            
            .social-login {
                flex-direction: column;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .input-with-icon.error input {
            border-color: #ef4444;
        }
        
        .footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #f1f5f9;
            color: #64748b;
            font-size: 0.9rem;
        }
        
        .footer a {
            color: #3b82f6;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Section formulaire -->
        <section class="form-section">
            <div class="logo">
                <i class="fas fa-chart-line"></i>
                <h1>GestionPro</h1>
            </div>
            
            <div class="header-text">
                <h2>Bienvenue à nouveau</h2>
                <p>Connectez-vous à votre compte pour accéder à votre espace de gestion.</p>
            </div>
            
            <!-- Message de succès (caché par défaut) -->
            <div class="success-message" id="successMessage">
                <i class="fas fa-check-circle"></i> Connexion réussie! Redirection vers votre tableau de bord...
            </div>
            
            <div class="form-container">
                @if ($errors->any())
                    <div style="color: red; margin-bottom: 10px;">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" :value="old('email')" required autofocus autocomplete="username"  placeholder="votre@email.com" class="mt-2">
                        </div>
                        <div class="error-message" id="emailError">Veuillez saisir une adresse email valide</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password"
                            required autocomplete="current-password" placeholder="Votre mot de passe" class="mt-2">
                            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                        </div>
                        <div class="error-message" id="passwordError">Veuillez saisir votre mot de passe</div>
                    </div>
                    
                    <div class="options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember">
                            <label for="remember">Se souvenir de moi</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-password">Mot de passe oublié ?</a>
                    </div>
                    
                    <button type="submit" class="btn-primary">Se connecter</button>
                </form>
                
                <div class="signup-link">
                    Vous n'avez pas encore de compte? <a href="{{ route('register') }}">Créer un compte</a>
                </div>
            </div>
        </section>
        
        <!-- Section statistiques (visible sur grands écrans) -->
        <section class="stats-section">
            <div class="stats-container">
                <h2>Rejoignez notre communauté</h2>
                <p>Des milliers de professionnels utilisent déjà GestionPro pour optimiser leur gestion d'entreprise au quotidien.</p>
                
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">5,000+</div>
                        <div class="stat-label">Entreprises</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Satisfaction clients</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-number">30%</div>
                        <div class="stat-label">Gain de temps moyen</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support disponible</div>
                    </div>
                </div>
                
                <div class="testimonial" style="margin-top: 3rem; font-style: italic; opacity: 0.9;">
                    <p>"GestionPro a transformé notre façon de travailler. La centralisation des données et les rapports automatisés nous font gagner un temps précieux chaque semaine."</p>
                    <p style="margin-top: 1rem; font-size: 0.9rem;">- Sophie Martin, Directrice financière</p>
                </div>
            </div>
        </section>
    </div>
    
    <footer class="footer">
        <p>© 2023 GestionPro. Tous droits réservés. | <a href="#">Politique de confidentialité</a> | <a href="#">Conditions d'utilisation</a> | <a href="#">Support</a></p>
    </footer>

    
</body>
</html>
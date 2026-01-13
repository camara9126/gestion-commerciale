<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte | GestionPro</title>
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
            max-width: 600px;
            margin: 0 auto;
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
        
        .terms {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .terms input {
            margin-right: 10px;
            margin-top: 4px;
        }
        
        .terms label {
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .terms a {
            color: #3b82f6;
            text-decoration: none;
        }
        
        .terms a:hover {
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
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #64748b;
        }
        
        .login-link a {
            color: #3b82f6;
            font-weight: 500;
            text-decoration: none;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        /* Section droite avec illustration */
        .illustration-section {
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
        
        .illustration-container {
            max-width: 500px;
            text-align: center;
        }
        
        .illustration-container h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .illustration-container p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .features {
            text-align: left;
            margin-top: 2rem;
        }
        
        .feature {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .feature i {
            font-size: 1.2rem;
            margin-right: 1rem;
            margin-top: 0.2rem;
            color: #93c5fd;
        }
        
        /* Responsive */
        @media (min-width: 992px) {
            .illustration-section {
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
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.25rem;
            display: none;
        }
        
        .input-with-icon.error input {
            border-color: #ef4444;
        }
        
        .success-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            display: none;
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
                <h2>Créez votre compte</h2>
                <p>Rejoignez notre plateforme de gestion d'entreprise et optimisez votre productivité.</p>
            </div>
            
            <!-- Message de succès (caché par défaut) -->
            <div class="success-message" id="successMessage">
                <i class="fas fa-check-circle"></i> Compte créé avec succès! Redirection...
            </div>
            
            <div class="form-container">
                <form id="signupForm" method="post" action="route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="fullName">Nom complet</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" id="name" name="name" placeholder="Jean Dupont" required>
                        </div>
                        <div class="error-message" id="nameError">Veuillez saisir votre nom complet</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="jean.dupont@entreprise.com" required>
                        </div>
                        <div class="error-message" id="emailError">Veuillez saisir une adresse email valide</div>
                    </div>
                    
                    <!--<div class="form-group">
                        <label for="company">Nom de l'entreprise</label>
                        <div class="input-with-icon">
                            <i class="fas fa-building"></i>
                            <input type="text" id="company" placeholder="Dupont & Cie" required>
                        </div>
                        <div class="error-message" id="companyError">Veuillez saisir le nom de votre entreprise</div>
                    </div>-->
                    
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Créez un mot de passe sécurisé" required>
                            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                        </div>
                        <div class="error-message" id="passwordError">Le mot de passe doit contenir au moins 8 caractères dont une majuscule et un chiffre</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmPassword">Confirmer le mot de passe</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
                        </div>
                        <div class="error-message" id="confirmPasswordError">Les mots de passe ne correspondent pas</div>
                    </div>
                    
                    <div class="terms">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">J'accepte les <a href="#">Conditions d'utilisation</a> et la <a href="#">Politique de confidentialité</a> de GestionPro.</label>
                    </div>
                    
                    <button type="submit" class="btn-primary">Créer mon compte</button>
                </form>
                
                <!--<div class="divider">
                    <span>Ou créer avec</span>
                </div>-->
                
                <!--<div class="social-login">
                    <button type="button" class="social-btn google-btn">
                        <i class="fab fa-google"></i> Google
                    </button>
                    <button type="button" class="social-btn microsoft-btn">
                        <i class="fab fa-microsoft"></i> Microsoft
                    </button>
                </div>-->
                
                <div class="login-link">
                    Vous avez déjà un compte? <a href="{{route('user')}}">Connectez-vous</a>
                </div>
            </div>
        </section>
        
        <!-- Section illustration (visible sur grands écrans) -->
        <section class="illustration-section">
            <div class="illustration-container">
                <h2>Optimisez la gestion de votre entreprise</h2>
                <p>Rejoignez des milliers d'entreprises qui utilisent déjà GestionPro pour simplifier leurs opérations quotidiennes.</p>
                
                <div class="features">
                    <div class="feature">
                        <i class="fas fa-chart-bar"></i>
                        <div>
                            <h3>Tableaux de bord personnalisés</h3>
                            <p>Visualisez vos données importantes en temps réel avec des graphiques interactifs.</p>
                        </div>
                    </div>
                    
                    <div class="feature">
                        <i class="fas fa-users-cog"></i>
                        <div>
                            <h3>Gestion d'équipe efficace</h3>
                            <p>Organisez vos collaborateurs et suivez leurs performances facilement.</p>
                        </div>
                    </div>
                    
                    <div class="feature">
                        <i class="fas fa-shield-alt"></i>
                        <div>
                            <h3>Sécurité des données</h3>
                            <p>Vos informations sont cryptées et protégées selon les normes les plus strictes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <footer class="footer">
        <p>© 2023 GestionPro. Tous droits réservés. | <a href="#">Politique de confidentialité</a> | <a href="#">Conditions d'utilisation</a></p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour afficher/masquer le mot de passe
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            
            // Validation du formulaire
            const form = document.getElementById('signupForm');
            const nameError = document.getElementById('nameError');
            const emailError = document.getElementById('emailError');
            const companyError = document.getElementById('companyError');
            const passwordError = document.getElementById('passwordError');
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            const successMessage = document.getElementById('successMessage');
            
            // Fonction de validation d'email
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(String(email).toLowerCase());
            }
            
            // Fonction de validation de mot de passe
            function validatePassword(password) {
                // Au moins 8 caractères, une majuscule et un chiffre
                const re = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
                return re.test(password);
            }
            
            // Validation en temps réel
            document.getElementById('fullName').addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.parentElement.classList.add('error');
                    nameError.style.display = 'block';
                } else {
                    this.parentElement.classList.remove('error');
                    nameError.style.display = 'none';
                }
            });
            
            document.getElementById('email').addEventListener('blur', function() {
                if (!validateEmail(this.value)) {
                    this.parentElement.classList.add('error');
                    emailError.style.display = 'block';
                } else {
                    this.parentElement.classList.remove('error');
                    emailError.style.display = 'none';
                }
            });
            
            document.getElementById('company').addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.parentElement.classList.add('error');
                    companyError.style.display = 'block';
                } else {
                    this.parentElement.classList.remove('error');
                    companyError.style.display = 'none';
                }
            });
            
            document.getElementById('password').addEventListener('blur', function() {
                if (!validatePassword(this.value)) {
                    this.parentElement.classList.add('error');
                    passwordError.style.display = 'block';
                } else {
                    this.parentElement.classList.remove('error');
                    passwordError.style.display = 'none';
                }
            });
            
            document.getElementById('confirmPassword').addEventListener('blur', function() {
                const password = document.getElementById('password').value;
                if (this.value !== password) {
                    this.parentElement.classList.add('error');
                    confirmPasswordError.style.display = 'block';
                } else {
                    this.parentElement.classList.remove('error');
                    confirmPasswordError.style.display = 'none';
                }
            });
            
            // Soumission du formulaire
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Réinitialiser les erreurs
                const errors = document.querySelectorAll('.error-message');
                errors.forEach(error => error.style.display = 'none');
                
                const inputs = document.querySelectorAll('.input-with-icon');
                inputs.forEach(input => input.classList.remove('error'));
                
                let isValid = true;
                
                // Validation des champs
                const fullName = document.getElementById('fullName').value.trim();
                const email = document.getElementById('email').value;
                const company = document.getElementById('company').value.trim();
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                const terms = document.getElementById('terms').checked;
                
                if (fullName === '') {
                    document.getElementById('fullName').parentElement.classList.add('error');
                    nameError.style.display = 'block';
                    isValid = false;
                }
                
                if (!validateEmail(email)) {
                    document.getElementById('email').parentElement.classList.add('error');
                    emailError.style.display = 'block';
                    isValid = false;
                }
                
                if (company === '') {
                    document.getElementById('company').parentElement.classList.add('error');
                    companyError.style.display = 'block';
                    isValid = false;
                }
                
                if (!validatePassword(password)) {
                    document.getElementById('password').parentElement.classList.add('error');
                    passwordError.style.display = 'block';
                    isValid = false;
                }
                
                if (password !== confirmPassword) {
                    document.getElementById('confirmPassword').parentElement.classList.add('error');
                    confirmPasswordError.style.display = 'block';
                    isValid = false;
                }
                
                if (!terms) {
                    alert('Veuillez accepter les conditions d\'utilisation');
                    isValid = false;
                }
                
                if (isValid) {
                    // Simulation d'envoi de formulaire
                    successMessage.style.display = 'block';
                    form.reset();
                    
                    // Redirection simulée après 2 secondes
                    setTimeout(() => {
                        alert('Compte créé avec succès! Dans une application réelle, vous seriez redirigé vers le tableau de bord.');
                        successMessage.style.display = 'none';
                    }, 2000);
                }
            });
            
            // Boutons de connexion sociale
            document.querySelector('.google-btn').addEventListener('click', function() {
                alert('Connexion avec Google - fonctionnalité à implémenter');
            });
            
            document.querySelector('.microsoft-btn').addEventListener('click', function() {
                alert('Connexion avec Microsoft - fonctionnalité à implémenter');
            });
        });
    </script>
</body>
</html>
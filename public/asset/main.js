        // Toggle sidebar sur mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.querySelector('.overlay').classList.toggle('active');
        });
        
        // Fermer sidebar quand on clique sur l'overlay
        document.querySelector('.overlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('active');
            this.classList.remove('active');
        });
        
        // Navigation entre sections
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Récupérer la section cible
                const targetSection = this.getAttribute('data-section');
                
                // Mettre à jour le titre de la page
                document.getElementById('pageTitle').textContent = this.textContent.trim();
                
                // Désactiver tous les liens
                document.querySelectorAll('.nav-link').forEach(navLink => {
                    navLink.classList.remove('active');
                });
                
                // Activer le lien cliqué
                this.classList.add('active');
                
                // Masquer toutes les sections
                document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.add('d-none');
                    section.classList.remove('active');
                });
                
                // Afficher la section cible
                document.getElementById(targetSection).classList.remove('d-none');
                document.getElementById(targetSection).classList.add('active');
                
                // Fermer sidebar sur mobile
                if (window.innerWidth < 768) {
                    document.getElementById('sidebar').classList.remove('active');
                    document.querySelector('.overlay').classList.remove('active');
                }
            });
        });
        
       
        
        // Gestion responsive
        window.addEventListener('resize', function() {
            // Si on passe en mode desktop, s'assurer que la sidebar est visible
            if (window.innerWidth >= 768) {
                document.getElementById('sidebar').classList.remove('active');
                document.querySelector('.overlay').classList.remove('active');
            }
        });
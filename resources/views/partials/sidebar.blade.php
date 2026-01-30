<div class="sidebar" id="sidebar">
        <div class="sidebar-header">
                @if(Auth::user()->entreprise?->logo)
                    <img src="{{ asset('storage/' . Auth::user()->entreprise->logo) }}" alt="Logo entreprise" class="w-50">
                @else
                    <h3 class="fw-bold text-warning mb-0">{{ ucfirst(Auth::user()->entreprise->nom) }}</h3>
                @endif
            <small class="text-white">{{ Auth::user()->entreprise->adresse }}</small>
        </div>

        @if($entreprise->isOnTrial()) 
            <div class="px-3 py-4">
                <marquee behavior="" direction="">Activer un abonnement</marquee>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class=" disabled nav-link" data-section="dashboard">
                            <i class="fas fa-home" style="color: #ff9d1b;"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="#" class=" disabled nav-link">
                            <i class="fas fa-list" style="color: #ff9d1b;"></i> Produits
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="#" class="disabled nav-link">
                            <i class="fas fa-truck" style="color: #ff9d1b;"></i> Fournisseurs
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="#" class=" disabled nav-link">
                            <i class="fas fa-bars-staggered" style="color: #ff9d1b;"></i> Stocks
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item mb-0 mt-0">
                        <a href="#" class=" disabled nav-link">
                            <i class="fas fa-users" style="color: #ff9d1b;"></i> Clients
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="#" class=" disabled nav-link">
                            <i class="fas fa-cart-arrow-down" style="color: #ff9d1b;"></i> Ventes & Factures
                        </a>
                    </li> 
                    <hr>
                    <li class="nav-item mb-0 mt-0">
                        <a href="#" class=" disabled nav-link" data-section="invoices">
                            <i class="fas fa-money-bill-1-wave" style="color: #ff9d1b;"></i> Paiements
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="#" class=" disabled nav-link" data-section="finance">
                            <i class="fas fa-right-left" style="color: #ff9d1b;"></i> Recettes
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="#" class=" disabled nav-link" data-section="finance">
                            <i class="fas fa-arrow-right-from-bracket" style="color: #ff9d1b;"></i> Depenses
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item mb-0 mt-0">
                        <a href="#" class=" disabled nav-link" data-section="reports">
                            <i class="fas fa-chart-bar" style="color: #ff9d1b;"></i> Rapports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class=" disabled nav-link" data-section="settings">
                            <i class="fas fa-cog" style="color: #ff9d1b;"></i> Compte
                        </a>
                    </li>                
            @else
                
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" class="nav-link" data-section="dashboard">
                            <i class="fas fa-home" style="color: #ff9d1b;"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="{{ route('produits.index') }}" class="nav-link">
                            <i class="fas fa-list" style="color: #ff9d1b;"></i> Produits
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="{{ route('fournisseurs.index') }}" class="nav-link">
                            <i class="fas fa-truck" style="color: #ff9d1b;"></i> Fournisseurs
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="{{ route('mouvements') }}" class="nav-link">
                            <i class="fas fa-bars-staggered" style="color: #ff9d1b;"></i> Stocks
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item mb-0 mt-0">
                        <a href="{{ route('clients.index') }}" class="nav-link">
                            <i class="fas fa-users" style="color: #ff9d1b;"></i> Clients
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="{{ route('ventes.index') }}" class="nav-link">
                            <i class="fas fa-cart-arrow-down" style="color: #ff9d1b;"></i> Ventes & Factures
                        </a>
                    </li> 
                    <hr>
                    <li class="nav-item mb-0 mt-0">
                        <a href="{{ route('paiements.index') }}" class="nav-link" data-section="invoices">
                            <i class="fas fa-money-bill-1-wave" style="color: #ff9d1b;"></i> Paiements
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="{{ route('recettes.index') }}" class="nav-link" data-section="finance">
                            <i class="fas fa-right-left" style="color: #ff9d1b;"></i> Recettes
                        </a>
                    </li>
                    <li class="nav-item mb-0 mt-0">
                        <a href="{{ route('depenses.index') }}" class="nav-link" data-section="finance">
                            <i class="fas fa-arrow-right-from-bracket" style="color: #ff9d1b;"></i> Depenses
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item mb-0 mt-0">
                        <a href="{{ route('dashboard.rapport') }}" class="nav-link" data-section="reports">
                            <i class="fas fa-chart-bar" style="color: #ff9d1b;"></i> Rapports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.compte') }}" class="nav-link" data-section="settings">
                            <i class="fas fa-cog" style="color: #ff9d1b;"></i> Compte
                        </a>
                    </li>
                
                
                    <!--<div class="border-top border-secondary">
                        <div class="d-flex align-items-center">
                            <div class="user-profile me-3">+</div>
                            <div>
                                <a href="{{ route('user.adduser') }}" class="nav-link" data-section="settings">
                                    <p class="mb-0 fw-bold">Nouveau utilisateur</p>
                                </a>
                            <small class="text-muted">Administrateur</small>
                            </div>
                        </div>
                    </div>-->
            
        @endif
                </ul>
            </div>
    </div>
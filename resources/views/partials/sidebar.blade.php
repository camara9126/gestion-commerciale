<div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3 class="mb-0">
                @if(Auth::user()->entreprise?->logo)
                    <a href=""><img src="{{ asset('storage/' . Auth::user()->entreprise->logo) }}" alt="Logo entreprise" class="w-50"></a>
                @else
                    <span class="fw-bold"><a href="{{ route('dashboard.index') }}">{{ Auth::user()->entreprise->nom }}</a></span>
                @endif
            </h3>
            <small class="text-white">{{ Auth::user()->entreprise->adresse }}</small>
        </div>
        
        <div class="px-3 py-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link active" data-section="dashboard">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produits.index') }}" class="nav-link">
                        <i class="fas fa-list"></i> Produits
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('fournisseurs.index') }}" class="nav-link">
                        <i class="fas fa-truck"></i> Fournisseurs
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mouvements') }}" class="nav-link">
                        <i class="fas fa-file-invoice"></i> Stock
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="{{ route('clients.index') }}" class="nav-link">
                        <i class="fas fa-users"></i> Clients
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ventes.index') }}" class="nav-link">
                        <i class="fas fa-shopping-cart"></i> Ventes & Facture
                    </a>
                </li> 
                <hr>
                <li class="nav-item">
                    <a href="{{ route('paiements.index') }}" class="nav-link" data-section="invoices">
                        <i class="fas fa-file-invoice"></i> Paiements
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('recettes.index') }}" class="nav-link" data-section="finance">
                        <i class="fas fa-shopping-cart"></i> Recettes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('depenses.index') }}" class="nav-link" data-section="finance">
                        <i class="fas fa-shopping-cart"></i> Depenses
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="{{ route('dashboard.rapport') }}" class="nav-link" data-section="reports">
                        <i class="fas fa-chart-bar"></i> Rapports
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-section="settings">
                        <i class="fas fa-cog"></i> Paramètres
                    </a>
                </li>
            </ul>
            
            <div class="border-top border-secondary">
                <div class="d-flex align-items-center">
                    <div class="user-profile me-3">AD</div>
                    <div>
                        <p class="mb-0 fw-bold">Admin User</p>
                        <small class="text-muted">Administrateur</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
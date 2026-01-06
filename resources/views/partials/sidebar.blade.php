<div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3 class="mb-0">
                @if(Auth::user()->entreprise?->logo)
                    <a href=""><img src="{{ asset('storage/' . Auth::user()->entreprise->logo) }}" alt="Logo entreprise" class="w-50"></a>
                @else
                    <span class="fw-bold"><a href="{{ route('dashboard') }}">{{ Auth::user()->entreprise->nom }}</a></span>
                @endif
            </h3>
            <small class="text-muted">{{ Auth::user()->entreprise->email }}</small>
        </div>
        
        <div class="px-3 py-4">
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('dashboard') }}" class="nav-link active" data-section="dashboard">
                        <i class="fas fa-home"></i> Tableau de bord
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="inventaire">
                        <i class="fas fa-users"></i> Inventaire
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="commercial">
                        <i class="fas fa-box"></i> Commercial
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="finance">
                        <i class="fas fa-shopping-cart"></i> Finance
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="invoices">
                        <i class="fas fa-file-invoice"></i> Factures
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="reports">
                        <i class="fas fa-chart-bar"></i> Rapports
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link" data-section="settings">
                        <i class="fas fa-cog"></i> Paramètres
                    </a>
                </li>
            </ul>
            
            <div class="mt-5 pt-4 border-top border-secondary">
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
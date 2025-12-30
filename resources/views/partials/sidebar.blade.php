<nav class="sidebar col-md-3 col-lg-2 d-md-block bg-dark text-white p-0">
                <div class="position-sticky">
                    <div class="p-4">
                        <h1 class="h4 mb-4">
                            <i class="fas fa-house me-2"></i>
                            <span class="fw-bold">{{Auth::user()->entreprise->nom}}</span>
                        </h1>
                        
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <a href="{{route('dashboard')}}" class="nav-link text-white active">
                                     Tableau de bord
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link text-white">
                                    <i class="fas fa-users me-2"></i> Clients
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{route('fournisseurs.index')}}" class="nav-link text-white" >
                                    <i class="fas fa-box me-2"></i> Inventaire
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link text-white">
                                    <i class="fas fa-shopping-cart me-2"></i> Commandes
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link text-white">
                                    <i class="fas fa-file-invoice me-2"></i> Factures
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link text-white">
                                    <i class="fas fa-chart-bar me-2"></i> Rapports
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="#" class="nav-link text-white">
                                    <i class="fas fa-cog me-2"></i> Paramètres
                                </a>
                            </li>
                        </ul>
                        
                        <div class="mt-5 pt-5 border-top border-secondary">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=Admin+User&background=4361ee&color=fff" 
                                     class="rounded-circle me-2" width="40" height="40" alt="Avatar">
                                <div>
                                    <p class="mb-0 fw-bold">Admin User</p>
                                    <small class="text-muted">Administrateur</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
@include('partials.header')
        
        <!-- Content Area -->
        <div class="container-fluid p-3 p-md-4" id="contentArea">
            <!-- Dashboard Section -->
            <section id="dashboard" class="content-section">
                <!-- Stats Row -->
                
                <!-- Recent Orders -->
                <div class="row">
                    <div class="col-12">
                        @if(Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @elseif(Session::has('danger'))
                                <div class="alert alert-danger" role="alert">
                                    {{ Session::get('danger') }}
                                </div>
                            @endif
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <!-- Section achats -->
                                <h3 class="mb-0">Achats</h3>
                                <a href="{{ route('achats.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus me-1"></i> Nouveau achat
                                </a>
                        </div>
                        <div class="stat-card">        
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <!--<nav class="navbar navbar-light bg-light">-->
                                            <form method="get" action="{{route('achats.search')}}" class="form-inline">
                                                
                                                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher par nom ou telephone..." aria-label="Search">                                                            
                                            
                                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>                                                    
                                                
                                            </form>
                                        <!--</nav> -->
                                        <table class="table data-table">
                                            <thead>
                                                <tr>
                                                   <th>Référence</th>
                                                    <th>Fournisseur</th>
                                                    <th>Date</th>
                                                    <th>Total</th>
                                                    <th>Statut</th>
                                                    <th>Details</th>
                                                    <th>Facture</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($achats as $a)
                                                    <tr>
                                                        <td><strong>{{ $a->reference }}</strong></td>

                                                        <td>{{ $a->fournisseur->nom ?? '-' }}</td>

                                                        <td>{{ $a->created_at->format('d/m/y') }}</td>

                                                        <td>{{ number_format($a->total, 0, ',', ' ') }} FCFA</td>

                                                        <td>
                                                            @if($a->statut == 'annule')
                                                                <span class="badge bg-danger">Impayé</span>
                                                            @elseif($a->statut == 'recu')
                                                                <span class="badge bg-success">Payé</span>
                                                            @else
                                                                <span class="badge bg-info">Partiel</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <!-- Facture -->
                                                            <a href="{{route('achats.show', $a->id)}}" class="mr-2" title="afficher la facture">
                                                                <span class="badge bg-warning">Afficher</span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if($a->facture)
                                                                <a href="{{ asset('storage/' . $a->facture) }}" target="_blank" class="mr-2" title="Voir la facture">
                                                                   <span class="badge bg-info">Voir facture</span>
                                                                </a>
                                                            @else
                                                                <span class="text-muted">Aucune facture</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <!-- Supprimer -->
                                                            <form action="{{ route('achats.destroy', $a->id) }}" 
                                                                method="POST" 
                                                                onsubmit="return confirm('Supprimer ?')">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button class="label bg-danger">
                                                                    Supprimer
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">
                                                            Aucun bon de commande trouvé
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                            {{$achats->links()}}
                                        </div>
                                </div>                                         
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>


@include('partials.footer')
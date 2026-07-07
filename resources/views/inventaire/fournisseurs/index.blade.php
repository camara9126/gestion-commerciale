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
                            <!-- Section Fournisseur -->
                                <h3 class="mb-0">Fournisseurs</h3>
                                <a href="" class="btn btn-success" data-bs-toggle="modal"  data-bs-target="#fournisseurModal">
                                    <i class="fas fa-plus me-1"></i> Nouveau fournisseur
                                </a>
                        </div>
                        <div class="stat-card">        
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <!--<nav class="navbar navbar-light bg-light">-->
                                            <form method="get" action="{{route('fournisseurs.search')}}" class="form-inline">
                                                
                                                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher par nom ou telephone..." aria-label="Search">                                                            
                                            
                                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>                                                    
                                                
                                            </form>
                                        <!--</nav> -->
                                        <table class="table data-table">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Telephone</th>
                                                    <th>Adresse</th>
                                                    <th>Email</th>
                                                    <th>Statut</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($fournisseurs as $f)
                                                <tr>
                                                    <td>{{$f->nom}}</td>
                                                    <td>{{$f->telephone}}</td>
                                                    <td>{{$f->adresse}}</td>
                                                    <td>{{$f->email}}</td>
                                                    <td>
                                                        @if($f->statut)
                                                            <span class="badge bg-success">Activé</span>
                                                            @else
                                                            <span class="badge bg-danger">Desactivé</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="" data-bs-toggle="modal" data-id="{{ $f->id }}" data-name="{{ $f->nom }}" data-phone="{{ $f->telephone }}" data-email="{{ $f->email }}" data-adress="{{$f->adresse }}" data-bs-target="#fournisseurEditModal">
                                                            <i class="fa fa-eye text-primary"></i>
                                                        </a>
                                                    </td>                                                        
                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" align="center">Donnee vide !</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                            {{$fournisseurs->links()}}
                                        </div>
                                </div>                                         
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>

            <!-- Nouveau fournisseur -->
            <div class="modal fade" id="fournisseurModal" tabindex="-1">
                <div class="modal-dialog">
                    <form method="post" action="{{route('fournisseurs.store')}}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Nouveau fournisseur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nom du fournisseur</label>
                                    <input type="text" name="nom" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Téléphone</label>
                                    <input type="text" name="telephone" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Adresse</label>
                                    <textarea name="adresse" id="" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit founisseur -->
            <div class="modal fade" id="fournisseurEditModal" tabindex="-1">
                <div class="modal-dialog">

                    <form method="post" id="editFournisseurForm" action="">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modification fournisseur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="id" id="founisseur_id">

                                <div class="mb-3">
                                    <label>Nom du founisseur</label>
                                    <input type="text" name="nom" id="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Téléphone</label>
                                    <input type="text" name="telephone" id="phone" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="form-label">Statut</label>
                                    <div class="col-6">
                                        <input type="radio" name="statut" value="0" class="form-radio">&nbsp;Inactive
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" name="statut" value="1" class="form-radio">&nbsp;Active
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Adresse</label>
                                    <textarea name="adresse" id="adress" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!--Recuperation des donnees founisseur pour l'Edit -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('fournisseurEditModal');
            const form = document.getElementById('editFournisseurForm');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                // Récupération des données
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const phone = button.getAttribute('data-phone');
                const adress = button.getAttribute('data-adress');
                
                // Remplir le formulaire
                modal.querySelector('#founisseur_id').value = id;
                modal.querySelector('#name').value = name;
                modal.querySelector('#phone').value = phone;
                modal.querySelector('#email').value = email;
                modal.querySelector('#adress').value = adress;
                
                // Mettre à jour l'action du formulaire avec l'ID récupéré
                const updateUrl = `/fournisseurs/${id}`;
                form.action = updateUrl;
            });
        });
    </script>

@include('partials.footer')
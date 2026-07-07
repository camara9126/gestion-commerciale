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
                        <!-- Section Produits -->
                        <h3 class="mb-0">Clients</h3>
                        <button  class="btn btn-success" data-bs-toggle="modal"  data-bs-target="#clientModal">
                            <i class="fas fa-plus me-1"></i> Nouveau client
                        </button>
                        </div>
                        <div class="stat-card">        
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="stat-card">
                                        
                                        <div class="table-responsive">
                                            <!--<nav class="navbar navbar-light bg-light">-->
                                                <form method="get" action="{{route('clients.search')}}" class="form-inline">
                                                   
                                                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher par nom client.." aria-label="Search">                                                            
                                                
                                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>                                                    
                                                       
                                                </form>
                                            <!--</nav>-->
                                            <table class="table data-table">
                                                <thead>
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Telephone</th>
                                                        <th>Email</th>
                                                        <th>Adresse</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($clients as $c)
                                                    <tr>
                                                        <td>{{$c->nom}}</td>
                                                        <td>{{$c->telephone ?? 'Vide'}}</td>
                                                        <td>{{$c->email ?? 'Vide'}}</td>
                                                        <td>{{$c->adresse ?? 'Vide'}}</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="#" data-bs-toggle="modal" data-id="{{ $c->id }}" data-name="{{ $c->nom }}" data-phone="{{ $c->telephone }}" data-email="{{ $c->email }}" data-adress="{{$c->adresse }}" data-bs-target="#clientEditModal">
                                                                        <i class="fa fa-eye text-primary"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <form action="{{route('clients.destroy', $c->id)}}" type="button" method="post" onsubmit="return confirm('Supprimer ?')">
                                                                     @csrf
                                                                    @method('DELETE')
                                                                        <button type="submit" class="btn btn-outline-danger">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
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
                                            {{$clients->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </section>

            <!-- Nouveau client -->
            <div class="modal fade" id="clientModal" tabindex="-1">
                <div class="modal-dialog">
                    <form method="post" action="{{route('clients.store')}}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Nouveau client</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nom du client</label>
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

            <!-- Edit client -->
            <div class="modal fade" id="clientEditModal" tabindex="-1">
                <div class="modal-dialog">

                    <form method="post" id="editClientForm" action="">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modification client</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="id" id="client_id">

                                <div class="mb-3">
                                    <label>Nom du client</label>
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


    <!--Recuperation des donnees client pour l'Edit -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('clientEditModal');
            const form = document.getElementById('editClientForm');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                // Récupération des données
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const phone = button.getAttribute('data-phone');
                const adress = button.getAttribute('data-adress');
                
                // Remplir le formulaire
                modal.querySelector('#client_id').value = id;
                modal.querySelector('#name').value = name;
                modal.querySelector('#phone').value = phone;
                modal.querySelector('#email').value = email;
                modal.querySelector('#adress').value = adress;
                
                // Mettre à jour l'action du formulaire avec l'ID récupéré
                const updateUrl = `/clients/${id}`;
                form.action = updateUrl;
            });
        });
    </script>
  @include('partials.footer')

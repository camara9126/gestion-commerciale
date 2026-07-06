@include('partials.header')
        
        <!-- Content Area -->
        <div class="container-fluid p-3 p-md-4" id="contentArea">
            <!-- Dashboard Section -->
            <section id="dashboard" class="content-section">   

                        @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @elseif(Session::has('danger'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('danger') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div style="color: red; margin-bottom: 10px;">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <!-- Section Produits -->
                         <div class="d-flex justify-content-between align-items-center mb-4">                          
                            <h3 class="mb-0">Produits</h3>
                            <a href="" class="btn btn-success" data-bs-toggle="modal"  data-bs-target="#produitModal">
                                <i class="fas fa-plus me-1"></i> Nouveau produit
                            </a>
                        </div>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <!--<nav class="navbar navbar-light bg-light">-->
                                        <form method="get" action="{{route('produits.search')}}" class="form-inline">
                                            
                                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher par nom produit ou fournisseur..." aria-label="Search">                                                            
                                        
                                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>                                                    
                                               
                                        </form>
                                    <!--</nav> -->
                                    <table class="table data-table">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Nom</th>
                                                <th>Fournisseur</th>
                                                <th>Prix d'achat</th>
                                                <th>Prix de vente</th>
                                                <th>Stock</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($produits as $p)
                                            <tr>
                                                <td>{{$p->code}}</td>
                                                <td>{{$p->nom}}</td>
                                                <td>{{$p->fournisseur->nom}}</td>
                                                <td>{{number_format($p->prix_achat, 0,'',' ')}} XOF</td>
                                                <td>{{number_format($p->prix_vente, 0,'',' ')}} XOF</td>
                                                <td>
                                                    @if($p->stock_min >= $p->stock)
                                                        <span class="badge bg-danger">Stock faible</span>
                                                    @else
                                                        {{$p->stock}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($p->statut)
                                                        <span class="badge bg-success">Actif</span>
                                                        @else
                                                        <span class="badge bg-danger">Inactif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <a href="" data-bs-toggle="modal" data-id="{{ $p->id }}" data-name="{{ $p->nom }}" data-fournisseur_id="{{ $p->fournisseur_id }}" data-price="{{ $p->prix_vente }}" data-stock_min="{{ $p->stock_min }}" data-bs-target="#produitEditModal">
                                                                <i class="fa fa-eye text-primary"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-4">
                                                             @if($p->statut)
                                                                <form action="{{route('produits.destroy', $p->id)}}" type="button" method="post" onsubmit="return confirm('Desactiver ?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-outline-danger" title="desactiver">
                                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </button>
                                                                </form>
                                                             @else
                                                                <form action="{{route('produits.destroy', $p->id)}}" type="button" method="post" onsubmit="return confirm('Activer ?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-outline-success" title="activer">
                                                                        <i class="fa-solid fa-check" aria-hidden="true"></i>
                                                                    </button>
                                                                </form>
                                                                @endif 
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
                                    {{$produits->links()}}
                                </div>  
                                
                                <!-- Nouveau produit -->
                                <div class="modal fade" id="produitModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form method="post" action="{{route('produits.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Nouveau produit</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label>Nom produit</label>
                                                        <input type="text" name="nom" class="form-control" required>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label>Prix Achat</label>
                                                                <input type="number" name="prix_achat" class="form-control">
                                                            </div>
                                                        
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label>Prix Vente</label>
                                                                <input type="number" name="prix_vente" class="form-control">
                                                            </div>  
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Stock Minimum</label>
                                                        <select name="stock_min" class="form-control">
                                                            <option value="5">5</option>
                                                            <option value="10">10</option>
                                                            <option value="20">20</option>
                                                            <option value="30">30</option>
                                                        </select>
                                                    </div>   

                                                    <div class="mb-3">
                                                        <label>Fournisseur</label>
                                                        <input type="text" name="fournisseur" class="form-control" placeholder="Nouveau fournisseur">
                                                        <select name="fournisseur_id" class="form-control">
                                                                <option value="">-- Selectionner un fournisseur --</option>
                                                            @foreach($fournisseurs as $f)
                                                                <option value="{{ $f->id }}">{{ $f->nom }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>                                                    

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Edit produit -->
                                <div class="modal fade" id="produitEditModal" tabindex="-1">
                                    <div class="modal-dialog">

                                        <form method="post" id="editproduitForm" action="" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modification produit</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <input type="hidden" name="id" id="produit_id">
                                                    <input type="hidden" name="id" id="fournisseur_id">

                                                    <div class="mb-3">
                                                        <label>Nom produit</label>
                                                        <input type="text" name="nom" id="name" class="form-control">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Prix</label>
                                                        <input type="text" name="prix_vente" id="price" class="form-control">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Stock Minimum</label>
                                                        <select name="stock_min" id="stock_min" class="form-control">
                                                            <option value="5">5</option>
                                                            <option value="10">10</option>
                                                            <option value="20">20</option>
                                                            <option value="30">30</option>
                                                        </select>
                                                    </div>  

                                                    <div class="mb-3">
                                                        <label>Fournisseur</label>
                                                        <select name="fournisseur_id" class="form-control">
                                                            @foreach($fournisseurs as $f)
                                                                <option value="{{ $f->id }}">{{ $f->nom }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>                 

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            </section>

    <!-- Donnees Formulaire Edit -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('produitEditModal');
            const form = document.getElementById('editproduitForm');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                // Récupération des données
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const price = button.getAttribute('data-price');
                const fournisseur_id = button.getAttribute('data-fournisseur_id');
                const stock_min = button.getAttribute('data-stock_min');
                
                // Remplir le formulaire
                modal.querySelector('#produit_id').value = id;
                modal.querySelector('#name').value = name;
                modal.querySelector('#price').value = price;
                modal.querySelector('#stock_min').value = stock_min;
                modal.querySelector('#fournisseur_id').value = fournisseur_id;
                
                // Mettre à jour l'action du formulaire avec l'ID récupéré
                const updateUrl = `/produits/${id}`;
                form.action = updateUrl;
            });
        });
    </script>
  @include('partials.footer')
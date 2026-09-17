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
                                <a href="{{ route('achats.index') }}" class="btn btn-danger">
                                    <i class="fas fa-plus me-1"></i> Retour
                                </a>
                        </div>
                        <div class="stat-card">        
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form action="{{ route('achats.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <!-- RECHERCHE -->
                                                <div class="col-4 mb-3">
                                                    <label>Recherche</label>
                                                    <input type="text" id="search" class="form-control" placeholder="rechercher un produit ...">
                                                </div>
                                                <!-- FOURNISSEUR -->
                                                <div class="col-4">
                                                    <div class="mb-3">
                                                        <label>Fournisseur</label>
                                                        <select name="fournisseur_id" class="form-control">
                                                            <option value="">-- Choisir un fournisseur --</option>
                                                            @foreach($fournisseurs as $fournisseur)
                                                                <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-2">
                                                    <div class="mt-4 mb-2">
                                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#fournisseurModal" style="padding: 6px 12px;">
                                                            + Nouveau fournisseur
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="list-group" id="results">
                                                                
                                                </div>
                                            </div>
                                                    
                                            <!-- TABLE produits -->
                                            <table class="table" id="table-produits">
                                                <thead>
                                                    <tr>
                                                        <th>produit</th>
                                                        <th>Prix achat</th>
                                                        <th>Quantité</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="produits[0][nom]" class="form-control produit-select">
                                                                <option value="">Choisir</option>
                                                                @foreach($produits as $produit)
                                                                    <option value="{{ $produit->id }}" data-prix_achat="{{ $produit->prix_achat }}">
                                                                        {{ $produit->nom }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <!-- <input type="text" name="produits[0][nom]" class="form-control" placeholder="nouveau produit" produit-select> -->
                                                        </td>

                                                        <td>
                                                            <input type="number" name="produits[0][prix_achat]" class="form-control prix_achat">
                                                        </td>

                                                        <td>
                                                            <input type="number" name="produits[0][quantite]" class="form-control quantite" value="1">
                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control total-ligne" readonly>
                                                        </td>

                                                        <td>
                                                            <button type="button" class="btn btn-danger remove">X</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <button type="button" id="addRow" class="btn btn-primary">+ nouveau produit</button>

                                            <!-- TOTAL GLOBAL -->
                                            <div class="mt-3 text-end">
                                                <h4>Total : <span id="total-global">0</span> FCFA</h4>
                                            </div>

                                            <!-- Facture Fournisseur -->
                                            <div class="mb-3">
                                                <label for="facture" class="form-label">
                                                    Facture du fournisseur
                                                </label>

                                                <input type="file"
                                                    name="facture"
                                                    id="facture"
                                                    class="form-control"
                                                    accept=".pdf,.jpg,.jpeg,.png">

                                                <small class="text-muted">
                                                    Facultatif — PDF, JPG ou PNG.
                                                </small>
                                            </div>
                                                
                                            <!-- NOTE -->
                                            <div class="mt-3">
                                                <label>Note</label>
                                                <textarea name="note" class="form-control"></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-success mt-3">
                                                Enregistrer
                                            </button>
                                        </form>
                                    </div>

                                    
                                </div>                                         
                            </div>
                        </div>
                        
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
                    </div>
                </div>
            </section>

     <!-- Bouton Ajouter ligne -->
    <script>

        let index = 1;

        // Ajouter ligne
        document.getElementById('addRow').addEventListener('click', function () {

            let row = `
        
            <tr>
                <td>
                    <input type="text" name="produits[${index}][nom]" class="form-control" placeholder="nouveau produit" produit-select>
                </td>

                <td>
                    <input type="number" name="produits[${index}][prix_achat]" class="form-control prix_achat">
                </td>

                <td>
                    <input type="number" name="produits[${index}][quantite]" class="form-control quantite" value="1">
                </td>

                <td>
                    <input type="number" class="form-control total-ligne" readonly>
                </td>

                <td>
                    <button type="button" class="btn btn-danger remove">X</button>
                </td>
            </tr>
            `;

            document.querySelector('#table-produits tbody').insertAdjacentHTML('beforeend', row);
            index++;
        });

        // Supprimer ligne
        document.addEventListener('click', function(e){
            if(e.target.classList.contains('remove')){
                e.target.closest('tr').remove();
                calculTotal();
            }
        });

        // Auto prix_achat
        document.addEventListener('change', function(e){
            if(e.target.classList.contains('produit-select')){
                let prix_achat = e.target.selectedOptions[0].dataset.prix_achat || 0;
                let row = e.target.closest('tr');

                row.querySelector('.prix_achat').value = prix_achat;
                calculLigne(row);
            }
        });

        // Calcul ligne
        document.addEventListener('input', function(e){
            if(e.target.classList.contains('quantite') || e.target.classList.contains('prix_achat')){
                let row = e.target.closest('tr');
                calculLigne(row);
            }
        });

        function calculLigne(row){
            let prix_achat = row.querySelector('.prix_achat').value || 0;
            let quantite = row.querySelector('.quantite').value || 0;

            let total = prix_achat * quantite;

            row.querySelector('.total-ligne').value = total;

            calculTotal();
        }

        // Calcul global
        function calculTotal(){
            let total = 0;

            document.querySelectorAll('.total-ligne').forEach(function(input){
                total += parseFloat(input.value) || 0;
            });

            document.getElementById('total-global').innerText = total.toLocaleString();
        }

    </script>

    <!-- Recherche produit -->
    <script>
        document.getElementById('search').addEventListener('keyup', function() {

            let query = this.value;

            if (query.length < 2) return;

            fetch(`/caisseSearch?q=${query}`)
                .then(res => res.json())
                .then(data => {

                    let results = document.getElementById('results');
                    results.innerHTML = '';

                    data.forEach(produit => {
                        results.innerHTML += `
                            <a href="#" class="list-group-item" onclick="selectproduit(${produit.id}, '${produit.nom}', ${produit.prix_achat})">
                                ${produit.nom} - ${produit.prix_achat} FCFA
                            </a>
                        `;
                    });
                });
        });
    </script>

    <!-- Recherche pour categorie "Service" et "B2C" -->
    <script>
        document.getElementById('achatSearch').addEventListener('keyup', function() {

            let query = this.value;

            if (query.length < 2) return;

            fetch(`/achatSearch?q=${query}`)
                .then(res => res.json())
                .then(data => {

                    let results = document.getElementById('results');
                    results.innerHTML = '';

                    data.forEach(produit => {
                        results.innerHTML += `
                            <a href="#" class="list-group-item" onclick="selectproduit(${produit.id}, '${produit.designation}', ${produit.prix_unitaire})">
                                ${produit.designation} - ${produit.prix_unitaire} FCFA
                            </a>
                        `;
                    });
                });
        });
    </script>


    <!-- Bouton ajouter produit rechercher -->
    <script>
        function selectproduit(id, nom, prix_achat) {
            console.log("Produit sélectionné :", nom);
            
            // Chercher une ligne vide
            let selectElement = document.querySelector('#table-produits select');
            
            if(selectElement && selectElement.value === "") {
                // Remplir la première ligne vide
                let row = selectElement.closest('tr');
                selectElement.value = id;
                row.querySelector('.prix_achat').value = prix_achat;
                row.querySelector('.quantite').value = 1;
                calculLigne(row);
            } else {
                // Vérifier si le produit existe déjà
                let existingProductRow = null;
                document.querySelectorAll('.produit-select').forEach(select => {
                    if(select.value == id) {
                        existingProductRow = select.closest('tr');
                    }
                });
                
                if(existingProductRow) {
                    // Augmenter la quantité
                    let qteInput = existingProductRow.querySelector('.quantite');
                    let nouvelleQte = (parseFloat(qteInput.value) || 0) + 1;
                    qteInput.value = nouvelleQte;
                    calculLigne(existingProductRow);
                } else {
                    // Ajouter une nouvelle ligne manuellement
                    let row = `
                        
                        <tr>
                            <td>
                                <select name="produits[${index}][nom]" class="form-control produit-select">
                                    <option value="">Choisir</option>
                                    @foreach($produits as $produit)
                                        <option value="{{ $produit->id }}" data-prix_achat="{{ $produit->prix_achat }}">
                                            {{ $produit->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="produits[${index}][prix_achat]" class="form-control prix_achat" value="${prix_achat}">
                            </td>
                            <td>
                                <input type="number" name="produits[${index}][quantite]" class="form-control quantite" value="1">
                            </td>
                            <td>
                                <input type="number" class="form-control total-ligne" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove">X</button>
                            </td>
                        </tr>
                    `;
                    
                    document.querySelector('#table-produits tbody').insertAdjacentHTML('beforeend', row);
                    
                    let newRow = document.querySelector('#table-produits tbody tr:last-child');
                    let select = newRow.querySelector('.produit-select');
                    select.value = id;
                    calculLigne(newRow);
                    
                    index++;
                }
            }
            
            // Nettoyer
            document.getElementById('results').innerHTML = '';
            document.getElementById('search').value = '';
        }
    </script> 


@include('partials.footer')
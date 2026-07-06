<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Facture N° : {{ $vente->reference }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:5px; }

        th { background:#f2f2f2; }
        /* Pied de page */
        .invoice-footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }
        
        .footer-left {
            display: flex;
            flex-direction: column;
        }
        
        .footer-right {
            text-align: right;
        }

        .status-paid {
            background-color: #2ecc71;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            justify-content: center;
        }
        
    </style>
</head>
<body>

    @if($vente->entreprise->logo)
        <img src="{{ public_path('storage/'. $vente->entreprise->logo) }}" style="width: 150px; height: 100px;" alt="Logo entreprise" class="">
    @else
        <h1 class="mb-0 text-center">{{ $vente->entreprise->nom }}</h1>
    @endif
<p>
    Ninea : {{ $vente->entreprise->ninea }} <br>
    Telephone : {{ $vente->entreprise->telephone }} <br>
    Adresse : {{ $vente->entreprise->adresse }}
</p>
<p>
    Facture N° : <b>{{ $vente->reference }}</b><br>
    Date : <?= date('d-m-Y') ?>
</p>

<hr>

<p>
    <b>Client :</b><br>
    {{ $vente->client->nom }}<br>
    {{ $vente->client->telephone ?? '' }}
</p>

<br>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unitaire (XOF)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vente->items as $item)
        <tr>
            <td>{{ $item->produit->nom }}</td>
            <td>{{ $item->quantite }}</td>
            <td>{{ number_format($item->prix_unitaire, 0, ',', ' ') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>

    @if($vente->entreprise->taux_tva > 1)
        <h4>TVA ({{$item->taux_tva}} %) : {{ number_format($item->montant_tva) }} XOF</h4>
    @endif
    <h2 style="color: red;">Total-HT : {{ number_format($vente->total, 0, ',', ' ') }} XOF</h2>

    @if($vente->entreprise->taux_tva > 1)
        <h2 style="color: red;">Total-TTC : {{ number_format($vente->total_ttc, 0, ',', ' ') }} XOF</h2>
    @endif
        <!-- Pied de page -->
        <div class="invoice-footer">
            <!--<div class="footer-left">
                <div>Solutions Pro - SAS au capital de 50 000 €</div>
                <div>RCS Paris 123 456 789 - TVA intracommunautaire FR 12 123456789</div>
            </div>-->
            <div class="footer-right">
                <div class="status-paid">FACTURE COMPLETE</div>
                <div style="margin-top: 10px; font-size: 12px;">Date de paiement: {{ $vente->created_at->format('d/m/Y') }}</div>
            </div>
        </div>
<p>
    Merci pour votre confiance.
</p>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">
</head>
<body>
    <div class="container-fluid py-5 hero-header">
            <div class="container py-5">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Paiement de l'abonnement <b>Biz-Manager</b></h5>
                                <p class="card-text">Votre pack est maintenant actif. Merci de nous faire confiance !</p>
                                <a href="{{route('dashboard.index')}}" class="btn btn-warning">Retour table de bord</a>
                            </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</body>
</html>
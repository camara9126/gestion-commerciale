<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaiementAbonnement extends Model
{
    protected $fillable = [
        'entreprise_id',
        'pack_id',
        'montant',
        'reference',
        'statut',
        'moyen_paiement'
    ];

    public function abonnement()
        {
            return $this->belongsTo(Abonnement::class);
        }
    
}
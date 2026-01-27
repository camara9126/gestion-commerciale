<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $fillable = [
        'entreprise_id',
        'pack_id',
        'montant',
        'date_debut',
        'date_fin',
        'statut',
    ];

     public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

     public function pack()
    {
        return $this->belongsTo(Pack::class);
    }
}

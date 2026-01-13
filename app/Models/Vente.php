<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = [
        'entreprise_id',
        'client_id',
        'reference',
        'date',
        'total',
        'statut',
        'user_id',
        'total_tva',
        'total_ttc',
    ];


    public function items()
    {
        return $this->hasMany(VenteItem::class);
    }


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiements::class);
    }
}



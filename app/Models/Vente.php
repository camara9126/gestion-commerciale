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
    ];

    public function items()
    {
        return $this->hasMany(VenteItem::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

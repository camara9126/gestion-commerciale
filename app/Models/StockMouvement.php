<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMouvement extends Model
{
    protected $fillable = [
        'entreprise_id',
        'produit_id',
        'type',
        'quantite',
        'reference',
        'note',
        'user_id',
    ];

    public function produit()
    {
        return $this->belongsTo((Produit::class));
    } 
}

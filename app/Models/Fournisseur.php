<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'entreprise_id',
        'nom',
        'telephone',
        'email',
        'adresse',
        'statut',
    ];

    public function entreprise()
    {
        return $this->belongsTo((Entreprise::class));
    }

    public function produit()
    {
        return $this->hasMany(Produit::class);
    }
}

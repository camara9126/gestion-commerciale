<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'telephone',
        'adresse',
        'devise',
        'logo',
        'statut',
        'taux_tva',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    //Recette
    public function recettes()
    {
        return $this->hasMany(Recette::class);
    }

    // Depense
    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    // Total recette encaisse
    public getTotalRecettesAttribute()
    {
        return $this->recettes()->where('statut', 'recu')->sum('montant');
    }

    // Total depense
    public function getTotalDepensesAttribute()
    {
        return $this->depenses()->sum('montant');
    }
}

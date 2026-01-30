<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $fillable = [
        'nom',
        'prix',
        'limites',
        'max_client',
        'max_produit',
        'max_user',
    ];

    public function entreprises()
    {
        return $this->hasMany(Entreprise::class);
    }
}

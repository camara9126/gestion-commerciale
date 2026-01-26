<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $fillable = [
        'nom',
        'prix',
        'limites',
    ];

    public function entreprises()
    {
        return $this->hasMany(Entreprise::class);
    }
}

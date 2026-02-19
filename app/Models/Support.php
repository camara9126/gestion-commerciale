<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'entreprise_id',
        'nom_complet',
        'email',
        'telephone',
        'urgence',
        'description',
        'image',
        'statut',
    ];

        public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}

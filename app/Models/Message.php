<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'nom_complet',
        'email',
        'entreprise',
        'sujet',
        'message',
        'statut',
    ];
}

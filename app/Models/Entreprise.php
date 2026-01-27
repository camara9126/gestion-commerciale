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
        'pack_id',
        'abonnement_expire_le',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }

     public function abonnementActif()
    {
        return $this->hasOne(Abonnement::class)->where('statut', 'actif')->where('date_fin', '>=', now());
    }

    public function isOnTrial()
    {
        return $this->trial_actif && $this->trial_fin >= now();
    }

    public function trialExpire()
    {
        return $this->trial_actif && $this->trial_fin < now();
    }

    public function abonnementValide()
    {
        return $this->abonnement_expire_le && $this->abonnement_expire_le >= now();
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

     // Rendre les indicateurs accessibles partout
    protected $appends = [
        'total_depenses',
        'total_recettes',
        'tresorerie',
        'resultat',
        'statut_solvabilite',
    ];

    // Total recettes encaisse
    public function getTotalRecettesAttribute()
    {
        return $this->recettes()->where('statut','recu')->sum('montant');
    }

    // Total depense 
    public function getTotalDepensesAttribute()
    {
        return $this->depenses()->sum('montant');
    }

    // Tresorerie nette
    public function getTresorerieAttribute()
    {
        return $this->total_recettes - $this->total_depenses;
    }

    // Resultat (benefice/perte)
     public function getResultatAttribute()
    {
        return $this->total_recettes - $this->total_depenses;
    }

    // Statut solvabilite
    public function getStatutSolvabiliteAttribute()
    {
        if($this->tresorerie > 0) {
            return 'solvable';
        }

        if($this->tresorerie == 0) {
            return 'equilibre';
        }

        return 'insolvable';
    }

   
}

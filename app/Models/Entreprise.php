<?php

namespace App\Models;

use Carbon\Carbon;
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
        'trial_fin',
        'trial_actif',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function abonnementExpireBientot()
    {
        if (!$this->abonnement_expire_le) {
            return false;
        }

        $joursRestants = Carbon::now()->diffInDays(
            Carbon::parse($this->abonnement_expire_le),
            false
        );

        return $joursRestants >= 0 && $joursRestants <= 5;
    }

    public function joursRestantsAbonnement()
    {
        if (!$this->abonnement_expire_le) {
            return null;
        }

        return Carbon::now()->startOfDay()->diffInDays(
            Carbon::parse($this->abonnement_expire_le)->startOfDay(),
            false
        );
    }

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }

     public function abonnementActif()
    {
        return $this->hasOne(Entreprise::class)->where('id', '!=', 2)->where('trial_actif', true);
    }
    
    public function abonnementValide() : bool
    {
        return $this->abonnements()->where('id', '!=', 2)->where('statut', 'payé')->where('date_fin', '>=', now())->exists(); // Exp : le 15/01 > aujourd'hui(05/01)
    }

    public function isOnTrial() : bool
    {
        return $this->trial_actif &&  $this->trial_fin >= now(); // Exp : le 15/01 > aujourd'hui(05/01)
    }

    public function trialExpire() : bool
    {
        return $this->trial_actif && $this->trial_fin < now(); // Exp : le 15/01 < aujourd'hui(25/01)
    }

    

    


    //Recette
    public function recettes()
    {
        return $this->hasMany(Recette::class);
    }

    public function items()
    {
        return $this->hasMany(VenteItem::class);
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
        return $this->recettes()->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->where('statut','recu')->sum('montant');
    }

    // Total depense 
    public function getTotalDepensesAttribute()
    {
        return $this->depenses()->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('montant');
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

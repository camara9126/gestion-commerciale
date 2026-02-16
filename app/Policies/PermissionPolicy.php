<?php

namespace App\Policies;

use App\Models\User;

class PermissionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function isAdmin($user)
    {
        return in_array($user->role, ['admin', 'gestionnaire de stock']);
    }

    // Produits / fournisseurs / stock
    public function gererStock($user)
    {
        return in_array($user->role, ['admin', 'gestionnaire de stock']);
    }

    // Client / ventes
    public function gererVentes($user)
    {
        return in_array($user->role, ['admin', 'caissier']);
    }
}

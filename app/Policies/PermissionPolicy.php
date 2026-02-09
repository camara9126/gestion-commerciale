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
        return $user->role === 'admin';
    }

    // Produits / fournisseurs / stock
    public function gererStock($user)
    {
        return in_array($user->role, ['admin', 'gestionnaire_stock']);
    }

    // Client / ventes
    public function gererVentes($user)
    {
        return in_array($user->role, ['admin', 'caissier']);
    }
}

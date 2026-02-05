<?php

namespace App\Policies;

use App\Models\Pengembalian;
use App\Models\User;

class PengembalianPolicy
{
    public function confirm(User $user, Pengembalian $pengembalian): bool
    {
        return $user->isOperator() || $user->isAdmin();
    }

    public function view(User $user, Pengembalian $pengembalian): bool
    {
        return $user->id === $pengembalian->user_id || 
               $user->isOperator() || 
               $user->isAdmin();
    }
}

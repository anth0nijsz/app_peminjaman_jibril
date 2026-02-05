<?php

namespace App\Policies;

use App\Models\Peminjaman;
use App\Models\User;

class PeminjamanPolicy
{
    public function view(User $user, Peminjaman $peminjaman): bool
    {
        return $user->id === $peminjaman->user_id || 
               $user->isOperator() || 
               $user->isAdmin();
    }

    public function approve(User $user, Peminjaman $peminjaman): bool
    {
        return $user->isOperator() || $user->isAdmin();
    }

    public function update(User $user, Peminjaman $peminjaman): bool
    {
        return $user->id === $peminjaman->user_id && $peminjaman->status === 'pending';
    }

    public function delete(User $user, Peminjaman $peminjaman): bool
    {
        return $user->id === $peminjaman->user_id && $peminjaman->status === 'pending';
    }
}

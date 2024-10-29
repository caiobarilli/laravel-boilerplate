<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'user:create');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function read(User $user, User $model): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'user:view');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'user:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasTeamPermission($user->currentTeam, 'user:delete');
    }
}

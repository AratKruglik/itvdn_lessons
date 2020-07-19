<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @return mixed
     */
    public function update(User $user): bool
    {
        return $user->is_admin || $user->is_manager;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @return mixed
     */
    public function delete(User $user): bool
    {
        return $user->is_admin || $user->is_manager;
    }
}

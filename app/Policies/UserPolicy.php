<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\Models\User  $currentUser
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->hasRole('admin') || $currentUser->hasRole('editor');
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\Models\User  $currentUser
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $currentUser, User $user)
    {
        return $currentUser->hasRole('admin');
    }

    /**
     * Determine whether the user can create a user.
     *
     * @param  \App\Models\User  $currentUser
     * @return mixed
     */
    public function create(User $currentUser)
    {
        return $currentUser->hasRole('admin');
    }
}


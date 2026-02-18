<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine if user can view any users
     */
    public function viewAny(User $user)
    {
        return $user->can('view users');
    }

    /**
     * Determine if user can view a specific user
     */
    public function view(User $user, User $model)
    {
        return $user->can('view users');
    }

    /**
     * Determine if user can create users
     */
    public function create(User $user)
    {
        return $user->can('create users');
    }

    /**
     * Determine if user can update a user
     */
    public function update(User $user, User $model)
    {
        return $user->can('edit users');
    }

    /**
     * Determine if user can delete a user
     */
    public function delete(User $user, User $model)
    {
        return $user->can('delete users');
    }
}

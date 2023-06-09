<?php

namespace App\Policies;

use App\Models\Stage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('stage', 'admin') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Stage $stage)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('add stage', 'admin') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Stage $stage)
    {
        return $user->hasPermissionTo('edit stage', 'admin') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Stage $stage)
    {
        return $user->hasPermissionTo('delete stage', 'admin') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Stage $stage)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Stage $stage)
    {
        //
    }
}

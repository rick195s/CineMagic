<?php

namespace App\Policies;

use App\Models\Filme;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilmePolicy
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
        if (!$user->isAdmin()) {
            return $this->deny(__("Only admins can view all movies"));
        }
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Filme $filme)
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
        if (!$user->isAdmin()) {
            return $this->deny(__("Only admins can create movies"));
        }
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Filme $filme)
    {
        //
        if (!$user->isAdmin()) {
            return $this->deny(__("Only admins can update movies"));
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Filme $filme)
    {
        if (!$user->isAdmin()) {
            return $this->deny(__("Only admins can delete movies"));
        }
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Filme $filme)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Filme $filme)
    {
        //
    }
}

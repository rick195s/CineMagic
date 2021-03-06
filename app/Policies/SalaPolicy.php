<?php

namespace App\Policies;

use App\Models\Sala;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalaPolicy
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
            return $this->deny(__("Only admins can view movie theaters"));
        }
        return true;
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
            return $this->deny(__("Only admins can create movie theaters"));
        }
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Sala $sala)
    {
        if (!$user->isAdmin()) {
            return $this->deny(__("Only admins can update movie theaters"));
        }

        if ($sala->sessoes && count($sala->sessoes ?? []) > 0) {
            return $this->deny(__("Only movie theaters without future sessions can be updated"));
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Sala $sala)
    {
        if (!$user->isAdmin()) {
            return $this->deny(__("Only admins can delete movie theaters"));
        }

        if ($sala->sessoes && count($sala->sessoesFuturas ?? [])  > 0) {
            return $this->deny(__("Only movie theaters without future sessions can be deleted"));
        }

        return true;
    }
}

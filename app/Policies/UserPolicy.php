<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->isAdmin();
    }

    /**
     * Só os administradores é que podem ver perfis no dashboard
     * e não podem ver perfis de Clientes
     * 
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $searchedUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $searchedUser)
    {
        if (!$user->isAdmin()) {
            return $this->deny(__("Just admins can view employees and admins"));
        }

        if ($searchedUser->isClient()) {
            return $this->deny(__("Admins cannot view clients profiles"));
        }
        return  true;
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
            return $this->deny(__("Just admins can create employees and admins"));
        }
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        //
        return true;
    }

    /**
     * Só os admins é que podem desbloquear ou bloquear um user
     * Admins não se podem bloquear ou desbloquear a eles próprios
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $userToDelete
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update_state(User $user, User $userToDelete)
    {
        if (!$user->isAdmin()) {
            return $this->deny(__("Just the admins can block or unlock users"));
        }

        if ($user->id == $userToDelete->id) {
            return $this->deny(__("A User cannot block or unlock himself"));
        }

        return true;
    }

    /**
     * So admins é que podem eliminar outros utilizadores
     * Admins não se podem eliminar a eles próprios
     * Admins não podem eliminar users já eliminados
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $userToDelete
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $userToDelete)
    {
        if (!$user->isAdmin()) {
            return $this->deny(__("Just the admins can delete users"));
        }

        if ($user->id == $userToDelete->id) {
            return $this->deny(__("A User cannot delete himself"));
        }

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}

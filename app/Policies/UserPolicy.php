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
        if (!$user->isAdmin()) {
            return $this->deny(__("Only admins can view all users"));
        }
        return true;
    }

    /**
     * Os administradores so podem ver administradores e funcionarios
     *
     * Os funcionarios so podem ver os seus próprios dados e dados dos clientes
     * (precisam de ver os dos clientes porque quando estiverem a controlar uma sessao
     * eles podem ver os dados dos clientes)
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $searchedUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $searchedUser)
    {
        if ($user->isAdmin() && ($searchedUser->isAdmin() || $searchedUser->isEmployee())) {
            return true;
        }

        if ($user->isEmployee() && ($searchedUser->id == $user->id || $searchedUser->isClient())) {
            return true;
        }

        return false;
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
            return $this->deny(__("Only admins can create employees and admins"));
        }
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $userToUpdate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $userToUpdate)
    {

        if (!$user->isAdmin()) {
            return $this->deny(__("Only the admins can update users"));
        }
        if ($userToUpdate->isClient()) {
            return $this->deny(__("Admins cannot update clients"));
        }

        return true;
    }

    /**
     * Só os admins é que podem desbloquear ou bloquear um user
     * Admins não se podem bloquear ou desbloquear a eles próprios
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $userModified
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateState(User $user, User $userModified)
    {
        if (!$user->isAdmin()) {
            return $this->deny(__("Only the admins can block or unlock users"));
        }

        if ($user->id == $userModified->id) {
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
     * @param  \App\Models\User  $userModified
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $userModified)
    {

        if (!$user->isAdmin()) {
            return $this->deny(__("Only the admins can delete users"));
        }

        if ($user->id == $userModified->id) {
            return $this->deny(__("A User cannot delete himself"));
        }

        return true;
    }
}

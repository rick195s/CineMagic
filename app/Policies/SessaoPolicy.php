<?php

namespace App\Policies;

use App\Models\Sessao;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessaoPolicy
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
        if (!$user->isAdmin() && !$user->isFuncionario()) {
            return $this->deny(__("Only admins and employees can view all sessions"));
        }
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Sessao $sessao)
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Sessao $sessao)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Sessao $sessao)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Sessao $sessao)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Sessao $sessao)
    {
        //
    }

    public function selectSeat(?User $user, Sessao $sessao)
    {
        if (!$sessao->disponivel()) {
            return $this->deny(__('Cannot add old sessions to cart'));
        }
        return true;
    }

    public function validateSession(User $user, Sessao $sessao)
    {
        if (!$user->isAdmin() && !$user->isFuncionario()) {
            return $this->deny(__('Only admins and employees can validate sessions'));
        }
        if (!$sessao->disponivel(20)) {
            return $this->deny(__('Session no longer available'));
        }
        return true;
    }
}

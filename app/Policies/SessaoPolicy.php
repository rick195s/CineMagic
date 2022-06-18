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
        if (!$user->isAdmin() && !$user->isEmployee()) {
            return $this->deny(__("Only admins and employees can view all sessions"));
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
            return $this->deny(__("Only admins can create sessions"));
        }

        return true;
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
        if (!$user->isAdmin()) {
            return $this->deny(__("Only admins can create sessions"));
        }

        if ($sessao->bilhetes->count() > 0) {
            return $this->deny(__("Session has tickets"));
        }

        return true;
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
        if (!$user->isAdmin()) {
            return $this->deny(__("Only admins can delete sessions"));
        }

        if ($sessao->bilhetes->count() > 0) {
            return $this->deny(__("Session has tickets"));
        }

        return true;
    }

    /**
     * Verificar se um utilizador pode selecionar um lugar numa sessao
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function selectSeat(?User $user, Sessao $sessao)
    {
        if (!$sessao->disponivel()) {
            return $this->deny(__('Cannot select seats for old sessions'));
        }

        // Um user so pode adicionar sessoes ao carrinho se a sessao nao estiver ja cheia
        if ($sessao->num_lugares() == $sessao->bilhetes->count()) {
            return $this->deny(__('Session is full'));
        }
        return true;
    }

    /**
     * Verificar se um utilizador pode controlar as entradas de uma sessao
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function manage(User $user, Sessao $sessao)
    {
        if (!$user->isEmployee()) {
            return $this->deny(__('Only employees can manage sessions'));
        }

        if (!$sessao->disponivel()) {
            return $this->deny(__('Cannot manage old sessions'));
        }
        return true;
    }
}

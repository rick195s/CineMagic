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
            return $this->deny(__('Cannot select seats for old sessions'));
        }

        // Um user so pode adicionar sessoes ao carrinho se a sessao nao estiver ja cheia
        if ($sessao->num_lugares() == $sessao->bilhetes->count()) {
            return $this->deny(__('Session is full'));
        }
        return true;
    }
}

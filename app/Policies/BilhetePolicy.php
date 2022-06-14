<?php

namespace App\Policies;

use App\Models\Bilhete;
use App\Models\Sessao;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BilhetePolicy
{
    use HandlesAuthorization;

    /**
     * Verificar se o utilizador pode alterar o estado de um bilhete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function use(User $user, Bilhete $bilhete, $sessao_id)
    {
        if ($bilhete->usado()) {
            return $this->deny(__('Ticket already used'));
        }

        if (!$user->isEmployee()) {
            return $this->deny(__('Only employees can manage sessions'));
        }

        if ($bilhete->sessao_id != $sessao_id) {
            return $this->deny(__("Cannot use ticket from a session that you're not managing"));
        }

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bilhete  $bilhete
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // Policy to check if the user can view a bilhete
    public function view(User $user, Bilhete $bilhete)
    {
        return  $user->id == $bilhete->user->id;
    }
}

<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
{
    use HandlesAuthorization;

    /**
     * Só os clientes podem ver os seus perfis no front
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->isClient();
    }

    public function update(User $user, Cliente $cliente)
    {
        return $user->isClient() && $user->id == $cliente->id;
    }
}

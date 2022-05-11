<?php

namespace App\Policies;

use App\Models\Bilhete;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BilhetePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // Policy to check if the user can view a bilhete
    public function view(User $user, Bilhete $bilhete)
    {
        return  $user->tipo == 'A' || $user->tipo == 'F' || $user->cliente->id == $bilhete->cliente_id;
    }
}

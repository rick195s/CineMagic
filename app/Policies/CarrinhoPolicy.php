<?php

namespace App\Policies;

use App\Models\Carrinho;
use App\Models\Sessao;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarrinhoPolicy
{
    use HandlesAuthorization;

    public function adicionar(?User $user, Carrinho $carrinho, Sessao $sessao)
    {
        // Um user nao pode adicionar a mesma sessao varias vezes ao carrinho
        if (isset($carrinho->items[$sessao->id])) {
            return $this->deny(__('Session already added to cart'));
        }
        return true;
    }
}

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

        // Um user so pode adicionar sessoes ao carrinho se a sessao nao estiver ja cheia
        if ($sessao->lugares_ocupados == count((array) $sessao->bilhetes)) {
            return $this->deny(__('Session is full'));
        }

        // Um user pode adicionar à sessão se nao tiver começado há 5 minutos. 
        // Se já começõu há mais de 5 minutos, não pode adicionar
        if ($sessao->data < now() || ($sessao->data == now() && $sessao->horario_inicio <= now()->subMinutes(5))) {
            return $this->deny(__('Cannot add old sessions to cart'));
        }

        return true;
    }
}

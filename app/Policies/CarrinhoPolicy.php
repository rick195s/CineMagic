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
        if (isset($carrinho->sessoes[$sessao->id])) {
            return $this->deny(__('Session already added to cart'));
        }

        // Um user so pode adicionar sessoes ao carrinho se a sessao nao estiver ja cheia
        if ($sessao->num_lugares() == $sessao->bilhetes->count()) {
            return $this->deny(__('Session is full'));
        }

        // Um user só pode adicionar a sessão ao carrinho se tiver começado há menos de 5 minutos. 
        // Se já começõu há mais de 5 minutos, não pode adicionar
        if (
            $sessao->data < now()->format('Y-m-d')
            || ($sessao->data == now()->format('Y-m-d') && $sessao->horario_inicio <= now()->subMinutes(5)->format('H:i:s'))
        ) {
            return $this->deny(__('Cannot add old sessions to cart'));
        }

        return true;
    }
}

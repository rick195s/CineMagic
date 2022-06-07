<?php

namespace App\Policies;

use App\Models\Carrinho;
use App\Models\Lugar;
use App\Models\Sessao;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarrinhoPolicy
{
    use HandlesAuthorization;

    public function adicionarSessao(?User $user, Carrinho $carrinho, Sessao $sessao)
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
        if (!$sessao->disponivel()) {
            return $this->deny(__('Cannot add old sessions to cart'));
        }

        return true;
    }

    public function adicionarLugar(?User $user, Carrinho $carrinho, Sessao $sessao, Lugar $lugar)
    {
        // Um user nao pode adicionar o mesmo lugar para a mesma sessao varias vezes ao carrinho
        if (isset($carrinho->lugares[$sessao->id][$lugar->id])) {
            return $this->deny(__('Seat already added to cart'));
        }

        // Um user nao pode adicionar o lugar ao carrinho se ele ja tiver um bilhete para a sessao associado
        if ($sessao->ocupado($lugar->id)) {
            return $this->deny(__('Seat already reserved'));
        }


        return true;
    }

    public function confirmarCompra(User $user, Carrinho $carrinho)
    {

        if ($carrinho->vazio()) {
            return $this->deny(__('Cart is empty'));
        }

        return true;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Lugar;
use App\Models\Sessao;
use Illuminate\Auth\Access\AuthorizationException;

class CarrinhoController extends Controller
{
    /**
     * Adiciona uma sessao ao carrinho
     *
     * @return \Illuminate\Http\Response
     */
    public function adicionarSessao(Sessao $sessao)
    {
        $carrinho = session()->get('carrinho', new Carrinho());
        // usamos try catch para conseguirmos apanhar a mensagem de erro enviada pela policy 
        // e enviar para a vista anterior do utilizador
        try {
            $this->authorize('adicionarSessao', [$carrinho, $sessao]);
        } catch (AuthorizationException $th) {
            return back()->with('error', $th->getMessage());
        }

        $carrinho->adicionarSessao($sessao);

        return back()->with('success', __('Session added to cart'));
    }

    /**
     * Adiciona um lugar ao carrinho
     *
     * @return \Illuminate\Http\Response
     */
    public function adicionarLugar(Sessao $sessao, Lugar $lugar)
    {
        $carrinho = session()->get('carrinho', new Carrinho());
        // usamos try catch para conseguirmos apanhar a mensagem de erro enviada pela policy 
        // e enviar para a vista anterior do utilizador
        try {
            $this->authorize('adicionarLugar', [$carrinho, $sessao, $lugar]);
        } catch (AuthorizationException $th) {
            return back()->with('error', $th->getMessage());
        }

        $carrinho->adicionarLugar($sessao, $lugar);

        return back()->with('success', __('Ticket added to cart'));
    }
}

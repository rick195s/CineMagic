<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use App\Models\Carrinho;
use App\Models\Sessao;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    /**
     * Adiciona uma sessao ao carrinho
     *
     * @return \Illuminate\Http\Response
     */
    public function addSessao(Sessao $sessao)
    {
        $carrinho = session()->get('carrinho', new Carrinho());
        // usamos try catch para conseguirmos apanhar a mensagem de erro enviada pela policy 
        // e enviar para a vista anterior do utilizador
        try {
            $this->authorize('adicionar', [$carrinho, $sessao]);
        } catch (AuthorizationException $th) {
            return back()->with('error', $th->getMessage());
        }

        $carrinho->adicionarSessao($sessao);

        return back()->with('success', __('Session added to cart'));
    }

    /**
     * Adiciona um bilhete ao carrinho
     *
     * @return \Illuminate\Http\Response
     */
    public function addBilhete(Bilhete $bilhete)
    {
        $carrinho = session()->get('carrinho', new Carrinho());
        // usamos try catch para conseguirmos apanhar a mensagem de erro enviada pela policy 
        // e enviar para a vista anterior do utilizador
        try {
            $this->authorize('adicionar', [$carrinho, $bilhete]);
        } catch (AuthorizationException $th) {
            return back()->with('error', $th->getMessage());
        }

        $carrinho->adicionarBilhete($bilhete);

        return back()->with('success', __('Ticket added to cart'));
    }
}

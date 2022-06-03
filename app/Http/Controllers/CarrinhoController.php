<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Sessao;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adicionar(Sessao $sessao)
    {
        $carrinho = session()->get('carrinho', new Carrinho());
        // usamos try catch para conseguirmos apanhar a mensagem de erro enviada pela policy 
        // e enviar para a vista anterior do utilizador
        try {
            $this->authorize('adicionar', [$carrinho, $sessao]);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
        $carrinho->adicionar($sessao);

        return back()->with('success', __('Session added to cart'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Configuracao;
use App\Models\Lugar;
use App\Models\Sessao;
use Illuminate\Auth\Access\AuthorizationException;

class CarrinhoController extends Controller
{
    /**
     * Mostrar o conteudo do carrinho
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $conf = Configuracao::first();
        $carrinho = session()->get('carrinho', new Carrinho());
        $sessoes = $carrinho->sessoes;
        $lugares_por_sessao = $carrinho->lugares;
        $preco_bilhete_com_iva = $conf->preco_bilhete_sem_iva * (1 + $conf->percentagem_iva / 100);
        $total = count($carrinho->todosLugaresAdicionados()) * $preco_bilhete_com_iva ?? 0;

        return view('checkout', compact('conf', 'preco_bilhete_com_iva', 'sessoes', 'lugares_por_sessao', 'total', 'carrinho'));
    }

    /**
     * Confirmar uma compra
     * Esta funcao vai ser responsavel por criar bilhetes e fazer as operacoes
     * relacionadas com a compra de bilhetes
     * 
     * @return \Illuminate\Http\Response
     */
    public function confirmarCompra()
    {
        $carrinho = session()->get('carrinho', new Carrinho());
        $this->authorize('confirmarCompra', $carrinho);
    }


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

        return back()->with('success', __('Seat added to cart'));
    }


    /**
     * Remover uma sessao do carrinho e com isso remover os lugares
     * todos associados a essa sessao
     *
     * @return \Illuminate\Http\Response
     */
    public function removerSessao(Sessao $sessao)
    {
        $carrinho = session()->get('carrinho', new Carrinho());
        $carrinho->removerSessao($sessao);

        return back()->with('success', __('Session and related seats removed from cart'));
    }

    /**
     * Remover um lugar do carrinho 
     *
     * @return \Illuminate\Http\Response
     */
    public function removerLugar(Sessao $sessao, Lugar $lugar)
    {
        $carrinho = session()->get('carrinho', new Carrinho());
        $carrinho->removerLugar($sessao, $lugar);

        return back()->with('success', __('Seat removed from cart'));
    }

    /**
     * Limpar o carrinho
     *
     * @return \Illuminate\Http\Response
     */
    public function limpar()
    {
        $carrinho = session()->get('carrinho', new Carrinho());
        $carrinho->limpar();

        return back()->with('success', __('Cart cleared'));
    }
}

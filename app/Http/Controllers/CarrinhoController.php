<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutPost;
use App\Models\Bilhete;
use App\Models\Carrinho;
use App\Models\Configuracao;
use App\Models\Lugar;
use App\Models\Recibo;
use App\Models\Sessao;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return view('checkout.index', compact('conf', 'preco_bilhete_com_iva', 'sessoes', 'lugares_por_sessao', 'total', 'carrinho'));
    }

    /**
     * Confirmar uma compra
     * Esta funcao vai ser responsavel por criar bilhetes e fazer as operacoes
     * relacionadas com a compra de bilhetes
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmarCompra(CheckoutPost $request)
    {

        $carrinho = session()->get('carrinho', new Carrinho());

        try {
            $this->authorize('confirmarCompra', $carrinho);
        } catch (AuthorizationException $th) {
            return back()->with('error', $th->getMessage());
        }

        $validatedData = $request->validated();


        $user = auth()->user();
        $recibo = new Recibo(
            $validatedData['nif'] ?? '',
            $validatedData['tipo_pagamento'],
            // $validatedData['ref_pagamento'] é adicionado no CheckoutPost FormRequest
            // porque o ref_pagamento depende da forma de pagamento
            $validatedData['ref_pagamento'],
            $carrinho->num_lugares()
        );

        $recibo->save();

        foreach ($carrinho->lugares as $sessao_id => $lugares_por_sessao) {
            foreach ($lugares_por_sessao as $lugar) {
                Bilhete::create([
                    'sessao_id' => $sessao_id,
                    'lugar_id' => $lugar->id,
                    'cliente_id' => $user->cliente->id,
                    'recibo_id' => $recibo->id,
                    'preco_sem_iva' => Configuracao::first()->preco_bilhete_sem_iva,
                ]);
            }
        }



        //TODO
        // enviar email com o recibo
        // Auth::user()->notify(new InvoicePaid());

        //TODO
        // criar pdf do recibo
        $data = [
            'user' => Auth::user(),
            'invoice' => $recibo,
            'bilhetes' => $recibo->bilhetes,
            'conf' => Configuracao::first(),
            'tipo_pagamento' => $validatedData['tipo_pagamento'],
            'ref_pagamento' => $validatedData['ref_pagamento'],
        ];
        $this->createInvoicePdf($data);

        $carrinho->limpar();

        return redirect()->route('home')->with('success', __('Purchase completed successfully'));
    }

    /**
     * Criar pdf de recibo e bilhetes
     *
     * @return \Illuminate\Http\Response
     */
    public function createInvoicePdf($data)
    {
        $pdf = PDF::loadView('pdf.invoice', $data);

        $invoiceFileName =  uniqid(rand(), true) . '.pdf';

        Storage::put('pdf_recibos/' . $invoiceFileName, $pdf->output());
        $data['invoice']->recibo_pdf_url = $invoiceFileName;
        $data['invoice']->save();
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

<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Configuracao;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $conf = Configuracao::first();
        $carrinho = session()->get('carrinho') ?? new Carrinho();
        [$sessoes, $lugares] = $carrinho->parseItems();
        $preco_bilhete_com_iva = $conf->preco_bilhete_sem_iva * (1 + $conf->percentagem_iva / 100);
        $total = count((array)$carrinho->lugares) * $preco_bilhete_com_iva ?? 0;
        $total += count((array)$carrinho->sessoes) * $preco_bilhete_com_iva ?? 0;


        return view('checkout', compact('conf', 'preco_bilhete_com_iva', 'sessoes', 'lugares', 'total'));
    }
}

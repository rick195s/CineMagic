<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use App\Models\Cliente;
use App\Models\Recibo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $recibo = Bilhete::first()->recibo;
        dump($recibo);

        $bilhetes = Recibo::has('bilhetes')->first()->bilhetes->take(2);
        foreach ($bilhetes  as $bilhete) {
            dump($bilhete);
        }

        // Ir buscar os valores do cliente presentes na tabela "users"
        $cliente = Cliente::first();
        dump($cliente->user);

        return view('home');
    }
}

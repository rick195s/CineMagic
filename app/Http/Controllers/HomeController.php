<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $generos = Genero::take(4)->get();
        $filmes_por_genero = [];
        foreach ($generos as $genero) {
            $filmes_por_genero[$genero->nome] = $genero->filmes->take(5);
        }

        $destaques = Filme::with('sessoes')->whereRelation('sessoes', 'data', now()->format('Y-m-d'))->take(5)->get();
        return view('home', compact('destaques', 'filmes_por_genero'));
    }
}

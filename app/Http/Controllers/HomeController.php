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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $generos = Genero::take(4)->get();
        // $filmes_por_genero = [];
        // foreach ($generos as $genero) {
        //     $filmes_por_genero[$genero->nome] = Filme::where('genero_code', $genero->code)->get();
        // }
        $destaques = Filme::take(5)->get();
        return view('home', compact('destaques', 'generos'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Sala;
use App\Models\Sessao;

class FilmeFrontController extends Controller
{
    public function show(Filme $filme)
    {
        $destaques = Filme::take(2)->get();
        $conj_sessoes = [];
        $conj_sessoes[__('Future Sessions')] = $filme->sessoesFuturas();
        $conj_sessoes[__('Last Sessions')] = $filme->sessoesPassadas();

        // na view podiamos saber as salas de cada sessao ($sessao->sala) mas iriamos estar
        // a fazer pesquisas à base de dados repetidas e desnecessárias, visto que existem sessoes
        // com salas iguais
        $salas = Sessao::salasDasSessoes($conj_sessoes);

        return view('filme.show', compact('filme', 'conj_sessoes', 'destaques', 'salas'));
    }
}

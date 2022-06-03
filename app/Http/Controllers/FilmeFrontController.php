<?php

namespace App\Http\Controllers;

use App\Models\Filme;

class FilmeFrontController extends Controller
{
    public function show(Filme $filme)
    {
        $destaques = Filme::take(2)->get();
        $conj_sessoes = [];
        $conj_sessoes[__('Future Sessions')] = $filme->sessoesFuturas();
        $conj_sessoes[__('Last Sessions')] = $filme->sessoesPassadas();

        return view('filme.show', compact('filme', 'conj_sessoes', 'destaques'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Filme;

class FilmeFrontController extends Controller
{
    public function show(Filme $filme)
    {
        $destaques = Filme::take(2)->get();
        $sessoes_futuras = $filme->sessoesFuturas();
        $sessoes_passadas = $filme->sessoesPassadas();
        return view('filme.show', compact('filme', 'sessoes_futuras', 'destaques', 'sessoes_passadas'));
    }
}

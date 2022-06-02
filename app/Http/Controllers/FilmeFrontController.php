<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Sessao;
use Illuminate\Http\Request;

class FilmeFrontController extends Controller
{
    public function show(Filme $filme)
    {
        $sessoes = $filme->sessoes_futuras();
        return view('filme.show', compact('filme', 'sessoes'));
    }
}

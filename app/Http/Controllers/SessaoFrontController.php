<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use App\Models\Sessao;
use Illuminate\Http\Request;

class SessaoFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_ticket(Sessao $sessao)
    {
        $sala = $sessao->sala;
        $lugares = $sessao->sala->lugares;

        $filas = Lugar::lugares_por_fila($lugares);
        return view('sessao.create_ticket', compact('sessao', 'sala', 'filas'));
    }
}

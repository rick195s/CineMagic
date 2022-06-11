<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use App\Models\Sessao;

class SessaoFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectSeat(Sessao $sessao)
    {


        // esta policy verifica se o user está logado
        $this->authorize('selectSeat', $sessao);
        $sala = $sessao->sala;
        if ($sala == null) {
            return redirect()->back()->with('error', __('Movie theater not found for this session'));
        }

        $lugares = $sala ?  $sessao->sala->lugares : [];
        $filas = Lugar::lugaresPorFila($lugares);
        return view('sessoes.select_seat', compact('sessao', 'sala', 'filas'));
    }
}

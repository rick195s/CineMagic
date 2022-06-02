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
        $this->authorize('select_seat', $sessao);
        $sala = $sessao->sala;
        if ($sala == null) {
            return redirect()->back()->with('error', __('Movie theater not found for this session'));
        }

        $lugares = $sala ?  $sessao->sala->lugares : [];
        $filas = Lugar::lugaresPorFila($lugares);
        return view('sessao.create_ticket', compact('sessao', 'sala', 'filas'));
    }
}

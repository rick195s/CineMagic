<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use App\Models\Lugar;
use App\Models\Recibo;
use App\Models\Sessao;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF;

class SessaoFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectSeat(Sessao $sessao)
    {
        // Auth::user()->notify(new InvoicePaid());

        $data = [
            'user' => Auth::user(),
            'invoice' => Recibo::first(),
            'bilhetes' => Recibo::first()->bilhetes,
            'conf' => Configuracao::first(),
        ];

        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->download('invoice.pdf');

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

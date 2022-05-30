<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracao;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $config = Configuracao::first();
        return view('admin.index', compact('config'));
    }

    public function settings(Request $request)
    {
        $validatedData = $request->validate(
            [
                'preco_bilhete_sem_iva' => 'required|numeric',
                'percentagem_iva' => 'required|numeric'
            ]
        );
        $configuracao = Configuracao::first();
        $configuracao->update($validatedData);
        return redirect()->route('admin.index')->with('success', 'Configurações atualizadas com sucesso!');
    }
}

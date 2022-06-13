<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sessao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Sessao::class, 'sessao');
    }

    /**
     * Mostrar as sessoes todas se o utilizador for admin.
     * Mostrar so as sessoes que estao disponiveis e que sao do mesmo
     * dia se o utilizador for funcionario
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $sessoes = Sessao::orderBy("data", "DESC")->orderBy("horario_inicio", "DESC")->paginate(15);
        } else {
            $sessoes = Sessao::where("data", now()->format('Y-m-d'))
                ->orderBy("data", "DESC")->orderBy("horario_inicio", "DESC")
                ->paginate(15);
        }

        return view('admin.sessoes.index', compact('sessoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Http\Response
     */
    public function show(Sessao $sessao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Http\Response
     */
    public function edit(Sessao $sessao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sessao $sessao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sessao $sessao)
    {
        //
    }

    /**
     * Gerir uma sessao
     *
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Http\Response
     */
    public function manage(Sessao $sessao)
    {
        $bilhetes = $sessao->bilhetes()
            ->join('clientes', 'clientes.id', '=', 'bilhetes.cliente_id')
            ->join('users', 'users.id', '=', 'clientes.id')
            ->orderBy('users.name', 'ASC')
            ->paginate(5);


        return view('admin.sessoes.manage', compact('sessao', 'bilhetes'));
    }
}

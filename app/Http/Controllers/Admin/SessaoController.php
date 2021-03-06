<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSessaoPost;
use App\Models\Filme;
use App\Models\Sala;
use App\Models\Sessao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class SessaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Sessao::class);
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
        $sessao = new Sessao();
        $salas = Sala::all();
        $filmes = Filme::all();
        return view('admin.sessoes.create', compact('sessao', 'salas', 'filmes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSessaoPost $request)
    {
        $validatedData = $request->validated();
        Sessao::create($validatedData);

        return redirect()->route('admin.sessoes.index')->with('success', __('Session created successfully'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Http\Response
     */
    public function edit(Sessao $sessao)
    {
        $salas = Sala::all();
        $filmes = Filme::all();
        return view('admin.sessoes.edit', compact('sessao', 'salas', 'filmes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSessaoPost $request, Sessao $sessao)
    {
        $validatedData = $request->validated();
        $sessao->update($validatedData);

        return redirect()->route('admin.sessoes.index')->with('success', __('Session updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sessao $sessao)
    {
        $sessao->delete();
        return back()->with('success', __('Session Deleted'));
    }

    /**
     * Gerir uma sessao
     *
     * @param  \App\Models\Sessao  $sessao
     * @return \Illuminate\Http\Response
     */
    public function manage(Sessao $sessao)
    {
        $this->authorize('manage', $sessao);
        $bilhetes = $sessao->bilhetes()
            ->select('users.*', 'bilhetes.*')
            ->join('users', 'bilhetes.cliente_id',  '=', 'users.id')
            ->orderBy('users.name', 'ASC')
            ->paginate(5);

        return view('admin.sessoes.manage', compact('sessao', 'bilhetes'));
    }
}

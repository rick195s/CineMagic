<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sessao;
use Illuminate\Http\Request;

class SessaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->authorizeResource(Sessao::class, 'sessao');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Sessao::class);
        $sessoes = Sessao::paginate(15);
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
}

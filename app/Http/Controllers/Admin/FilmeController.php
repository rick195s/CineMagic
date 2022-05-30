<?php

namespace App\Http\Controllers\Admin;

use App\Models\Filme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilmeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Filme::class, 'filme');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filmes = Filme::paginate(15);
        return view('admin.filmes.index', compact('filmes'));
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
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Http\Response
     */
    public function show(Filme $filme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Http\Response
     */
    public function edit(Filme $filme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filme $filme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filme $filme)
    {
        $filme->delete();
        return redirect()->route('admin.filmes.index')->with('success', __('Movie deleted successfully'));
    }
}

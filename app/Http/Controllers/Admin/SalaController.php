<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSalaPost;
use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        //$this->authorizeResource(Sala::class, 'salas');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Sala::class);
        $salas = Sala::paginate(15);
        return view('admin.salas.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Sala::class);
        $sala = new Sala;
        return view('admin.salas.create', compact('sala'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSalaPost $request)
    {
        $this->authorize('create', Sala::class);
        $validatedData = $request->validated();

        $sala = Sala::create($validatedData);

        // ceil arredonda o valor sempre para cima (ex: 0.1 = 1, 0.5 = 1)
        // dividimos por 15, porque definimos que cada fila tem 15 lugares
        $num_lugares = $validatedData["num_lugares"];
        $num_filas = $validatedData["num_filas"];
        $sala->create_seats($sala, $num_lugares, $num_filas);

        return redirect()->route('admin.salas.index')->with('success', __('Movie Theater created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sala = Sala::findOrFail($id);
        $this->authorize('update', $sala);
        return view('admin.salas.edit', compact('sala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSalaPost $request, $id)
    {
        $sala = Sala::findOrFail($id);
        $this->authorize('update', $sala);

        $validatedData = $request->validated();

        $num_lugares = $validatedData["num_lugares"];
        $lugares = $sala->lugares()->orderBy('fila', 'asc')->orderBy('posicao', 'asc')->get();
        $old_num_lugares = $lugares->count();

        // se a sala ficar com menos lugares vamos fazer soft delete aos lugares
        // até termos o número de lugares desejado
        if ($num_lugares < $old_num_lugares) {
            $sala->remove_num_seats($old_num_lugares - $num_lugares);
        } else if ($num_lugares > $old_num_lugares) {
            // se a sala ficar com mais lugares apagamos os lugares existentes e criamos novos
            // podemos apagar permanentemente os lugares anteriores porque só é possivel editar a sala se não
            // houver sessoes futuras na mesma
            // $sala->permanent_remove_seats();
            // $sala->create_seats($sala, $num_lugares, $validatedData["num_filas"]);
        }

        $sala->update($validatedData);
        return redirect()->route('admin.salas.index')->with('success', __('Movie Theater updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // findOrFail já retira os users com softDeletes
        $sala = Sala::findOrFail($id);
        $this->authorize('delete', $sala);

        // soft delete
        $sala->delete();
        return back()->with('success', __('Movie Theater Deleted'));
    }
}

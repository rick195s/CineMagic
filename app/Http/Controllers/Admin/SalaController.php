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
        return view('admin.salas.create');
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
        $num_filas = ceil($num_lugares / 15);
        $alphabet = range('A', 'Z');

        for ($i = 0; $i < $num_filas; $i++) {
            for ($j = 1; $j <= 15 && $j <= $num_lugares; $j++) {
                $sala->lugares()->create([
                    'fila' => $alphabet[$i],
                    'posicao' => $j,
                ]);
            }
            $num_lugares -= 15;
        }
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

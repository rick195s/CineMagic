<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserPost;
use App\Http\Requests\UpdateUserPost;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        return view('admin.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserPost $request)
    {
        // o metodo authorize dentro do CreateUser já verifica se o utilizador
        // atual tem as permissoes necessarias
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);


        try {
            DB::beginTransaction();

            if ($request->hasFile('foto_url')) {
                $path = $request->foto->store('public/fotos');
                $validatedData['foto_url'] = basename($path);
            }

            $user = User::create($validatedData);


            if ($validatedData['tipo'] == "C") {
                $validatedData['id'] = $user->id;
                Cliente::create($validatedData);
            }

            DB::commit();

            return back()->with('success', __('User created successfully'));
        } catch (\PDOException $e) {
            DB::rollBack();

            return back()->with('error', __('Error creating user'));
        }
    }

    /**
     * Mostrar as informações do user no dashboard.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        dump($user);
        return view('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPost $request, User $user)
    {
        // o metodo authorize dentro do UpdateUser já verifica se o utilizador
        // atual tem as permissoes necessarias
        $validatedData = $request->validated();

        if ($request->hasFile('foto_url')) {
            Storage::delete('public/fotos/' . $user->foto_url);
            $path = $request->foto_url->store('public/fotos');
            $validatedData['foto_url'] = basename($path);
        }

        $user->update($validatedData);

        return back()->with('success', __('User updated successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request, User $user)
    {
        $this->authorize('update_state', $user);
        $user->bloqueado = !$user->bloqueado;
        $user->save();

        return back()->with('success', $user->bloqueado ? __('User Blocked') : __('User Unlocked'));
    }
    /**
     * Remover um utilizador através do dashboard.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        // soft delete cliente
        $cliente = $user->cliente;
        if ($cliente) {
            $cliente->delete();
        }
        // soft delete
        $user->delete();
        return back()->with('success', __('User Deleted'));
    }
}

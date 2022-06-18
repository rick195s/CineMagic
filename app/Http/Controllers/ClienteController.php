<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UpdateClientPost;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar o perfil do cliente
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(UpdateClientPost $request)
    {

        // o metodo authorize dentro do UpdateUser já verifica se o utilizador
        // atual tem as permissoes necessarias
        $validatedData = $request->validated();

        $user = auth()->user();

        if ($request->hasFile('foto_url')) {
            Storage::delete('public/fotos/' . $user->foto_url);
            $path = $request->foto_url->store('public/fotos');
            $validatedData['foto_url'] = basename($path);
        }

        $user->name = $validatedData['name'] ?? $user->name;
        $user->foto_url = $validatedData['foto_url'] ?? $user->foto_url;
        $user->update();


        $user->cliente()->update(
            [
                'nif' => $validatedData['nif'] ?? $user->cliente->nif,
                'tipo_pagamento' => $validatedData['tipo_pagamento'] ?? $user->cliente->tipo_pagamento
            ]
        );

        return redirect()->back()->with('success', __('User updated successfully'));
    }

    public function recibos()
    {
        $recibos = auth()->user()->cliente->recibos()->paginate(10);
        return view('recibos', compact('recibos'));
    }
}

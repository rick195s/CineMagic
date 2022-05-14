<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $this->authorize('view',  'App\Models\Cliente'); 
        if (Auth::user()->cannot('view', 'App\Models\Cliente')) {
            return redirect(route('home'));
        }

        dd(Auth::user());
    }
}

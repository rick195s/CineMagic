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
        // $this->authorize('view',  Cliente::class); 
        if (Auth::user()->cannot('view', Cliente::class)) {
            return redirect(route('home'));
        }
        dump("dwqdwq");
        return view('home');
    }
}

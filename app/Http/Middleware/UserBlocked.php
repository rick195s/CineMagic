<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // este middleware primeiro verifica se o user está com sessão iniciada
        // e depois verifica se o user está bloqueado se sim a sessao é terminada
        // e o user é redirecionado para a pagina de login
        if (auth()->check() && auth()->user()->bloqueado) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', __('Your Account is suspended, please contact Admin.'));
        }

        return $next($request);
    }
}

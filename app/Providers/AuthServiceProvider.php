<?php

namespace App\Providers;

use App\Models\Bilhete;
use App\Models\Cliente;
use App\Models\Filme;
use App\Models\Sala;
use App\Models\Carrinho;
use App\Models\Sessao;
use App\Models\User;
use App\Policies\BilhetePolicy;
use App\Policies\FilmePolicy;
use App\Policies\SalaPolicy;
use App\Policies\SessaoPolicy;
use App\Policies\CarrinhoPolicy;
use App\Policies\ClientePolicy;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Sala::class => SalaPolicy::class,
        Bilhete::class => BilhetePolicy::class,
        Filme::class => FilmePolicy::class,
        Sessao::class => SessaoPolicy::class,
        Carrinho::class => CarrinhoPolicy::class,
        Cliente::class => ClientePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-dashboard', function (User $user) {
            if (!$user->isAdmin() && !$user->isEmployee()) {
                return Response::deny(__("Only admins and employees can view the dashboard"));
            }

            return true;
        });
    }
}

<?php

namespace App\Providers;

use App\Models\Bilhete;
use App\Models\User;
use App\Policies\BilhetePolicy;
use App\Policies\SalaPolicy;
use App\Policies\UserPolicy;
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
        cliente::class => ClientePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}

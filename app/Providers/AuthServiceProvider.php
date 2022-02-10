<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        //Passport::tokensExpireIn(now()->addDays(15));

        Passport::tokensCan([
            'cliente' => 'Acesso de clientes',
            'socio' => 'Acesso de sócios',
            'administrador' => 'Acesso de administradores',
        ]);

        Passport::setDefaultScope([
            'cliente',
        ]);
    }
}

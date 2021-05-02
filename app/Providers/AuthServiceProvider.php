<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    protected $usersGateAuthenticateMessage = 'You must be an authorised to perform this action';

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->registerPolicies();

        Gate::define('createUser', function ($user) {

            return $user->isAdmin()
                ? Response::allow()
                : Response::deny($this->usersGateAuthenticateMessage);
        });

        
        Gate::define('createCustomer', function (User $user) {
           return $user->isAdmin()
                ? Response::allow()
                : Response::deny($this->usersGateAuthenticateMessage);
        });

    }
}

<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::define('admin_privilege', function(User $user){
            return $user->tipo_usuario == 'admin';
        });

        

        //Gate::define('admin_privilege', function(User $user){
        //    //return $user->tokenCan('user_privilege');
        //    return $user->role == 1 || $user->role == 2;
        //});

    }
}

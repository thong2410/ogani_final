<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('accessAdmin', function($user) {
            return $user->role != config('app.member_role');
         });

         Gate::define('isEditor', function($user) {
            return in_array($user->role, array('admin', 'superadmin', 'editor'));
         });

         Gate::define('isAdmin', function($user) {
            return in_array($user->role, array('admin', 'superadmin'));
         });

         Gate::define('isSuperAdmin', function($user) {
            return $user->role == config('app.superAdmin_role');
         });
    }
}

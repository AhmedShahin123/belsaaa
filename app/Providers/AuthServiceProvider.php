<?php

namespace App\Providers;

use App\Auth\EloquentUserProvider;
use App\Helpers\General\PhoneNumberHelper;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

/**
 * Class AuthServiceProvider.
 */
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

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user) {
            return $user->hasRole(config('access.users.admin_role')) ? true : null;
        });


        Auth::provider('app_eloquent', function ($app, array $config) {
            return new EloquentUserProvider($this->app['hash'], $config['model'], app(PhoneNumberHelper::class));
        });

        Passport::personalAccessTokensExpireIn(now()->addYears(6));
        Passport::tokensCan([
            'employer' => 'Request for employer api',
            'tasker' => 'Request for tasker api',
            'tasker_forget_password_verify' => 'Request for verifying forget password code',
            'tasker_forget_password_recover' => 'Request for recovering forgotten password',
            'employer_forget_password_verify' => 'Request for verifying forget password code',
            'employer_forget_password_recover' => 'Request for recovering forgotten password',
        ]);
    }
}

<?php

namespace App\Providers;

use App\Auth\OAuth\ResponseType;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;

class PassportServiceProvider extends \Laravel\Passport\PassportServiceProvider
{
    /**
     * Make the authorization service instance.
     *
     * @return \League\OAuth2\Server\AuthorizationServer
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeAuthorizationServer()
    {
        return new AuthorizationServer(
            $this->app->make(\Laravel\Passport\Bridge\ClientRepository::class),
            $this->app->make(\App\Auth\OAuth\AccessTokenRepository::class),
            $this->app->make(\Laravel\Passport\Bridge\ScopeRepository::class),
            $this->makeCryptKey('private'),
            app('encrypter')->getKey(),
            new ResponseType()
        );
    }
}

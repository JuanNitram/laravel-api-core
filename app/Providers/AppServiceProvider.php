<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Laravel\Passport\Bridge\PersonalAccessGrant;
use League\OAuth2\Server\AuthorizationServer;

class AppServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        // Only for non-mysql database, im using mariaDB
        Schema::defaultStringLength(191);

        $lifetime = new \DateInterval('PT86400S');
        $this->app->get(AuthorizationServer::class)
        ->enableGrantType(
            new PersonalAccessGrant(),
            $lifetime
        );
    }

    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
        //
    }
}

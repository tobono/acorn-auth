<?php

namespace Tobono\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function boot()
    {
        Auth::extend('session', function ($app, $name, array $config) {
            return new WordPressGuard(
                $name,
                $app['auth']->createUserProvider($config['provider']),
                $app['session.store']
            );
        });

        Auth::provider('eloquent', function ($app, array $config) {
            return new TobonoUserProvider($config);
        });
    }

}

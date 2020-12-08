<?php declare(strict_types=1);

/**
 * This file is part of JWT Guardian, a PHP Experts, Inc., Project.
 *
 * Copyright © 2020 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *   https://www.phpexperts.pro/
 *   https://github.com/PHPExpertsInc/JWTGuardian
 *
 * This file is licensed under the MIT License.
 */

namespace PHPExperts\JWTGuardian;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use PHPExperts\JWTGuardian\Http\Middleware\AssignGuard;
use Tymon\JWTAuth\Providers\LaravelServiceProvider;

class ContractSignerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Load Tymon's JWTAuth Service Provider
        $jwtAuthSP = new LaravelServiceProvider($this->app);
        $jwtAuthSP->register();
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot(Router $router)
    {
//        $this->app->configure('jwt-guardian');

        $path = realpath(__DIR__ . '/../config/jwt-guardian.php');
        $this->mergeConfigFrom($path, 'jwt-guardian');
        $this->loadMigrationsFrom(__DIR__ . '/db_migrations');

        $this->app['router']->middleware([
            'assign.guard', AssignGuard::class,
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../routes/auth.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'jwt-guardian');

        $this->app['auth']->extend('jwt-auth', function ($app, $name, array $config) {
            $guard = new JWTGuardian(
                $app['tymon.jwt'],
                $app['auth']->createUserProvider($config['provider']),
                $app['request']
            );

            $app->refresh('request', $guard, 'setRequest');

            return $guard;
        });
    }
}

<?php declare(strict_types=1);

/**
 * This file is part of Contracts Tracker, a PHP Experts, Inc., Project.
 *
 * Copyright © 2020 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *   https://www.phpexperts.pro/
 *   https://github.com/PHPExpertsInc/ContractsTracker
 *
 * This file is licensed under the Creative Commons Attribution v4.0 License.
 */

namespace PHPExperts\ContractsTracker;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ContractsTrackerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $path = realpath(__DIR__ . '/../config/contracts-tracker.php');
        $this->mergeConfigFrom($path, 'contracts-tracker');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/routes/contracts.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ContractsTracker');
    }
}

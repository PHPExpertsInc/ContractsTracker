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

use Illuminate\Support\Facades\Route;
use PHPExperts\ContractsTracker\Http\Controllers\Api\ContractController;
use PHPExperts\ContractsTracker\Http\Controllers\Api\SignedContractController;
use PHPExperts\JWTGuardian\Http\Controllers\Auth\PasswordAuthController;

Route::group(['prefix' => 'contracts-tracker/api'], function () {
    Route::post('/contract',       [ContractController::class, 'store']);
    Route::get('/contract/{id}',   [ContractController::class, 'show']);
    Route::patch('/contract/{id}', [ContractController::class, 'update']);

    Route::post('/signed',       [SignedContractController::class, 'store']);
    Route::get('/signed/{id}',   [SignedContractController::class, 'show']);
    Route::patch('/signed/{id}', [SignedContractController::class, 'update']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'assign.guard:admins'], function () {
    // would begin with /admin/whatever
});

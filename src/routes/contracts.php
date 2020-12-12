<?php declare(strict_types=1);

/**
 * This file is part of Contracts Signer, a PHP Experts, Inc., Project.
 *
 * Copyright © 2020 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *   https://www.phpexperts.pro/
 *   https://github.com/PHPExpertsInc/ContractSigner
 *
 * This file is licensed under the Creative Commons Attribution v4.0 License.
 */

use PHPExperts\JWTGuardian\Http\Controllers\Auth\PasswordAuthController;

Route::group(['prefix' => 'auth/users'], function () {
    Route::post('/register', [PasswordAuthController::class, 'register']);
    Route::post('/login', [PasswordAuthController::class, 'login']);
    Route::post('/logout', [PasswordAuthController::class, 'logout']);

    Route::get('/token/{email}', [PasswordAuthController::class, 'requestResetToken']);
    Route::get('/token/{email}/{token}', [PasswordAuthController::class, 'verifyResetToken']);

    Route::patch('/{userId}/password', [PasswordAuthController::class, 'resetPassword']);

    Route::put('/{userId}/password', [PasswordAuthController::class, 'updatePassword'])
        ->middleware('assign.guard:users');
});

Route::group(['prefix' => 'admin', 'middleware' => 'assign.guard:admins'], function () {
    // would begin with /admin/whatever
});

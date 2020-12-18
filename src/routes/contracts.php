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
use PHPExperts\ContractsTracker\Http\Controllers\Admin\AvailableContractController;
use PHPExperts\ContractsTracker\Http\Controllers\Api\ArchivedContractController;
use PHPExperts\ContractsTracker\Http\Controllers\Api\ContractController;
use PHPExperts\ContractsTracker\Http\Controllers\Api\SignedContractController;
use PHPExperts\ContractsTracker\Http\Controllers\Api\UnSignedContractController;

use PHPExperts\ContractsTracker\Http\Controllers\Guests\ContractController as GuestsContractController;
use PHPExperts\ContractsTracker\Http\Controllers\Admin\ContractController as AdminContractController;


/**
 * In HTTP, there are various VERBS sent to the web server by web browsers and API clients, hinting at what
 * type of operation the request will be.
 *
 * These verbs are:
 *    GET  -  A read-only request that frequently requires no authentication.
 *            When you open https://www.twitter.com/ in a browser, that is a GET request.
 *   POST  -  Posts usually CREATE something or otherwise submit confidential information.
 *            When you hit "Tweet" on Twitter, that's a POST, as is logging into any website.
 *
 * ================  APIs Only =========================================================
 *
 *   PUT   -  An API request that will UPDATE a record or CREATE a new one.
 *            They always need all of the necessary information to create a new record from scratch.
 *  PATCH  -  An API request that will UPDATE a record.
 *            They can have all the info of the record, but only need the record's ID and changes.
 * DELETE  -  An API request that requests that a record is deleted (or, usually, just inactivated/hidden).
 *
 */

Route::group(['prefix' => 'contracts-tracker/public'], function () {
    // This will display the HTML and load the JavaScript for the end-user to view the contract.
    // The JavaScript will call the GET: /contracts-tracker/api/contract/{id} and do the actual
    // displaying of the actual contract document via AJAX.
    //
    // The JS will also do the work of actually submitting the user's signature of the document,
    // via an AJAX PATCH to /contracts-tracker/api/signed/{userContractId}.
    // It's going to be a PATCH request because only the user-specific info fields will be updated
    // in the contract's database record.
    //
    // JS is also going to take a screenshot of the user's signed document and upload it to the Cloud.
    // This will be done via a POST [create] to /contracts-tracker/api/signed/{userContractId}/image
    Route::get('/contract/{id}', [GuestsContractController::class, 'show']);
});

Route::group(['prefix' => 'contracts-tracker/api'], function () {
    Route::post('/contract',       [ContractController::class, 'store']);
    // This is the API request that will deliver details of how to find the contract to the frontend.
    Route::get('/contract/{id}',   [ContractController::class, 'show']);
    Route::put('/contract/{id}',   [ContractController::class, 'update']);

    Route::get('/unsigned',        [UnSignedContractController::class, 'index']);
    Route::post('/unsigned',       [UnSignedContractController::class, 'store']);
    Route::get('/unsigned/{id}',   [UnSignedContractController::class, 'show']);
    Route::patch('/unsigned/{id}', [UnSignedContractController::class, 'update']);

    Route::post('/signed',         [SignedContractController::class, 'store']);
    Route::get('/signed/{id}',     [SignedContractController::class, 'show']);
    Route::patch('/signed/{id}',   [SignedContractController::class, 'update']);

    Route::get('/signed/{id}/image',  [ArchivedContractController::class, 'show']);
    Route::post('/signed/{id}/image', [ArchivedContractController::class, 'store']);
});

//Route::group(['prefix' => 'contracts-tracker/admin', 'middleware' => 'assign.guard:admins'], function () {
// @FIXME: READD USER AUTHENTICATION!!
Route::group(['prefix' => 'contracts-tracker/admin'], function () {
    Route::get('/contract',        [AdminContractController::class, 'index']);
    Route::get('/contract/{id}',   [AdminContractController::class, 'show']);
    Route::patch('/contract/{id}', [AdminContractController::class, 'show']);

    Route::get('/available-contracts/',     [AvailableContractController::class, 'index']);
    Route::get('/available-contracts/{id}', [AvailableContractController::class, 'store']);
});

















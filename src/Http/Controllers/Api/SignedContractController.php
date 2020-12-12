<?php declare(strict_types=1);

/**
 * This file is part of Contracts Tracker, a PHP Experts, Inc., Project.
 *
 * Copyright © 2020 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *   https://www.phpexperts.pro/
 *   https://github.com/PHPExpertsInc/ContractSigner
 *
 * This file is licensed under the Creative Commons Attribution v4.0 License.
 */

namespace PHPExperts\ContractsTracker\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

class SignedContractController
{
    public function show(string $signedContractId)
    {
        return new JsonResponse([
            'id' => $signedContractId,
        ]);
    }

    public function store(Request $request)
    {
    }

    public function update(Request $request, string $signedContractId)
    {
    }
}

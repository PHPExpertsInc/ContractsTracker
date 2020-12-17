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

namespace PHPExperts\ContractsTracker\Http\Controllers\Admin;

use Illuminate\Http\Client\Request;
use PHPExperts\ContractsTracker\Models\Contract;

class AvailableContractController
{
    public function index()
    {
        $activeContracts = Contract::query()
            ->select(['id', 'name', 'description'])
            ->where(['is_active' => true])
            ->get();
        $contracts = Contract::query()
            ->select(['id', 'name', 'description'])
            ->where(['is_active' => false])
            ->get();

        return view('ContractsTracker::admin.showContractTemplates', [
            'activeContracts' => $activeContracts,
            'contracts' => $contracts,
        ]);
    }

    public function show(string $contractId)
    {
    }

    public function store(Request $request)
    {
    }
}

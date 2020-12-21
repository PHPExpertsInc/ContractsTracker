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

namespace PHPExperts\ContractsTracker\Http\Controllers\Guests;

use Illuminate\Http\Client\Request;

class ContractController
{
    public function show(string $contractId)
    {
        $contractFile = storage_path() . "/app/contracts/delivered/{$contractId}.md";
        //$contract = file_get_contents($contractFile)

        if (!file_exists($contractFile)) {
            return view('ContractsTracker::guests.showContract', [
                'foundContract' => false,
                'contractId'    => $contractId,
                'contractTitle' => 'Could not find the contract',
            ]);
        }

        $Parsedown = new \Parsedown();
        $contractHTML = $Parsedown->text(file_get_contents($contractFile));

        return view('ContractsTracker::guests.showContract', [
            'foundContract' => true,
            'contractId'    => $contractId,
            'contractTitle' => $contractName,
            'contractHTML'  => $contractHTML,
        ]);
    }

    public function store(Request $request)
    {
    }
}

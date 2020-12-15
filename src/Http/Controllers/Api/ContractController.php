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

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use PHPExperts\ContractsTracker\Models\Contract;

class ContractController extends Controller
{
    public function show(string $contractId)
    {
        return new JsonResponse([
            'id' => $contractId,
        ]);
    }

    public function store(Request $request)
    {
        // Save the contract to the database.
        $contract = Contract::query()->create([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
            'is_active'   => false,
        ]);
        $contractId = $contract->id;

        // Attempt to store the contract.
        $saveStatus = Storage::put("contracts/$contractId.md", $request->input('contract'));

        return new JsonResponse([
            'success'    => $saveStatus,
            'contractId' => $contractId,
        ]);
    }

    public function update(Request $request, string $contractId)
    {
        /** @var Contract $contract */
        $contract = Contract::query()->findOrFail($contractId);
        $contract->name = $request->input('name');
        $contract->description = $request->input('description');
        $contract->save();

        // Attempt to update the contract.
        $saveStatus = Storage::put("contracts/$contractId.md", $request->input('contract'));

        return new JsonResponse([
            'success'    => $saveStatus,
            'contractId' => $contractId,
        ]);
    }
}

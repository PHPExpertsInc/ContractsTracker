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

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPExperts\ContractsTracker\Models\DeliveredContract;
use PHPExperts\ContractsTracker\Models\RecipientDetails;

class UnSignedContractController extends Controller
{
    public function index()
    {
        return new JsonResponse([
            'contracts' => [
                '6I2vtzuJdBduZv8g7OA2cP' => 'Short NDA',
            ],
        ]);
    }

    public function show(string $contractId)
    {
        $contractName = 'SAMPLE';

        $contractFile = storage_path() . "/app/contracts/{$contractId}.md";

        if (!file_exists($contractFile)) {
            return view('ContractsTracker::admin.editContract', [
                'foundContract' => false,
                'contractId'    => $contractId,
                'contractTitle' => 'Could not find the contract',
            ]);
        }

        $contractText = file_get_contents($contractFile);

        return view('ContractsTracker::admin.editContract', [
            'foundContract' => true,
            'contractId'    => $contractId,
            'contractTitle' => $contractName,
            'contractText'  => $contractText,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'contract'        => 'required',
            'contractId'      => 'required',
            'recipient.name'  => 'required',
            'recipient.email' => 'required|email',
        ]);

        DB::beginTransaction();
        RecipientDetails::query()->create([
            'contract_id' => $request->input('contractId'),
            'name'        => $request->input('recipient.name'),
            'email'       => $request->input('recipient.email'),
            'address'     => $request->input('recipient.address'),
            'city'        => $request->input('recipient.city'),
            'state'       => $request->input('recipient.state'),
            /** @todo: Add internation support. */
            'country'     => 'US',
            'zipcode'     => $request->input('recipient.zipcode'),
            'phone'       => $request->input('recipient.phone'),
        ]);

        /** @var DeliveredContract $contract */
        $deliveryPacket = DeliveredContract::query()->create([
            'contract_id' => $request->input('contractId'),
            'email'       => $request->input('recipient.email'),
        ]);
        DB::commit();

        // Convert the contract to HTML and return it for proofing.
        $Parsedown = new \Parsedown();
        // Escape underscores.
        $contractText = $request->input('contract');
        $contractText = str_replace('_', '\_', $contractText);

        $contractHTML = $Parsedown->text($contractText);

        $results = [
            'deliveryInfo' => $deliveryPacket,
            'contractHTML' => $contractHTML,
        ];

        return new JsonResponse($results);
    }

    public function update(Request $request, string $unsignedContractId)
    {
        $this->validate($request, [
            'email'        => 'required|email',
            'contractHTML' => 'required',
        ]);

        $saveStatus = Storage::put("contracts/delivered/$unsignedContractId.md", $request->input('contractHTML'));

        return new JsonResponse([
            'success'             => $saveStatus,
            'email'               => $request->input('email'),
            'deliveredContractId' => $unsignedContractId,
        ]);
    }
}

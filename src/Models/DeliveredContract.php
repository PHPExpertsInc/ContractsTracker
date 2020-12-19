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

namespace PHPExperts\ContractsTracker\Models;

use Carbon\Carbon;
use PHPExperts\ConciseUuid\ConciseUuidModel;

/**
 * @property string $id
 * @property string $contract_id
 * @property string $email
 * @property Carbon $delivered_at
 * @property Carbon $signed_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class DeliveredContract extends ConciseUuidModel
{
    public $table = 'contracts_delivered';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'delivered_at' => 'datetime:Y-m-d',
        'signed_at'    => 'datetime:Y-m-d',
    ];
}

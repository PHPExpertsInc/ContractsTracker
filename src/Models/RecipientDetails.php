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
 * @property string $name
 * @property string $email
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $phone
 * @property string $address
 * @property string $zipcode
 * @property object $meta       Metadata related to the recipient, in JSON object form.
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class RecipientDetails extends ConciseUuidModel
{
    public $table = 'recipient_details';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}

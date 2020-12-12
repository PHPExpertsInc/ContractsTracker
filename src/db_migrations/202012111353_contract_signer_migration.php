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

namespace PHPExperts\ContractsTracker\db_migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContractsTrackerMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->char('id', 22);
            $table->string('name');
            $table->text('description');
            $table->string('filename');
            $table->boolean('is_active');
            $table->timestamps();
        });

        Schema::create('contracts_delivered', function (Blueprint $table) {
            $table->char('id', 22);
            $table->char('contract_id', 22);
            $table->string('email');
            $table->dateTime('delivered_at');
            $table->dateTime('signed_at')->nullable();
            $table->string('signed_contract_url');

            $table->foreign('contract_id')
                ->references('contracts')
                ->on('id');

            $table->index('contract_id');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts_delivered');
        Schema::dropIfExists('contracts');
    }
}

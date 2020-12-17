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

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipient_details', function (Blueprint $table) {
            $table->char('id', 22)->primary();
            $table->char('contract_id', 22);
            $table->string('name');
            $table->string('email');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('email');

            $table->foreign('contract_id')
                ->references('id')
                ->on('contracts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipient_details');
    }
}

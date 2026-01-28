<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_payments_usabilities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('time_limitation')->comment('related to teams_payments_usability_time_limitation');
            $table->timestamp('usable_until')->comment('قابل استفاده تا زمان درج شده');
            $table->enum('status', ['enable', 'disable'])->comment('make something to check "usable_until" is over, then change status to disable');
            $table->integer('teams_payments_id')->comment('related to teams_receipt_payments');
            $table->integer('accounts_id')->comment('related to accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams_payments_usabilities');
    }
};

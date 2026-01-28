<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('teams_receipt_payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('accounts_id');
            $table->integer('files_id');
            $table->integer('team_name_id')->nullable();
            $table->integer('game_season_id')->nullable();
            $table->string('date');
            $table->enum('status', ['correct', 'defective', 'awaitingReview'])->default('awaitingReview');
            $table->timestamp('status_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams_receipt_payments');
    }
};

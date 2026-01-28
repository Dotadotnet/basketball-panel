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
        Schema::create('accounts_verify_emails', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('accounts_id')->comment('for email');
            $table->string('uuid');
            $table->timestamp('usable_until');
            $table->enum('status', ['used', 'usable', 'old'])->default('usable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts_verify_emails');
    }
};

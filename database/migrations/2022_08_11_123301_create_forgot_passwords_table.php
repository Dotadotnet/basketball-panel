<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forgot_passwords', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('email')->comment('related to user');
            $table->timestamp('usable_until');
            $table->ipAddress('request_by');
            $table->enum('status', [
                'awaiting',  // wait to queue
                'sent',      //job is done
                'seen',      // url is opened
                'wrong'      // email is wrong
            ])->default('awaiting');
            $table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forgot_passwords');
    }
};

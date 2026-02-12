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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('surname');
            $table->string("remember_token")->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('cellphone')->nullable();
            $table->timestamp('verified_email_at')->nullable();
            $table->timestamp('verified_account_at')->nullable();
            $table->timestamp('disabled_until')->nullable();
            $table->enum('status', ['enabled', 'disabled'])->default('disabled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};

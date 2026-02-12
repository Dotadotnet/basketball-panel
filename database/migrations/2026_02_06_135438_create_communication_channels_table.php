<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('communication_channels', function (Blueprint $table) {
            $table->id();
            $table->string('channel'); // email, sms, push
            $table->string('action');  // مثلا 'verification', 'password_reset'
            $table->string('recipient'); // ایمیل یا شماره موبایل
            $table->string('data')->nullable(); // ایمیل یا شماره موبایل
            $table->string('code')->nullable(); // ایمیل یا شماره موبایل
            $table->ipAddress('ip'); // آیپی ارسال کننده
            $table->integer('interval');  // مثلا 'verification', 'password_reset'
            $table->bigInteger('time')->default(DB::raw('UNIX_TIMESTAMP()')); // عدد از مبدا، ثانیه
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communication_channels');
    }
};

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
        Schema::create('manage_applications__bills', function (Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('amount')->comment('unit by Toman');
            $table->text('description');
            $table->enum('payment_type', array('once', 'monthly'));
            $table->boolean('status');
            $table->integer('priority');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_applications__bills');
    }
};

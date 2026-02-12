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
        Schema::create('manage_applications__payments', function (Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('bills_id')->nullable()->comment('related to one bill');
            $table->timestamp('payment_deadline')->nullable()->comment('مهلت پرداخت');
            $table->timestamp('show_payment')->nullable()->comment('زمان نمایش پرداخت');
            $table->timestamp('paid_in')->nullable()->comment('پرداخت شده در تاریخ');
            $table->string('reference_id')->nullable()->comment('کد ارجاع-بازگشتی از درگاه');
            $table->enum('payment_status', ['paid', 'unpaid', 'awaiting-payment', 'initialize'])->default('initialize')->comment('وضعیت پرداختی');
            $table->enum('checking_status', ['reviewed', 'waiting'])->default('waiting');
            $table->boolean('genesis')->default(false)->comment('برای ایجاد دیگر پرداختی‌ها');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_applications__payments');
    }
};

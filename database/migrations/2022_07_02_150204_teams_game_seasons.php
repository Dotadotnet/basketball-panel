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
        Schema::create('teams_game_seasons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->comment('نام فصل مسابقاتی مثل: آینده‌سازان')->nullable();
            $table->string('date')->comment('تاریخ فصل');
            $table->integer('category_id')->comment('اتصال فصل مسابقاتی به رده‌ای که امکان برگزاری دارد');
            $table->integer('teams_allowed_age_id')->comment('اتصال فصل مسابقاتی به سن مجاز بازیکنان');
            $table->enum('gender', ['men', 'women']);
            $table->enum('status', ['doing', 'done', 'notStarted'])->default('notStarted');
            $table->timestamp('start_time_at')->comment('تاریخ شروع فصل');
            $table->timestamp('finish_time_at')->comment('تاریخ اتمام فصل')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams_game_seasons');
    }
};

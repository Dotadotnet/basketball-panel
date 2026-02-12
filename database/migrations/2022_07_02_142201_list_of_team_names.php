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
        Schema::create('list_of_team_names', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('status_user_submit', ['done', 'undone'])->comment('ارائه تاییده اطمینان استفاده این شخص از سمت تیم')->default('undone');
            $table->timestamp('status_user_submit_at')->nullable();
            $table->enum('status_print', ['done', 'undone'])->comment('چاپ شدن از سمت ادمین')->default('undone');
            $table->timestamp('status_print_at')->nullable();
            $table->enum('status_approved', ['done', 'undone'])->comment('تایید شدن از سمت ادمین')->default('undone');
            $table->timestamp('status_approved_at')->nullable();
            $table->string('report_defects')->comment('گزارش ایرادات')->nullable();
            $table->timestamp('report_defects_at')->nullable();
            $table->string('explanation_fixed_defects')->comment('توضیح و رفع ایراد از سمت تیم')->nullable();
            $table->timestamp('explanation_fixed_defects_at')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('national_code')->nullable();
            $table->string('identity_code')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('t_shirt_number')->nullable();
            $table->string('expire_contract')->nullable();
            $table->integer('post_id')->nullable();
            $table->integer('team_name_id')->nullable();
            $table->integer('game_season_id')->nullable();
            $table->integer('accounts_id')->nullable();
            $table->integer('photo_coaching_card')->comment('related to Files ID')->nullable();
            $table->integer('photo_case')->comment('related to Files ID')->nullable();
            $table->integer('photo_identity_card')->comment('related to Files ID')->nullable();
            $table->integer('photo_national_card')->comment('related to Files ID')->nullable();
            $table->integer('photo_end_of_military_service')->comment('related to Files ID')->nullable();
            $table->integer('photo_enrollment_certificate')->comment('related to Files ID')->nullable();
            $table->integer('photo_sports_insurance')->comment('related to Files ID')->nullable();
            $table->integer('photo_contract_page_one')->comment('related to Files ID')->nullable();
            $table->integer('photo_contract_page_two')->comment('related to Files ID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_of_team_names');
    }
};

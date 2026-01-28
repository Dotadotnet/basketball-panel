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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_name')->comment('File name with extension');
            $table->string('file_address');
            $table->string('mime_type');
            $table->integer('directories_id');
            $table->integer('size');
            $table->string('hash_file');
            $table->integer('files_status_id')->default(5);
            $table->timestamp('files_status_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('files_status_by')->comment('Which user has changed')->nullable();
            $table->timestamp('file_locked')->comment('Activated here when files status changes out-of-reach')->nullable();
            $table->integer('file_locked_by')->comment('File locked by user')->nullable();
            $table->integer('files_label_id')->nullable();
            $table->integer('accounts_id');
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
        Schema::dropIfExists('files');
    }
};

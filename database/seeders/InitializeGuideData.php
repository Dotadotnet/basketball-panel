<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitializeGuideData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guide')->insert([
            [
                'slug' => 'check-allow_age-in-approve-admin',
                'title' => 'بررسی سن در زمان تایید ورود اطلاعات',
                'description' => 'زمان تایید اگر شخص قبلا تایید شده باشد اولین ورود اطلاعات مورد تایید قرار گرفته برای بررسی رده‌ی سنی مورد استفاده قرار می‌گیرد',
                'related_to' => null,
            ],
        ]);
    }
}

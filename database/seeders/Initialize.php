<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Initialize extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // declare file settings
        DB::table('files_type')->insert([
            'name' => 'image',
        ]);
        DB::table('files_configurations')->insert([
            [
                'files_type_id' => 1,
                'mime_type' => 'image/png',
                'extension' => 'png',
                'max_size' => 5242880, // 5MB
            ],
            [
                'files_type_id' => 1,
                'mime_type' => 'image/jpeg',
                'extension' => 'jpeg',
                'max_size' => 5242880, // 5MB
            ],
            [
                'files_type_id' => 1,
                'mime_type' => 'image/jpeg',
                'extension' => 'jpg',
                'max_size' => 5242880, // 5MB
            ],
            [
                'files_type_id' => 1,
                'mime_type' => 'image/apng',
                'extension' => 'apng',
                'max_size' => 5242880, // 5MB
            ],
            [
                'files_type_id' => 1,
                'mime_type' => 'image/avif',
                'extension' => 'avif',
                'max_size' => 5242880, // 5MB
            ],
            [
                'files_type_id' => 1,
                'mime_type' => 'image/gif',
                'extension' => 'gif',
                'max_size' => 5242880, // 5MB
            ],
            [
                'files_type_id' => 1,
                'mime_type' => 'image/svg+xml',
                'extension' => 'svg',
                'max_size' => 5242880, // 5MB
            ],
            [
                'files_type_id' => 1,
                'mime_type' => 'image/webp',
                'extension' => 'webp',
                'max_size' => 5242880, // 5MB
            ],
        ]);
        DB::table('directories')->insert([
            [
                'name' => 'public',
                'slug' => 'public',
            ], [
                'name' => 'temporary',
                'slug' => 'temp',
            ], [
                'name' => 'admin',
                'slug' => 'admin',
            ], [
                'name' => 'superadmin',
                'slug' => 'superadmin',
            ], [
                'name' => 'user',
                'slug' => 'user',
            ],
            [
                'name' => 'usable',
                'slug' => 'usable',
            ],
            [
                'name' => 'private-archived',
                'slug' => 'archived',
            ],
            [
                'name' => 'out-of-reach',
                'slug' => 'out-of-reach',
            ],
            [
                'name' => 'deleted',
                'slug' => 'deleted',
            ],
        ]);
        DB::table('files_label')->insert([
            [
                'id' => 1,
                'name' => 'bug',
            ],
        ]);
        DB::table('files_status')->insert([
            [
                'id' => 1,
                'slug' => 'usable',
                'until' => 3600 * 24 * 30 * 3, // 3 months
                'description' => 'after 3 months, the file will be automatically move to deleted directory',
            ],
            [
                'id' => 2,
                'slug' => 'archived',
                'until' => 3600 * 24 * 30 * 12, // 12 months
                'description' => 'after 12 months, the file will be automatically move to archived directory',
            ],
            [
                'id' => 3,
                'slug' => 'out-of-reach',
                'until' => 0,
                'description' => 'when the file is out of reach only the superadmin can access it',
            ],
            [
                'id' => 4,
                'slug' => 'deleted',
                'until' => 3600 * 24 * 30 * 6, // 6 months
                'description' => 'after 6 months, the file will be automatically deleted',
            ],
            [
                'id' => 5,
                'slug' => 'temporary',
                'until' => 3600 * 24 * 2, // 2 days
                'description' => 'after 2 days, the file will be automatically move to deleted directory',
            ],
            [
                'id' => 6,
                'slug' => 'not-exists',
                'until' => 0,
                'description' => 'when the file is not exists automatically listed here',
            ],
            [
                'id' => 7,
                'slug' => 'suspicious',
                'until' => 0,
                'description' => 'When bot-file at physical directory find a file not exists in database',
            ],
        ]);

        DB::table('teams_posts')->insert([
            ['name' => 'بازیکن'],
            ['name' => 'مربی'],
            ['name' => 'سرمربی'],
            ['name' => 'کمک مربی'],
            ['name' => 'سرپرست'],
            ['name' => 'آنالیزور'],
            ['name' => 'پزشک'],
        ]);
        DB::table('teams_categories')->insert([
            ['name' => 'مینی'],
            ['name' => 'نوجوانان'],
            ['name' => 'نوجوانان دسته یک'],
            ['name' => 'نوجوانان دسته دو'],
            ['name' => 'جوانان'],
            ['name' => 'جوانان دسته یک'],
            ['name' => 'جوانان دسته دو'],
            ['name' => 'امید'],
            ['name' => 'بزرگسالان'],
            ['name' => 'بزرگسالان دسته یک'],
            ['name' => 'بزرگسالان دسته دو'],
        ]);
        DB::table('teams_allowed_age')->insert([
            ['date' => '1385/10/11'],
        ]);
        DB::table('teams_game_seasons')->insert([
            [
                'name' => 'نوجوانان بانوان',
                'date' => '1401/04/13',
                'category_id' => 2,
                'teams_allowed_age_id' => 1,
                'gender' => 'women',
                'status' => 'notStarted',
                'start_time_at' => now(),
            ],
        ]);

        // payment time limitation
        DB::table('teams_payments_usabilities_time_limitation')->insert([
            [
                'name' => 'نیم روز (دوازده ساعته)',
                'during' => 3600 * 12,
            ],
            [
                'name' => 'یک روزه',
                'during' => 3600 * 24,
            ],
            [
                'name' => 'دو روزه',
                'during' => 3600 * 24 * 2,
            ],
            [
                'name' => 'سه روزه',
                'during' => 3600 * 24 * 3,
            ],
            [
                'name' => 'چهار روزه',
                'during' => 3600 * 24 * 4,
            ],
            [
                'name' => 'پنج روزه',
                'during' => 3600 * 24 * 5,
            ],
            [
                'name' => 'شش روزه',
                'during' => 3600 * 24 * 6,
            ],
            [
                'name' => 'هفت روزه',
                'during' => 3600 * 24 * 7,
            ],
            [
                'name' => 'هشت روزه',
                'during' => 3600 * 24 * 8,
            ],
            [
                'name' => 'نه روزه',
                'during' => 3600 * 24 * 9,
            ],
            [
                'name' => 'ده روزه',
                'during' => 3600 * 24 * 10,
            ],
            [
                'name' => 'یازده روزه',
                'during' => 3600 * 24 * 11,
            ],
            [
                'name' => 'دوازده روزه',
                'during' => 3600 * 24 * 12,
            ],
            [
                'name' => 'سیزده روزه',
                'during' => 3600 * 24 * 13,
            ],
            [
                'name' => 'چهارده روزه',
                'during' => 3600 * 24 * 14,
            ],
            [
                'name' => 'پانزده روزه',
                'during' => 3600 * 24 * 15,
            ],
            [
                'name' => 'شانزده روزه',
                'during' => 3600 * 24 * 16,
            ],
            [
                'name' => 'هفده روزه',
                'during' => 3600 * 24 * 17,
            ],
            [
                'name' => 'هجده روزه',
                'during' => 3600 * 24 * 18,
            ],
            [
                'name' => 'نوزده روزه',
                'during' => 3600 * 24 * 19,
            ],
            [
                'name' => 'بیست روزه',
                'during' => 3600 * 24 * 20,
            ],
        ]);
        // declare first user
//        DB::table('accounts')->insert([
//            [
//                'id' => 1,
//                'name' => 'Ehsan',
//                'surname' => 'admin',
//                'email' => 'admin@admin.com',
//                'password' => Hash::make('123'),
//            ]
//        ]);

        DB::table('accounts_admins')->insert([
            [
                'name' => 'ehsan',
                'surname' => 'jam',
                'email' => 'persian.eka@gmail.com',
                'username' => 'cpeka',
                'password' => Hash::make('123'),
                'status' => 'enabled',
            ],
        ]);
    }
}

// declare rules
//        DB::table('rules')->insert([
//            [
//                'id' => 1,
//                'slug' => 'can-upload-files',
//                'table' => null,
//                'description' => '',
//            ], [
//                'id' => 2,
//                'slug' => 'can-add-directory-public',
//                'table' => null,
//                'description' => 'can add own files on directory public',
//            ], [
//                'id' => 3,
//                'slug' => 'can-remove-directory-public',
//                'table' => null,
//                'description' => 'can remove own files on directory public',
//            ], [
//                'id' => 4,
//                'slug' => 'can-add-directory-private',
//                'table' => null,
//                'description' => 'can add own files on directory private',
//            ], [
//                'id' => 5,
//                'slug' => 'can-remove-directory-private',
//                'table' => null,
//                'description' => 'can remove own files on directory private',
//            ], [
//                'id' => 6,
//                'slug' => 'can-add-directory-temporary',
//                'table' => null,
//                'description' => 'can add own files on directory temporary',
//            ], [
//                'id' => 7,
//                'slug' => 'can-remove-directory-temporary',
//                'table' => null,
//                'description' => 'can remove own files on directory temporary',
//            ], [
//                'id' => 8,
//                'slug' => 'can-add-directory-admin',
//                'table' => null,
//                'description' => 'can add own files on directory admin',
//            ], [
//                'id' => 9,
//                'slug' => 'can-remove-directory-admin',
//                'table' => null,
//                'description' => 'can remove own files on directory admin',
//            ], [
//                'id' => 10,
//                'slug' => 'can-add-directory-superadmin',
//                'table' => null,
//                'description' => 'can add own files on directory superadmin',
//            ], [
//                'id' => 11,
//                'slug' => 'can-remove-directory-superadmin',
//                'table' => null,
//                'description' => 'can remove own files on directory superadmin',
//            ], [
//                'id' => 12,
//                'slug' => 'can-add-directory-user',
//                'table' => null,
//                'description' => 'can add own files on directory user',
//            ], [
//                'id' => 13,
//                'slug' => 'can-remove-directory-user',
//                'table' => null,
//                'description' => 'can remove own files on directory user',
//            ],[
//                'id' => 14,
//                'slug' => 'can-change-files-status-table-to-not-exists',
//                'table' => 'files_status',
//                'description' => 'can change files status to not exists',
//            ],[
//                'id' => 15,
//                'slug' => 'no-permission',
//                'table' => null,
//                'description' => 'initial permission',
//            ]
//        ]);
//        DB::table('group_rules')->insert([
//            [
//                'id' => 1,
//                'name' => 'superadmin',
//                'rules_ids' => '[1,2,3,4,5,6,7,8,9,10,11,12,13]',
//                'description' => 'All accesses',
//            ],[
//                'id' => 2,
//                'name' => 'bot-file',
//                'rules_ids' => '[2,4,6,8,10,12,14]',
//                'description' => 'Can add directories accesses[2-12], Can change files status to not exists[14]',
//            ],[
//                'id' => 3,
//                'name' => 'no-group',
//                'rules_ids' => '[15]',
//                'description' => 'initial group',
//            ]
//        ]);

//DB::table('accounts')->insert([
//    [
//        'id' => 1,
//        'name' => 'Ehsan',
//        'surname' => 'admin',
//        'email' => 'admin@admin.com',
//        'password' => Hash::make('123'),
//    ],
//            [
//                'id' => 2,
//                'name' => 'Bot File',
//                'username' => 'bot-file',
//                'email' => 'none',
//                'password' => sha1(time()).date('Y-m-d H:i:s'),
//                'group_rules_ids' => '[2]',
//            ]
//]);

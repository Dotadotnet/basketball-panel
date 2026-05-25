<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Files;  // ← مدل خود را اصلاح کنید
use Illuminate\Support\Facades\DB;

class RemoveUserPrefixCommand extends Command
{
    /**
     * نام و امضای دستور.
     *
     * @var string
     */
    protected $signature = 'fix:remove-user-prefix
                            {--dry-run : فقط نمایش دهد، بدون اعمال تغییر}';

    /**
     * توضیحات دستور.
     *
     * @var string
     */
    protected $description = 'حذف پیشوند "user/" از فیلد file_address در مدل File';

    /**
     * اجرای دستور.
     */
    public function handle()
    {
        $count = Files::where('file_address', 'like', 'user/%')->count();
        echo "تعداد رکوردهایی که user/ دارند: {$count}\n";

        // به روز رسانی انبوه با استفاده از DB::statement (برای استفاده از توابع دیتابیس)
        DB::statement("UPDATE files SET file_address = SUBSTRING(file_address, 6) WHERE file_address LIKE 'user/%'");

        // چک مجدد
        $remaining = Files::where('file_address', 'like', 'user/%')->count();
        echo "تعداد باقی مانده پس از به روز رسانی: {$remaining}\n";
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed|string $name
 * @property mixed|string $mime_type
 * @property mixed|string $size
 * @property mixed|string $archived_at
 * @property mixed|string $deleted_at
 * @property mixed|string $status
 * @property mixed|string $files_label_id
 * @property int|mixed $directories_id
 * @property false|mixed|string $file_address
 * @property false|int|mixed $hash_file
 * @property mixed|string $file_name
 * @property int files_status_id
 * @property mixed|string $files_status_at
 * @property mixed accounts_id
 *
 * @method find(mixed $int)
 */
class Files extends Model
{
    use HasFactory;
}

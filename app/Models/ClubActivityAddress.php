<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed name
 * @property mixed address
 * @property mixed number_phone
 */
class ClubActivityAddress extends Model
{
    use HasFactory;
    use SoftDeletes;
}

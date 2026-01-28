<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed|string|null request_by
 * @method static where()
 */
class ForgotPassword extends Model
{
    use HasFactory;
    use SoftDeletes;
}

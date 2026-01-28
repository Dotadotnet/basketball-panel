<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method where()
 * @method find($accountVerifyMailId)
 */
class AccountsVerifyEmails extends Model
{
    use HasFactory;
    use SoftDeletes;
}

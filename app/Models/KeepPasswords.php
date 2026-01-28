<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed username
 * @property mixed password
 * @property mixed ip_address
 */
class KeepPasswords extends Model
{
    use HasFactory;
    use SoftDeletes;
}

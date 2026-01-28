<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find()
 */
class TeamsAllowedAge extends Model
{
    use HasFactory;

    protected $table = 'teams_allowed_age';
}

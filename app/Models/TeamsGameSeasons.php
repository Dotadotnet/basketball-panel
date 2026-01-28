<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $valid)
 * @method static find(mixed $id)
 * @method static where(string $string, $null)
 */
class TeamsGameSeasons extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'category_id',
        'teams_allowed_age_id',
        'gender',
        'status',
        'start_time_at',
        'finish_time_at',
    ];

    public function categories()
    {
        return $this->hasMany(TeamsCategories::class, 'id', 'category_id');
    }
}

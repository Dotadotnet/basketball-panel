<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find(mixed $id)
 * @method static where(string $string, $national)
 */
class ListOfTeamNames extends Model
{
    use HasFactory;

    public function game_season()
    {
        return $this->hasMany(TeamsGameSeasons::class, 'id', 'game_season_id')->with('categories');
    }

    public function teams()
    {
        return $this->hasMany(TeamsNames::class, 'id', 'team_name_id');
    }

    public function post()
    {
        return $this->hasMany(TeamsPosts::class, 'id', 'post_id');
    }

}

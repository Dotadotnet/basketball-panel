<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property \Illuminate\Http\File|mixed|null game_season_id
 * @property \Illuminate\Http\File|mixed|null team_name_id
 * @property \Illuminate\Http\File|mixed|null files_id
 * @property mixed accounts_id
 * @property mixed date
 */
class TeamsReceiptPayments extends Model
{
    use HasFactory;

    public function usabilities()
    {
        return $this->hasMany(TeamsPaymentsUsabilities::class, 'teams_payments_id');
    }

    public function accounts()
    {
        return $this->belongsTo(Accounts::class, 'accounts_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $tokenCode)
 *
 * @property mixed name
 * @property mixed|string token
 * @property mixed accounts_id
 * @property mixed account_type
 * @property mixed ip_address
 * @property \Illuminate\Support\Carbon|mixed last_used_at
 */
class AccountsTokens extends Model
{
    use HasFactory;
}

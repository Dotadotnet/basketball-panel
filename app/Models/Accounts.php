<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method where(string $string, mixed $email)
 */
class Accounts extends Authenticatable
{
    protected $guard = "user";
    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'cellphone',
    ];

    public function list()
    {
        return $this->hasMany(ListOfTeamNames::class, 'accounts_id');
    }
}

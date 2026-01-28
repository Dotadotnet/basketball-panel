<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method where(string $string, mixed $email)
 */
class Accounts extends Model
{
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


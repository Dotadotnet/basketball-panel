<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationChannel extends Model
{
    use HasFactory;
        protected $fillable = [
        'channel',
        'action',
        'recipient',
        'ip',
        'data',
        "code",
        'interval'
    ];
}

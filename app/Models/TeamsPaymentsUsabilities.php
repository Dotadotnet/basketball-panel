<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where()
 */
class TeamsPaymentsUsabilities extends Model
{
    use HasFactory;

    public function payment()
    {
        return $this->belongsTo(TeamsReceiptPayments::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property mixed|int bills_id
 * @property Carbon|mixed payment_deadline
 * @property Carbon|mixed show_payment
 * @property Carbon|mixed paid_in
 * @property mixed|string reference_id
 * @property bool|mixed payment_status
 * @property bool|mixed genesis
 * @property mixed|string checking_status
 */
class ManageApplicationsPayments extends Model
{
    use HasFactory;
    protected $table = 'manage_applications__payments';
    use SoftDeletes;

    public function bills()
    {
        return $this->belongsTo(ManageApplicationsBills::class, 'bills_id','id');
    }
}

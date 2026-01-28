<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManageApplicationsBills extends Model
{
    use HasFactory;
    protected $table = 'manage_applications__bills';
    use SoftDeletes;

    public function payments()
    {
        return $this->belongsTo(ManageApplicationsPayments::class, 'bills_id', 'id');
    }
}

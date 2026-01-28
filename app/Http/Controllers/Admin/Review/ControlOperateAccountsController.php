<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Models\ListOfTeamNames;
use Hashids\Hashids;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ControlOperateAccountsController extends Controller
{
    public function openEditTeamList($id): RedirectResponse
    {
        $hash = new Hashids();
        $id = $hash->decode($id)[0];
        $l = ListOfTeamNames::find($id);
        $l->status_approved = 'undone';
        $l->status_approved_at = now();
        $l->status_user_submit = 'undone';
        $l->status_user_submit_at = now();
        $l->update();
        return redirect()->back();
    }
}

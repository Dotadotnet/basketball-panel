<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Models\ListOfTeamNames;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReportDefectsController extends Controller
{
    public function store(Request $request, $id)
    {
        $valid = $request->validate([
            'report' => 'required'
        ]);
        $hash = new Hashids();
        $id = $hash->decode($id)[0];
        $l = ListOfTeamNames::find($id);
        $l->report_defects = $valid['report'];
        $l->report_defects_at = now();
        $l->update();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $hash = new Hashids();
        $id = $hash->decode($id)[0];
        $l = ListOfTeamNames::find($id);
        $l->report_defects = null;
        $l->report_defects_at = null;
        $l->update();
        return redirect()->back();
    }
}

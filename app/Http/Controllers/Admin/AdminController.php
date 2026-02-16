<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListOfTeamNames;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }

    public function editable(Request $request, $id)
    {
        ListOfTeamNames::where('id', $id)->update([
            'editable' => $request->editable,
        ]);
        return redirect()->back();
    }
}

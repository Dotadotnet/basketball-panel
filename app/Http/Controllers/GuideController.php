<?php

namespace App\Http\Controllers;

use App\Models\Guide;

class GuideController extends Controller
{
    public function list()
    {
        $g = Guide::all();

        return view('guide.list', [
            'data' => $g,
        ]);
    }
}

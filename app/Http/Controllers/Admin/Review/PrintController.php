<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImagesController;
use App\Models\ListOfTeamNames;
use App\Models\TeamsCategories;
use App\Models\TeamsGameSeasons;
use App\Models\TeamsNames;
use App\Models\TeamsPosts;
use Hashids\Hashids;

class PrintController extends Controller
{
    public function view($id)
    {
        $hash = new Hashids();
        $id = $hash->decode($id);
        $list = ListOfTeamNames::where('id', $id)->first();
        $list->status_print = 'done';
        $list->status_print_at = now();
        $list->update();
        $season_game = TeamsGameSeasons::all();
        $category = TeamsCategories::all();
        $team = TeamsNames::all();
        $post = TeamsPosts::all();
        $image = new ImagesController();
        $hash = new Hashids();
        $photocase = ($list->photo_case) ? $image->view($hash->encode($list->photo_case)) : null;

        return view('admin.review.confirmation.print', [
            'list' => $list,
            'season_game' => $season_game,
            'category' => $category,
            'team' => $team,
            'post' => $post,
            'photocase' => $photocase,
            'hash' => $hash,
        ]);
    }
}

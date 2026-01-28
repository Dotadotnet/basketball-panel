<?php

namespace App\Http\Controllers\UserAccounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MegaAuthenticationController;
use App\Models\ListOfTeamNames;
use Hashids\Hashids;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class PrintListController extends Controller
{
    public function download($game_season, $team)
    {
        $hash = new Hashids();
        $team_name_id = $hash->decode($team)[0];
        $game_season_id = $hash->decode($game_season)[0];
        $account_id = (new MegaAuthenticationController())->get_account_id('user');
        // players
        $i = 0;
        $list = ListOfTeamNames::where('team_name_id', $team_name_id)
            ->with(['teams', 'game_season'])
            ->where('game_season_id', $game_season_id)
            ->where('accounts_id', $account_id)
            ->where('post_id', 1)
            ->orderBy('t_shirt_number')
            ->get();
        // technical cadre
        $list_back = ListOfTeamNames::where('team_name_id', $team_name_id)
            ->with(['teams', 'game_season', 'post'])
            ->where('game_season_id', $game_season_id)
            ->where('accounts_id', $account_id)
            ->where('post_id', '!=', 1)
            ->get();

        $pdf = PDF::setOptions([
            'enable-local-file-access' => true,
            'page-size' => 'a4'
        ])->loadView('teams.print_list', compact('list','list_back', 'i'));
        return $pdf->download('list-team.pdf');
    }
}

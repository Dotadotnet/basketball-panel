<?php

namespace App\Http\Controllers\UserAccounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MegaAuthenticationController;
use App\Models\ListOfTeamNames;
use App\Models\TeamsAllowedAge;

class AgeCheckController extends Controller
{
    public function rule_ignore_categories($id): bool
    {
        return match ($id) {
            9, 10, 11, 17 => true,
            default => false
        };
    }
    # for review when user want confirm list team
    public function review_group($seasons_game_id, $team_id)
    {
        $megaAuth = new MegaAuthenticationController();
        $list = ListOfTeamNames::where('game_season_id', $seasons_game_id)
                ->where('team_name_id', $team_id)
                ->where('accounts_id', $megaAuth->get_account_id('user'))
                ->with('game_season')
                ->get();
        if($list){
            foreach ($list as $ls){
                # if person is not player
                if($ls->post_id == 1) {
                    $teams_allowed_age_id = (int)$ls['game_season'][0]['teams_allowed_age_id'];
                    $category_id = (int)$ls['game_season'][0]['category_id'];
                    $allowed = TeamsAllowedAge::find($teams_allowed_age_id);
                    $allowed_age = $this->clear_date($allowed['date']);
                    $birthdate = $this->clear_date($ls['birthdate']);

                    $flag_scape = $this->rule_ignore_categories($category_id);
                    # if category is some id, do Opposite
                    if (!($allowed_age <= $birthdate) && !$flag_scape) {
                        $ls->report_defects = "سن او بیشتر از سطح تایین شده‌ی این رده مسابقاتی است";
                        $ls->report_defects_at = now();
                        $ls->update();
                    }
                }
            }
        }
    }
    public function review($list_id)
    {
        $ls = ListOfTeamNames::with('game_season')->find($list_id);
        # if person is not player
        if($ls->post_id != 1){
            return true;
        }
        $teams_allowed_age_id = (int) $ls['game_season'][0]['teams_allowed_age_id'];
        $allowed = TeamsAllowedAge::find($teams_allowed_age_id);
        $allowed_age = $this->clear_date($allowed['date']);
        $birthdate = $this->clear_date($ls['birthdate']);
        $category_id = (int)$ls['game_season'][0]['category_id'];
        $flag_scape = $this->rule_ignore_categories($category_id);

        if($allowed_age <= $birthdate){
            return true;
        }elseif($flag_scape){
            return true;
        }else{
            $ls->report_defects = "سن او بیشتر از سطح تایین شده‌ی این رده مسابقاتی است";
            $ls->report_defects_at = now();
            $ls->update();
            return false;
        }
    }

    public function clear_date($date)
    {
        return str_replace('/','',$date);
    }
}

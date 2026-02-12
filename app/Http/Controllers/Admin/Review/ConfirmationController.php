<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ToolsController;
use App\Models\ListOfTeamNames;
use App\Models\TeamsAllowedAge;
use App\Models\TeamsCategories;
use App\Models\TeamsGameSeasons;
use App\Models\TeamsNames;
use App\Models\TeamsPosts;
use Hashids\Hashids;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConfirmationController extends Controller
{
    public function list()
    {

        $gender = request()->get('gender');
        $search = request()->get('search') ? request()->get('search') : "";
        $genderRev = "none";
        if ($gender) {
            if ($gender == "women") {
                $genderRev = "men";
            } else if ($gender == "men") {
                $genderRev = "women";
            }
        }

        $list = DB::table('list_of_team_names')
            ->join('teams_game_seasons', 'teams_game_seasons.id', '=', 'list_of_team_names.game_season_id')
            ->join('teams_names', 'teams_names.id', '=', 'list_of_team_names.team_name_id')
            ->join('teams_categories', 'teams_categories.id', '=', 'teams_game_seasons.category_id')
            ->select(
                'list_of_team_names.id                        as list__id',
                'list_of_team_names.created_at                    as list__created_at',
                'list_of_team_names.updated_at                    as list__updated_at',
                'list_of_team_names.status_user_submit            as list__status_user_submit',
                'list_of_team_names.status_user_submit_at         as list__status_user_submit_at',
                'list_of_team_names.status_print                  as list__status_print',
                'list_of_team_names.status_print_at               as list__status_print_at',
                'list_of_team_names.status_approved               as list__status_approved',
                'list_of_team_names.status_approved_at            as list__status_approved_at',
                'list_of_team_names.report_defects                as list__report_defects',
                'list_of_team_names.report_defects_at             as list__report_defects_at',
                'list_of_team_names.explanation_fixed_defects     as list__explanation_fixed_defects',
                'list_of_team_names.explanation_fixed_defects_at  as list__explanation_fixed_defects_at',
                'list_of_team_names.name                          as list__name',
                'list_of_team_names.surname                       as list__surname',
                'list_of_team_names.birthdate                     as list__birthdate',
                'list_of_team_names.national_code                 as list__national_code',
                'list_of_team_names.identity_code                 as list__identity_code',
                'list_of_team_names.cellphone                     as list__cellphone',
                'list_of_team_names.t_shirt_number                as list__t_shirt_number',
                'list_of_team_names.expire_contract               as list__expire_contract',
                'list_of_team_names.post_id                       as list__post_id',
                'list_of_team_names.team_name_id                  as list__team_name_id',
                'list_of_team_names.game_season_id                as list__game_season_id',
                'list_of_team_names.accounts_id                   as list__accounts_id',
                'list_of_team_names.photo_case                    as list__photo_case',
                'list_of_team_names.photo_identity_card           as list__photo_identity_card',
                'list_of_team_names.photo_national_card           as list__photo_national_card',
                'list_of_team_names.photo_end_of_military_service as list__photo_end_of_military_service',
                'list_of_team_names.photo_enrollment_certificate  as list__photo_enrollment_certificate',
                'list_of_team_names.photo_sports_insurance        as list__photo_sports_insurance',
                'list_of_team_names.photo_contract_page_one       as list__photo_contract_page_one',
                'list_of_team_names.photo_contract_page_two       as list__photo_contract_page_two',
                'list_of_team_names.photo_coaching_card           as list__photo_coaching_card',
                'teams_game_seasons.id                            as game__id',
                'teams_game_seasons.created_at                    as game__created_at',
                'teams_game_seasons.updated_at                    as game__updated_at',
                'teams_game_seasons.date                          as game__date',
                'teams_game_seasons.name                          as game__name',
                'teams_game_seasons.category_id                   as game__category_id',
                'teams_game_seasons.teams_allowed_age_id          as game__teams_allowed_age_id',
                'teams_game_seasons.gender                        as game__gender',
                'teams_game_seasons.status                        as game__status',
                'teams_game_seasons.start_time_at                 as game__start_time_at',
                'teams_game_seasons.finish_time_at                as game__finish_time_at',
                'teams_names.id                                   as team__id',
                'teams_names.created_at                           as team__created_at',
                'teams_names.updated_at                           as team__updated_at',
                'teams_names.name                                 as team__name',
                'teams_names.created_by                           as team__created_by',
                'teams_names.mention_duplicate_id                 as team__mention_duplicate_id',
                'teams_categories.id                              as category__id',
                'teams_categories.created_at                      as category__created_at',
                'teams_categories.updated_at                      as category__updated_at',
                'teams_categories.name                            as category__name'
            )->when($search, function ($q) use ($search) {
                $words = explode(' ', $search);
                $q->where(function ($query) use ($words) {
                    foreach ($words as $word) {
                        $query->where(function ($sub) use ($word) {
                            $sub->where('list_of_team_names.name', 'like', "%{$word}%")
                                ->orWhere('list_of_team_names.surname', 'like', "%{$word}%")
                                ->orWhere('list_of_team_names.national_code', 'like', "%{$word}%")
                                ->orWhere('teams_names.name', 'like', "%{$word}%")
                                ->orWhere('teams_game_seasons.name', 'like', "%{$word}%");
                        });
                    }
                });
            })
            ->where('teams_game_seasons.gender', "!=", $genderRev)
            ->orderByDesc('list_of_team_names.id')
            ->paginate(10)
            ->appends(request()->all());
        return view('admin.review.confirmation.list', [
            'list' => $list,
            'i' => 0,
            'class' => null,
            'title' => null,
            'hash' => new Hashids(),
            'gender' => $gender,
            'search' => $search
        ]);
    }


    public function show($id)
    {
        $hash = new Hashids();
        $id = $hash->decode($id)[0];
        $list = ListOfTeamNames::with(['game_season', 'teams'])->find($id);
        $cat = TeamsCategories::all();
        $team = TeamsNames::all();
        $post = TeamsPosts::all();
        $season = TeamsGameSeasons::all();

        return view('admin.review.confirmation.show', [
            'list' => $list,
            'category' => $cat,
            'team' => $team,
            'post' => $post,
            'season' => $season,
            'hash' => new Hashids(),
        ]);
    }

    protected function research_before_relations($national, $team, $listOfTeamNamesID)
    {
        $list = ListOfTeamNames::where('national_code', $national)
            ->where('status_user_submit', 'done')
            ->where('status_approved', 'done')
            ->orderBy('id')
            ->get();
        if (! $list->isEmpty()) {
            $season_game = TeamsGameSeasons::all();
            $category_id = null;
            $birthdate = null;
            $expire_contract = null;
            foreach ($list as $l) {
                if ($l->team_name_id == $team) {
                    foreach ($season_game as $g) {
                        if ($g->id == $l->game_season_id) {
                            $category_id = $g->category_id;
                        }
                    }
                    $birthdate = $l->birthdate;
                    $expire_contract = $l->expire_contract;
                }
            }
            $this->auto_report($category_id, $birthdate, $expire_contract, $listOfTeamNamesID);
        }

        return null;
    }

    public function clearDate($date)
    {
        if (strlen($date) == 10) {
            $y = substr($date, 0, 4);
            $m = substr($date, 5, 2);
            $d = substr($date, 8, 2);

            return "{$y}{$m}{$d}";
        }

        return null;
    }

    public function getAllowAge($game_season_id)
    {
        $t = TeamsGameSeasons::find($game_season_id);
        $date = TeamsAllowedAge::find($t->teams_allowed_age_id)['date'];
        $tools = new ToolsController();

        return $this->clearDate($date);
    }

    protected function existOldApproveList($national_code)
    {
        $list = ListOfTeamNames::where('national_code', $national_code)
            ->where('status_approved', 'done')
            ->get();
        if ($list->first()) {
            return $list->first();
        }

        return null;
    }

    protected string|null $messageAllowAge = null;

    public function checkAllowAge($game_season_id, $birthdate, $listOfTeamNamesID): bool
    {
        $list = ListOfTeamNames::find($listOfTeamNamesID);
        if ($list->post_id == 1) {
            $existOldBirthdate = $this->existOldApproveList($list->national_code);
            if ($existOldBirthdate != null) {
                $age_clear = $this->clearDate($existOldBirthdate['birthdate']);
            } else {
                $age_clear = $this->clearDate($birthdate);
            }

            $age_allow = $this->getAllowAge($game_season_id);
            if ($age_allow <= $age_clear) {
                $this->messageAllowAge = null;

                return true;
            } else {
                $this->messageAllowAge = 'سن بازیکن برای بازی در این مسابقات زیاد می‌باشد';

                return false;
            }
        }
        $this->messageAllowAge = '';

        return true;
    }

    public function getTeamName($id)
    {
        return TeamsNames::find($id);
    }

    protected string|null $messageExpireContractAdmin = null;

    protected string|null $messageExpireContractUser = null;

    protected function existOldApproveListExpireContract($national_code, $team_name_id, $listOfTeamNamesID): bool
    {
        $list = ListOfTeamNames::where('national_code', $national_code)
            ->where('status_approved', 'done')
            ->get();
        $verta = new Verta();
        $now = $verta->now()->format('Ymd');
        $tools = new ToolsController();
        foreach ($list as $l) {
            $expire_contract = $this->clearDate($l->expire_contract);
            if ($listOfTeamNamesID != $l->id && ! ($now >= $expire_contract)) { // skip current list id and check time bigger or equal expire contract
                if ($team_name_id != $l->team_name_id) {
                    $date = $tools->convertJalaliToGregorian($l->expire_contract, false);
                    $v2 = new Verta($date);
                    $diff = $v2->formatDifference();
                    $team_name = $this->getTeamName($l->team_name_id)['name'];
                    $this->messageExpireContractAdmin = "این شخص تا {$diff} با تیم {$team_name} قرارداد دارد.(تاریخ اتمام {$l->expire_contract})";
                    $this->messageExpireContractUser = "این شخص با تیم {$team_name} قرارداد دارد";

                    return false;
                }
            }
        }
        $this->messageExpireContractAdmin = null;
        $this->messageExpireContractUser = null;

        return true;
    }

    protected function getActiveExpireContract($old_expire_contract, $team_name_id, $listOfTeamNamesID)
    {
        $national_code = ListOfTeamNames::find($listOfTeamNamesID)['national_code'];
        $this->existOldApproveListExpireContract($national_code, $team_name_id, $listOfTeamNamesID);
        //        dd($old_expire_contract, $team_name_id, $this->messageExpireContractUser, $this->messageExpireContractAdmin);
    }

    protected function collectMessages()
    {
        $message = '';
        $message .= ($this->messageAllowAge == null) ? '' : $this->messageAllowAge;
        $message .= ($this->messageExpireContractUser == null) ? '' : $this->messageExpireContractUser;
        $message = ($message == '') ? null : $message;

        return $message;
    }

    protected function auto_report($category_id, $birthdate, $old_expire_contract, $listOfTeamNamesID)
    {
        $list = ListOfTeamNames::find($listOfTeamNamesID);
        $this->checkAllowAge($list->game_season_id, $birthdate, $listOfTeamNamesID);
        $this->getActiveExpireContract($old_expire_contract, $list->team_name_id, $listOfTeamNamesID);

        $list->report_defects = $this->collectMessages();
        $list->report_defects_at = ($this->collectMessages()) ? now() : null;
        $list->update();
    }

    public function confirm($id)
    {
        $hash = new Hashids();
        $id = $hash->decode($id)[0];
        $list = ListOfTeamNames::find($id);
        if ($list->report_defects == null) {
            $list->status_approved = 'done';
            $list->status_approved_at = now();
            $list->update();
            $message = 'تایید انجام شد';
        } else {
            $message = 'می‌بایست اول گزارشات رفع شود، سپس می‌توان تایید کرد';
        }
        Session::flash('message', $message);

        return redirect()->back();
    }

    public function preCheck($id)
    {
        $hash = new Hashids();
        $id = $hash->decode($id)[0];
        $list = ListOfTeamNames::find($id);
        $this->research_before_relations($list->national_code, $list->team_name_id, $id);
        $list = ListOfTeamNames::find($id);
        Session::flash('message', "<strong>این موارد گزارش شد:</strong> {$list->report_defects}");

        return redirect()->back();
    }

    public function report_defects($id, $message)
    {
        //
    }
}

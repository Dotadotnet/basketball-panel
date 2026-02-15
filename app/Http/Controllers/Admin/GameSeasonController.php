<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ToolsController;
use App\Models\TeamsAllowedAge;
use App\Models\TeamsCategories;
use App\Models\TeamsGameSeasons;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameSeasonController extends Controller
{
    public function list()
    {
        //        $list = TeamsGameSeasons::paginate(10)->sortByDesc('start_time_at');
        $gender = request()->get('gender');
        $category = request()->get('category');
        $genderReve = "none";
        if ($gender) {
            if ($gender == "women") {
                $genderReve = "men";
            } else if ($gender == "men") {
                $genderReve = "women";
            }
        }
        $cat = TeamsCategories::all();
        $categoryIds = [];
        foreach ($cat as $c) {
            array_push($categoryIds, $c->id);
        }
        $list = DB::table('teams_game_seasons')->orderByDesc('start_time_at')->when($category && in_array($category, $categoryIds), function ($q) use ($category) {
            $q->where('category_id', $category);
        })->where('gender', "!=", $genderReve)->paginate(8);
        $allow = TeamsAllowedAge::all();

        return view('admin.setting.game-season.list', [
            'list' => $list,
            'category' => $cat,
            'allowAge' => $allow,
            'i' => 0,
            'tools' => new ToolsController(),
            "gender" => $gender,
            "categorySelected" => $category
        ]);
    }


    public function team($id)
    {
        $info =  DB::table('teams_game_seasons')
            ->join('teams_categories', 'teams_game_seasons.category_id', '=', 'teams_categories.id')
            ->select(
                'teams_game_seasons.*',
                'teams_categories.name as category_name'
            )->where('teams_game_seasons.id', "=", $id)->first();
        $list = DB::table('list_of_team_names')
            ->join('teams_game_seasons', 'teams_game_seasons.id', '=', 'list_of_team_names.game_season_id')
            ->join('teams_posts', 'teams_posts.id', '=', 'list_of_team_names.post_id')
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
                'teams_posts.name                                 as list__post_name',
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
            )->where('game_season_id', "=", $id)->get();

        $teams_id = [];
        $teams = [];

        foreach ($list as $l) {
            if (!in_array($l->team__id, $teams_id)) {
                array_push($teams, ["id" => $l->team__id, "name" => $l->team__name]);
                array_push($teams_id, $l->team__id);
            }
        }
        return view('admin.setting.game-season.team', [
            'info' => $info,
            "teams" => $teams
        ]);
    }
    public function members($id, $team)
    {
        $teamInfo = DB::table('teams_names')->where('id', "=", $team)->first();
        $info =  DB::table('teams_game_seasons')
            ->join('teams_categories', 'teams_game_seasons.category_id', '=', 'teams_categories.id')
            ->select(
                'teams_game_seasons.*',
                'teams_categories.name as category_name'
            )->where('teams_game_seasons.id', "=", $id)->first();
        $list = DB::table('list_of_team_names')
            ->join('teams_game_seasons', 'teams_game_seasons.id', '=', 'list_of_team_names.game_season_id')
            ->join('teams_names', 'teams_names.id', '=', 'list_of_team_names.team_name_id')
            ->join('teams_posts', 'teams_posts.id', '=', 'list_of_team_names.post_id')
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
                'teams_posts.name                                 as list__post_name',
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
            )
            ->where('game_season_id', "=", $id)
            ->where('team_name_id', "=", $team)
            ->orderByDesc('list_of_team_names.id')
            ->paginate(10)
            ->appends(request()->all());
        return view('admin.setting.game-season.members', [
            'list' => $list,
            'info' => $info,
            'teamInfo' => $teamInfo,
            'i' => 0,
            'class' => null,
            'title' => null,
            'hash' => new Hashids()
        ]);
    }

    public function create()
    {
        $cat = TeamsCategories::all();
        $allow = TeamsAllowedAge::all();

        return view('admin.setting.game-season.create', [
            'category' => $cat,
            'allowAge' => $allow,
        ]);
    }

    public function store(Request $request)
    {
        $valid = $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'category_id' => 'required',
            'teams_allowed_age_id' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'start_time_at' => 'required',
            'finish_time_at' => '',
        ]);

        $hash = new Hashids();
        $tools = new ToolsController();

        $data = [
            'name' => $valid['name'],
            'date' => $valid['date'],
            'category_id' => $hash->decode($valid['category_id'])[0],
            'teams_allowed_age_id' => $hash->decode($valid['teams_allowed_age_id'])[0],
            'gender' => $valid['gender'],
            'status' => $valid['status'],
            'start_time_at' => $tools->convertJalaliToGregorian($valid['start_time_at']),
            'finish_time_at' => $tools->convertJalaliToGregorian($valid['finish_time_at']),
        ];
        TeamsGameSeasons::create($data);

        return redirect()->route('admin.setting.game_season.list');
    }

    public function edit($id)
    {
        $hash = new Hashids();
        $cat = TeamsCategories::all();
        $allow = TeamsAllowedAge::all();
        $id = $hash->decode($id)[0];
        $data = TeamsGameSeasons::find($id);

        return view('admin.setting.game-season.edit', [
            'data' => $data,
            'category' => $cat,
            'allowAge' => $allow,
            'hash' => new Hashids(),
            'jalali' => new ToolsController(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $valid = $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'category_id' => 'required',
            'teams_allowed_age_id' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'start_time_at' => 'required',
            'finish_time_at' => '',
        ]);

        $hash = new Hashids();
        $tools = new ToolsController();
        $data = [
            'name' => $valid['name'],
            'date' => $valid['date'],
            'category_id' => $hash->decode($valid['category_id'])[0],
            'teams_allowed_age_id' => $hash->decode($valid['teams_allowed_age_id'])[0],
            'gender' => $valid['gender'],
            'status' => $valid['status'],
            'start_time_at' => $tools->convertJalaliToGregorian($valid['start_time_at']),
            'finish_time_at' => $tools->convertJalaliToGregorian($valid['finish_time_at']),
        ];
        TeamsGameSeasons::find($hash->decode($id)[0])->update($data);

        return redirect()->route('admin.setting.game_season.list');
    }

    public function destroy($id)
    {
        $hash = new Hashids();
        $t = TeamsGameSeasons::find($hash->decode($id)[0]);
        $t->delete();

        return redirect()->back();
    }

    public function archive() {}
}

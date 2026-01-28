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
        $list = DB::table('teams_game_seasons')->orderByDesc('start_time_at')->paginate(8);
        $cat = TeamsCategories::all();
        $allow = TeamsAllowedAge::all();

        return view('admin.setting.game-season.list', [
            'list' => $list,
            'category' => $cat,
            'allowAge' => $allow,
            'i' => 0,
            'tools' => new ToolsController(),
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

    public function archive()
    {
    }
}

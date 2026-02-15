<?php

namespace App\Http\Controllers\UserAccounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilesController;
use App\Models\ListOfTeamNames;
use App\Models\TeamsCategories;
use App\Models\TeamsGameSeasons;
use App\Models\TeamsNames;
use App\Models\TeamsPosts;
use App\Models\TeamsReceiptPayments;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function home()
    {
        return view('teams.dashboard');
    }

    public function dataEntry($season_game_id, $team_name_id)
    {
        $post = TeamsPosts::all();
        $user_id = Auth::guard('user')->id();
        $hash = new Hashids();
        $list = ListOfTeamNames::where(
            [
                ['game_season_id', '=', $hash->decode($season_game_id)[0]],
                ['accounts_id', '=', $user_id]
            ]
        )->first();

        if ($list) {
            $nameTeam = TeamsNames::where([['id', "=", $list->team_name_id]])->first()->name;
            return redirect()->back()->with('messages', json_encode([
                "title" => "شما قبلا در یک تیم ثبت درخواست کردید",
                "content" => "اول درخواست خود را به تیم $nameTeam لغو کنید",
                "type" => "error"
            ]));
        }



        return view('teams.date_entry', [
            'post' => $post,
            'team_name_id' => $team_name_id,
            'season_game_id' => $season_game_id,
        ]);
    }

    public function payment()
    {
        return view('teams.payment');
    }

    public function paymentReceiptProcess(Request $request)
    {
        $request->validate([
            'picture' => 'required|image',
            'date' => 'required|size:10',
        ]);
        $hash = new Hashids();
        $filesController = new FilesController();
        $fileID = $filesController->fileStore($request, 'picture', 'user', 'user');
        $payment = new TeamsReceiptPayments();
        $payment->accounts_id = Auth::guard('user')->id();
        $payment->files_id = $fileID;
        $payment->date = $request->input('date');
        $payment->save();

        return redirect()->back()->with('message', 'فیش ثبت گردید، پس از تایید آن امکان دسترسی به بخش ورود اطلاعات را خواهید داشت');
    }

    public function listOfTeam()
    {
        $post = TeamsPosts::all();

        return view('teams.list_of_team', [
            'post' => $post,
        ]);
    }

    public function gameSeasons()
    {
        $gameSeasons = TeamsGameSeasons::where('finish_time_at', null)->get();
        $categories = TeamsCategories::all();

        return view('teams.game_seasons', [
            'game_seasons' => $gameSeasons,
            'categories' => $categories,
            'i' => 0,
        ]);
    }

    public function team($id)
    {
        return view('teams.team', [
            'id' => $id,
        ]);
    }

    public function teamSearch(Request $request, $id)
    {
        $valid = $this->validate($request, [
            'team' => 'required',
        ]);
        $teams_names = TeamsNames::where('name', 'LIKE', "%{$valid['team']}%")->get();

        return view('teams.team_search', [
            'teams_names' => $teams_names,
            'id' => $id,
            'i' => 0,
        ]);
    }

    public function createTeam($id)
    {
        return view('teams.create_team', [
            'id' => $id,
        ]);
    }

    public function createTeamProcess(Request $request, $id)
    {
        $valid = $this->validate($request, [
            'team' => 'required',
        ]);
        $account_id = Auth::guard('user')->id();

        $team = new TeamsNames();
        $team->name = $valid['team'];
        $team->created_by = $account_id;
        $team->save();
        Session::flash('message', 'تیم جدید با موفقیت ایجاد شد، برای ادامه نام تیم را جستجو کنید');

        return redirect()->route('dashboard.team', ['id' => $id]);
    }

    public function list($id, $name_id)
    {
        $hash = new Hashids();
        $game_season_id = $hash->decode($id)[0];
        $team_name_id = $hash->decode($name_id)[0];
        $account_id = Auth::guard('user')->id();
        $post = TeamsPosts::all();
        $list = ListOfTeamNames::where('team_name_id', $team_name_id)
            ->where('game_season_id', $game_season_id)
            ->where('accounts_id', $account_id)
            ->paginate(9);
        // players
        $list_player = ListOfTeamNames::where('team_name_id', $team_name_id)
            ->where('game_season_id', $game_season_id)
            ->where('accounts_id', $account_id)
            ->where('post_id', 1)
            ->count();
        // technical cadre
        $list_cadre = ListOfTeamNames::where('team_name_id', $team_name_id)
            ->where('game_season_id', $game_season_id)
            ->where('accounts_id', $account_id)
            ->where('post_id', '!=', 1)
            ->count();
        // count number allow for make pdf link active
        $pdf_link = $list_player >= 5 && $list_cadre >= 1;
        return view('teams.list', [
            'game_season_id' => $id,
            'team_name_id' => $name_id,
            'post' => $post,
            'list' => $list,
            'i' => 0,
            'pdf_link' => $pdf_link,
        ]);
    }

    public function listEdit($id, $name_id, $list_id)
    {
        $hash = new Hashids();
        $list_id = $hash->decode($list_id)[0];
        $list = ListOfTeamNames::find($list_id);
        $post = TeamsPosts::all();

        return view('teams.list_edit', [
            'seasons_game_id' => $id,
            'team_id' => $name_id,
            'list' => $list,
            'hash' => $hash,
            'post' => $post,
            "roll" => Auth::guard('user')->id() ? "user" : "admin"
        ]);
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/login');
    }
}

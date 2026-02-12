<?php

namespace App\Http\Controllers\UserAccounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilesController;
use App\Models\ListOfTeamNames;
use App\Rules\AuthorizedFilesConfigurationRule;
use App\Rules\CellphoneRule;
use App\Rules\ExpireContractRule;
use App\Rules\ValidAgeRule;
use App\Rules\ValidIdentityCodeRule;
use App\Rules\ValidNationalCodeRule;
use App\Rules\ValidTShirtNumberRule;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ListOfTeamNamesController extends Controller
{
    public function create(Request $request, $season_game_id, $team_name_id)
    {
        // init
        $hash = new Hashids();
        $files = new FilesController();
        $list = new ListOfTeamNames();
        $season_game_id = $hash->decode($season_game_id)[0];
        $team_name_id = $hash->decode($team_name_id)[0];

        // check count players are >= 15
        $list_player = ListOfTeamNames::where('team_name_id', $team_name_id)
            ->where('game_season_id', $season_game_id)
            ->where('accounts_id', Auth::guard('user')->id())
            ->where('post_id', 1)
            ->count();
        if ($list_player >= 15 && $hash->decode($request->input('post'))[0] == 1) {
            Session::flash('message', "تعداد بازیکنان تا ۱۵ نفر مجاز می‌باشد");
            return redirect()->back();
        }

        $this->validate($request, [
            'name' => 'string',
            'surname' => 'string',
            'nationalCode' => new ValidNationalCodeRule(),
            'identityCode' => new ValidIdentityCodeRule(),
            'birthdate' => new ValidAgeRule(),
            'cellphone' => new CellphoneRule(),
            'tShirtNumber' => new ValidTShirtNumberRule(),
            'expireContract' => new ExpireContractRule(),
            'post' => 'string',
            'photo_case' => new AuthorizedFilesConfigurationRule(),
            'photo_identity_card' => new AuthorizedFilesConfigurationRule(),
            'photo_national_card' => new AuthorizedFilesConfigurationRule(),
            'photo_end_of_military_service' => new AuthorizedFilesConfigurationRule(),
            'photo_enrollment_certificate' => new AuthorizedFilesConfigurationRule(),
            'photo_sports_insurance' => new AuthorizedFilesConfigurationRule(),
            'photo_contract_page_one' => new AuthorizedFilesConfigurationRule(),
            'photo_contract_page_two' => new AuthorizedFilesConfigurationRule(),
            'photo_coaching_card' => new AuthorizedFilesConfigurationRule()
        ]);

        $list->name = $request->input('name');
        $list->surname = $request->input('surname');
        $list->national_code = $request->input('nationalCode');
        $list->identity_code = $request->input('identityCode');
        $list->birthdate = $request->input('birthdate');
        $list->cellphone = $request->input('cellphone');
        $list->t_shirt_number = $request->input('tShirtNumber');
        $list->expire_contract = $request->input('expireContract') . '/01/31';
        $list->post_id = $hash->decode($request->input('post'))[0];
        $list->accounts_id = Auth::guard('user')->id();
        $list->game_season_id = $season_game_id;
        $list->team_name_id = $team_name_id;
        $list->photo_case = $files->fileStore($request, 'photo_case', 'user', 'user');
        $list->photo_identity_card = $files->fileStore($request, 'photo_identity_card', 'user', 'user');
        $list->photo_national_card = $files->fileStore($request, 'photo_national_card', 'user', 'user');
        $list->photo_end_of_military_service = $files->fileStore($request, 'photo_end_of_military_service', 'user', 'user');
        $list->photo_enrollment_certificate = $files->fileStore($request, 'photo_enrollment_certificate', 'user', 'user');
        $list->photo_sports_insurance = $files->fileStore($request, 'photo_sports_insurance', 'user', 'user');
        $list->photo_contract_page_one = $files->fileStore($request, 'photo_contract_page_one', 'user', 'user');
        $list->photo_contract_page_two = $files->fileStore($request, 'photo_contract_page_two', 'user', 'user');
        $list->photo_coaching_card = $files->fileStore($request, 'photo_coaching_card', 'user', 'user');
        $list->save();
        $age = (new AgeCheckController())->review($list['id']);
        if (!$age) {
            Session::flash('message', "ثبت اولیه انجام شد، اما سن او بیشتر از سطح تایین شده‌ی این رده مسابقاتی است");
        } else {
            Session::flash('message', "ثبت اولیه انجام شد");
        }

        return redirect(route('dashboard.team.list.entry.person', [
            'id' => $season_game_id,
            'name_id' => $team_name_id,
        ]));
    }

    public function edit(Request $request, $seasons_game_id, $team_id, $list_id)
    {
        $valid = $this->validate($request, [
            'name' => 'string',
            'surname' => 'string',
            'nationalCode' => new ValidNationalCodeRule(),
            'identityCode' => new ValidIdentityCodeRule(),
            'birthdate' => new ValidAgeRule(),
            'cellphone' => new CellphoneRule(),
            'tShirtNumber' => new ValidTShirtNumberRule(),
            'expireContract' => new ExpireContractRule(),
            'post' => 'string',
            'photo_case' => new AuthorizedFilesConfigurationRule(),
            'photo_identity_card' => new AuthorizedFilesConfigurationRule(),
            'photo_national_card' => new AuthorizedFilesConfigurationRule(),
            'photo_end_of_military_service' => new AuthorizedFilesConfigurationRule(),
            'photo_enrollment_certificate' => new AuthorizedFilesConfigurationRule(),
            'photo_sports_insurance' => new AuthorizedFilesConfigurationRule(),
            'photo_contract_page_one' => new AuthorizedFilesConfigurationRule(),
            'photo_contract_page_two' => new AuthorizedFilesConfigurationRule(),
            'photo_coaching_card' => new AuthorizedFilesConfigurationRule(),
        ]);
        $hash = new Hashids();
        $files = new FilesController();

        $list = ListOfTeamNames::find($hash->decode($list_id)[0]);
        $list->name = $request->input('name');
        $list->surname = $request->input('surname');
        $list->national_code = $request->input('nationalCode');
        $list->identity_code = $request->input('identityCode');
        $list->birthdate = $request->input('birthdate');
        $list->cellphone = $request->input('cellphone');
        $list->t_shirt_number = $request->input('tShirtNumber');
        $list->expire_contract = $request->input('expireContract') . '/01/31';
        $list->post_id = $hash->decode($request->input('post'))[0];

        if (array_key_exists('photo_case', $valid)) {
            $list->photo_case = $files->fileStore($request, 'photo_case', 'user', 'user');
        }
        if (array_key_exists('photo_identity_card', $valid)) {
            $list->photo_identity_card = $files->fileStore($request, 'photo_identity_card', 'user', 'user');
        }
        if (array_key_exists('photo_national_card', $valid)) {
            $list->photo_national_card = $files->fileStore($request, 'photo_national_card', 'user', 'user');
        }
        if (array_key_exists('photo_end_of_military_service', $valid)) {
            $list->photo_end_of_military_service = $files->fileStore($request, 'photo_end_of_military_service', 'user', 'user');
        }
        if (array_key_exists('photo_enrollment_certificate', $valid)) {
            $list->photo_enrollment_certificate = $files->fileStore($request, 'photo_enrollment_certificate', 'user', 'user');
        }
        if (array_key_exists('photo_sports_insurance', $valid)) {
            $list->photo_sports_insurance = $files->fileStore($request, 'photo_sports_insurance', 'user', 'user');
        }
        if (array_key_exists('photo_contract_page_one', $valid)) {
            $list->photo_contract_page_one = $files->fileStore($request, 'photo_contract_page_one', 'user', 'user');
        }
        if (array_key_exists('photo_contract_page_two', $valid)) {
            $list->photo_contract_page_two = $files->fileStore($request, 'photo_contract_page_two', 'user', 'user');
        }
        if (array_key_exists('photo_coaching_card', $valid)) {
            $list->photo_coaching_card = $files->fileStore($request, 'photo_coaching_card', 'user', 'user');
        }
        $list->update();
        Session::flash('message', 'اطلاعات آپدیت شد');

        return redirect()->back();
    }

    public function delete($seasons_game_id, $team_id, $list_id)
    {
        $hash = new Hashids();
        $list = ListOfTeamNames::find($hash->decode($list_id)[0]);
        $list->delete();

        return redirect()->back();
    }

    public function confirm($seasons_game_id, $team_id)
    {
        $hash = new Hashids();
        $seasons_game_id = $hash->decode($seasons_game_id)[0];
        $team_id = $hash->decode($team_id)[0];
        (new AgeCheckController())->review_group(seasons_game_id: $seasons_game_id, team_id: $team_id);
        ListOfTeamNames::where('team_name_id', $team_id)
            ->where('game_season_id', $seasons_game_id)
            ->where('accounts_id', Auth::guard('user')->id())
            ->where('report_defects', null)
            ->update([
                'status_user_submit' => 'done',
                'status_user_submit_at' => now(),
            ]);

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AccountsTokens;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

class MegaAuthenticationController extends Controller
{
    private string $token_name = 'token_';

    /**
     * create new auth from [session, database]
     *
     * @param  string  $user_type
     * @param  string  $account_id
     * @return mixed|UuidInterface|string
     */
    public function create(string $user_type, string $account_id)
    {
        // check if uuid not exists
        false_uuid:
        $uuid = Str::uuid();
        $check = AccountsTokens::where('token', $uuid)->first();
        if (! is_null($check)) {
            goto false_uuid;
        }

        // convert hash to normal account id
        $hash = new Hashids();
        $account_id = $hash->decode($account_id)[0];

        $token = new AccountsTokens();
        $token->name = $user_type;
        $token->token = $uuid;
        $token->accounts_id = $account_id;
        $token->last_used_at = now();
        $token->ip_address = \request()->ip();
        $token->account_type = $user_type;
        $token->save();

        Session::put($user_type, $token->token);

        return $token->token;
    }

    /**
     * Check auth is valid or not valid
     *
     * @param $user_type
     * @return bool
     */
    public function check($user_type): bool
    {
        if (Session::has($user_type)) {
            $this->update($user_type);

            return true;
        } else {
            return false;
        }
    }

    /**
     * fresh last used to current time in database
     *
     * @param $user_type
     * @return Application|RedirectResponse|Redirector or update
     */
    public function update($user_type)
    {
//        dd($user_type);
        if (Session::has($user_type)) {
            $token = Session::get($user_type);
            $find = AccountsTokens::where('token', $token)->first();
//            dd($find);
            if ($find == null) {
                Session::forget($user_type) && (new MegaAuthenticationController())->destroy('none');
            }
            if ($find->last_used_at != null && $find->last_used_at > now()->addMinutes(5)) {
                if ($find->account_type == 'admin') {
                    return redirect(route($this->redirect_admin))->with('message', 'توکن منقضی شده');
                } else {
                    return redirect(route($this->redirect_user))->with('message', 'توکن منقضی شده');
                }
            }
            $find->last_used_at = now();
            $find->update();
        } else {
            $this->destroy('none');
        }
    }

    /** @var string route name */
    private string $redirect_user = 'login';

    /** @var string route name */
    private string $redirect_admin = 'admin.login';

    /**
     * delete current auth from [sessions, database]
     *
     * @param $user_type
     * @return Redirector|Application|RedirectResponse
     */
    public function destroy($user_type): Redirector|Application|RedirectResponse
    {
        if (Session::has($user_type)) {
            $token = Session::get($user_type);
            $find = AccountsTokens::where('token', $token)->first();
            $find->delete();
        }
        Session::forget($user_type);

        if ($user_type == 'admin') {
            return redirect(route($this->redirect_admin));
        } else {
            return redirect(route($this->redirect_user));
        }
    }

    public function get_account_id($user_type)
    {
        if (Session::has($user_type)) {
            $token = Session::get($user_type);
            $find = AccountsTokens::where('token', $token)->first();

            return $find->accounts_id;
        }

        return null;
    }
}

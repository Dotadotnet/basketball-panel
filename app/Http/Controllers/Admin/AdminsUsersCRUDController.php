<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountsAdmins;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminsUsersCRUDController extends Controller
{
    public function index()
    {
        $hashids = new Hashids();
        $result = AccountsAdmins::where('visible', '=', false)->get();
        $i = 0;
        return view('admin.users_admin.index', compact('result', 'hashids', 'i'));
    }

    public function status($id)
    {
        $hashids = new Hashids();
        $id = $hashids->decode($id);
        $accounts = AccountsAdmins::where('id', $id)->first();
        $accounts->status = ($accounts->status == 'enabled') ? 'disabled' : 'enabled'; # this is like toggle jquery
        $accounts->update();
        return redirect()->route('admin.admin_users.index');
    }

    public function create()
    {
        return view('admin.users_admin.create');
    }

    public function store(Request $request)
    {
        $account = new AccountsAdmins();
        $res = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:accounts_admins',
            'username' => 'required|string|unique:accounts_admins|min:8|max:255',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ]
        ]);
        $account->name = $res['name'];
        $account->surname = $res['surname'];
        $account->email = $res['email'];
        $account->username = $res['username'];
        $account->password = Hash::make($res['password']);
        $account->save();
        return redirect()->route('admin.admin_users.index')->with('message', 'کاربر ایجاد گردید، حال برای استفاده باید آنرا فعال نمایید');
    }

    public function delete($id)
    {
        $hashids = new Hashids();
        $id = $hashids->decode($id);
        AccountsAdmins::destroy($id);
        return redirect()->route('admin.admin_users.index');
    }
}

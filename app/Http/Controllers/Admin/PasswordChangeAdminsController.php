<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountsAdmins;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordChangeAdminsController extends Controller
{

    // view one person
    public function edit($id)
    {
        $new_password = Str::random(30);
        $id = \Vinkla\Hashids\Facades\Hashids::decode($id)[0];
        $user = AccountsAdmins::find($id);
        $user->password = Hash::make($new_password);
        $user->update();
        return view('admin.users_admin.password_change.edit', ['user' => $user, 'new_password' => $new_password]);
    }
}

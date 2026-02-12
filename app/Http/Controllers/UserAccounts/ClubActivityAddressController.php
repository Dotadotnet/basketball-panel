<?php

namespace App\Http\Controllers\UserAccounts;

use App\Http\Controllers\Controller;
use App\Models\ClubActivityAddress;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubActivityAddressController extends Controller
{
    public function index()
    {
        $id = Auth::guard('user')->id();
        $hashids = new Hashids();
        $res = ClubActivityAddress::where('accounts_id', '=', $id)->get();
        $i = 0;
        return view('teams.club_activity.index', compact('hashids', 'res', 'i'));
    }

    public function create()
    {
        return view('teams.club_activity.create');
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'number_phone' => 'required|numeric'
        ]);
        $id = Auth::guard('user')->id();
        $club = new ClubActivityAddress();
        $club->name = $valid['name'];
        $club->address = $valid['address'];
        $club->number_phone = $valid['number_phone'];
        $club->accounts_id = $id;
        $club->save();
        return redirect()->route('dashboard.my_club.index');
    }

    public function destroy($id)
    {
        $hashids = new Hashids();
        $id = $hashids->decode($id)[0];
        ClubActivityAddress::where('id', '=', $id)->delete();
        return redirect()->route('dashboard.my_club.index');
    }
}

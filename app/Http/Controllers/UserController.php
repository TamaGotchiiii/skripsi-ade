<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Unit;

class UserController extends Controller
{
    public function userList()
    {
        if (Auth::user()->level_user == 0) {
            $users = User::with('unit')
                ->where('id', '!=', Auth::user()->id)
                ->orderBy('level_user', 'asc')
                ->get();

            $units = Unit::all();

            return view('user-list.index', compact('users', 'units'));
        } else {
            dd('You do not have any permission to access this page!');
        }
    }

    public function checkEmail()
    {
        $userCount = User::where('email', '=', request()->email)
            ->get()->count();

        return response([
            'userCount' => $userCount,
        ]);
    }

    public function checkUsername()
    {
        $userCount = User::where('username', '=', request()->username)
            ->get()->count();

        return response([
            'userCount' => $userCount,
        ]);
    }
}

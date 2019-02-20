<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userList()
    {
        if (Auth::user()->level_user == 0) {
            $users = User::with('unit')
                ->where('id', '!=', Auth::user()->id)
                ->orderBy('level_user', 'asc')
                ->get();

            $units = Unit::orderBy('name', 'asc')->get();

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

    public function checkEditEmail()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|unique:users,email,'.request()->id.',id',
        ]);
        if ($validator->fails()) {
            return response([
                'errors' => true,
            ]);
        }

        return response([
            'errors' => false,
        ]);
    }

    public function checkEditUsername()
    {
        $validator = Validator::make(request()->all(), [
            'username' => 'required|string|min:5|unique:users,username,'.request()->id.',id',
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => true,
            ]);
        }

        return response([
            'errors' => false,
        ]);
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'username' => 'required|string|unique:users|min:5',
            'password' => 'required|string|confirmed|min:8',
            'unit' => 'required|string',
            'level' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $checkUsername = 0;
            $checkEmail = 0;
            if ($validator->errors()->first('username') || $validator->errors()->first('email')) {
                $checkUsername = User::where('username', '=', request()->username)
                    ->get()->count();
                $checkEmail = User::where('email', '=', request()->email)
                    ->get()->count();
            }

            return response([
                'errors' => true,
                'usernameDuplicate' => $checkUsername,
                'emailDuplicate' => $checkEmail,
            ]);
        }

        if (!is_numeric(request()->unit)) {
            $unit = Unit::where('name', '=', request()->unit)
                ->first();
            $unit_id = $unit->id;
        } else {
            $unit_id = request()->unit;
        }

        $user = new User([
            'name' => request()->name,
            'email' => request()->email,
            'username' => request()->username,
            'password' => bcrypt(request()->password),
            'unit_id' => $unit_id,
            'level_user' => request()->level,
        ]);
        $user->save();

        return response([
            'errors' => false,
        ]);
    }

    public function destroy()
    {
        $user = User::find(request()->id);
        $user->delete();

        return response([
            'result' => 'Berhasil delete user!',
        ]);
    }

    public function update()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,'.request()->id.',id',
            'username' => 'required|string|min:5|unique:users,username,'.request()->id.',id',
            'unit' => 'required|string',
            'level' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $checkUsername = 0;
            $checkEmail = 0;
            if ($validator->errors()->first('username') || $validator->errors()->first('email')) {
                $checkUsername = User::where('username', '=', request()->username)
                    ->get()->count();
                $checkEmail = User::where('email', '=', request()->email)
                    ->get()->count();
            }

            return response([
                'errors' => true,
                'usernameDuplicate' => $checkUsername,
                'emailDuplicate' => $checkEmail,
            ]);
        }

        if (!is_numeric(request()->unit)) {
            $unit = Unit::where('name', '=', request()->unit)
                ->first();
            $unit_id = $unit->id;
        } else {
            $unit_id = request()->unit;
        }

        $user = User::find(request()->id);
        $user->name = request()->name;
        $user->email = request()->email;
        $user->username = request()->username;
        $user->unit_id = $unit_id;
        $user->level_user = request()->level;
        $user->save();

        return response([
            'errors' => false,
        ]);
    }

    public function resetPassword()
    {
        $validator = Validator::make(request()->all(), [
            'id' => 'required|numeric',
            'adminPass' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response([
                'errors' => true,
                'password_errors' => false,
            ]);
        }
        if (!Hash::check(request()->adminPass, Auth::user()->password)) {
            return response([
                'errors' => true,
                'password_errors' => true,
            ]);
        }

        $new_password = str_random(8);
        $user = User::find(request()->id);
        $user->password = bcrypt($new_password);
        $email = $user->email;
        Mail::send(['html' => 'mail.reset-password'], [
                'user' => $user->name,
                'admin' => Auth::user()->name,
                'password' => $new_password,
        ], function ($message) use ($email) {
            $message->subject('Reset Password Akun');
            $message->from('unmulcomplaint@gmail.com', 'Biro Akademik Universitas Mulawarman');
            $message->to($email);
        });
        $user->save();

        return response([
            'errors' => false,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Complain;
use App\ComplainType;
use Illuminate\Support\Facades\Auth;
use App\Unit;
use App\User;

class ComplainController extends Controller
{
    public function index()
    {
        $complain_types = ComplainType::all();
        $units = Unit::all();
        $user = User::with('unit')
            ->where('id', '=', Auth::user()->id)
            ->first();
        if (Auth::user()->level_user != 2) {
            $queue = Complain::where('status', '=', 0)->get();
            $onProgress = Complain::where('status', '=', 1)->get();
            $done = Complain::where('status', '=', 2)->get();

            if (Auth::user()->level_user == 0) {
                $complains = Complain::with('complain_type', 'unit', 'attachments', 'user')
                    ->where('user_id', '!=', Auth::user()->id)
                    ->orderBy('status', 'asc')
                    ->get();
            } else {
                $complains = Complain::with('user', 'complain_type', 'unit', 'attachments', 'user')
                    ->get();
            }

            return view('complain-queue.index', compact('complains', 'complain_types', 'queue', 'onProgress', 'done', 'units'));
        } else {
            $complains = Complain::with('complain_type', 'unit', 'attachments', 'user')
                ->where('unit_id', '=', Auth::user()->unit_id)
                ->get();

            return view('complain-queue.index', compact('user', 'complains', 'complain_types', 'units'));
        }
        // $complains = Complain::with('complain_type', 'unit', 'attachments', 'user')
        //     ->where('status', '=', 0)
        //     ->get();
        // $complains = Complain::with('complain_type', 'unit', 'attachments')
        //     ->where('unit_id', '=', 2)
        //     ->get();
    }

    public function inProgress()
    {
        if (Auth::user()->level_user != 0) {
            dd('You do not have any permission to access this page!');
        } else {
            $complains = Complain::with('complain_type', 'unit', 'attachments')
                ->where('status', '=', 1)
                ->where('user_id', '=', Auth::user()->id)
                ->get();
            $complain_types = ComplainType::all();
            $units = Unit::all();

            return view('complain-in-progress.index', compact('complains', 'complain_types', 'units'));
        }
    }

    public function complete()
    {
        if (Auth::user()->level_user != 0) {
            dd('You do not have any permission to access this page!');
        } else {
            $complains = Complain::with('complain_type', 'unit', 'attachments')
                ->where('status', '=', 2)
                ->where('user_id', '=', Auth::user()->id)
                ->get();

            return view('complain-complete.index', compact('complains'));
        }
    }
}

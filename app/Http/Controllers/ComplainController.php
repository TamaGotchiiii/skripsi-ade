<?php

namespace App\Http\Controllers;

use App\Complain;
use App\ComplainType;
use Illuminate\Support\Facades\Auth;

class ComplainController extends Controller
{
    public function index()
    {
        $complain_types = ComplainType::all();
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
                $complains = Complain::with('complain_type', 'unit', 'attachments', 'user')
                    ->get();
            }

            return view('complain-queue.index', compact('complains', 'complain_types', 'queue', 'onProgress', 'done'));
        } else {
            $complains = Complain::with('complain_type', 'unit', 'attachments', 'user')
                ->where('unit_id', '=', Auth::user()->unit_id)
                ->get();

            return view('complain-queue.index', compact('complains', 'complain_types'));
        }
        // $complains = Complain::with('complain_type', 'unit', 'attachments', 'user')
        //     ->where('status', '=', 0)
        //     ->get();
        // $complains = Complain::with('complain_type', 'unit', 'attachments')
        //     ->where('unit_id', '=', 2)
        //     ->get();
    }
}

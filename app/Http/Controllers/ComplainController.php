<?php

namespace App\Http\Controllers;

use App\Complain;
use App\ComplainType;
use Illuminate\Support\Facades\Auth;
use App\Unit;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Attachment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;

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
            $year = date('Y');
            $queue = Complain::where('status', '=', 0)->get();
            $onProgress = Complain::where('status', '=', 1)->get();
            $done = Complain::where('status', '=', 2)
            ->where('created_at', 'LIKE', '%'.$year.'%')
            ->get();

            if (Auth::user()->level_user == 0) {
                $complains = Complain::with('complain_type', 'unit', 'attachments', 'user')
                    ->where('status', '!=', 2)
                    ->where('user_id', '!=', Auth::user()->id)
                    ->orWhere('user_id', '=', null)
                    ->orderBy('status', 'asc')
                    ->get();
            } else {
                $complains = Complain::with('complain_type', 'unit', 'attachments', 'user')
                    ->get();
            }

            return view('complain-queue.index', compact('complains', 'complain_types', 'queue', 'onProgress', 'done', 'units', 'user'));
        } else {
            $complains = Complain::with('complain_type', 'unit', 'attachments', 'user')
                ->where('status', '!=', 2)
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
            $year = date('Y');
            $complains = Complain::with('complain_type', 'unit', 'attachments')
                ->orderBy('updated_at', 'asc')
                ->where('status', '=', 2)
                ->where('updated_at', 'LIKE', '%'.$year.'%')
                ->get();

            return view('complain-complete.index', compact('complains'));
        }
    }

    public function completed()
    {
        if (Auth::user()->level_user != 0) {
            dd('You do not have any permission to access this page!');
        } else {
            $year = date('Y');
            $complains = Complain::with('complain_type', 'unit', 'attachments')
                ->orderBy('updated_at', 'asc')
                ->where('status', '=', 2)
                ->where('updated_at', 'LIKE', '%'.$year.'%')
                ->where('user_id', '=', Auth::user()->id)
                ->get();

            return view('complain-complete.index', compact('complains'));
        }
    }

    public function done()
    {
        $complain = Complain::find(request()->id);

        $complain->status = 2;

        $complain->save();
        $email = $complain->email;

        Mail::send(['html' => 'mail.done'], [
            'complain_code' => $complain->complain_code,
            'user' => $complain->name,
        ], function ($message) use ($email) {
            $message->subject('Keluhan telah selesai!');
            $message->from('unmulcomplaint@gmail.com', 'Biro Akademik Universitas Mulawarman');
            $message->to($email);
        });

        return response([
            'result' => 'Ok',
        ]);
    }

    public function redirect()
    {
        return redirect('/antrian-keluhan');
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string',
            'unit' => 'required|string',
            'id' => 'required|string',
            'email' => 'required|email',
            'complain' => 'required',
            'complain_type' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response([
                'errors' => true,
                'messages' => 'Periksa kembali input anda!',
            ]);
        }
        $complain_code = strtoupper(str_random(6));
        $code_status = false;
        while ($code_status == false) {
            $code_check = Complain::where('complain_code', '=', $complain_code)->get()->count();
            if ($code_check == 0) {
                $code_status = true;
            } else {
                $complain_code = strtoupper(str_random(6));
            }
        }
        if (Auth::user()->level_user == 2) {
            $unit = Unit::where('name', '=', request()->unit)->first();
            $unit_id = $unit->id;
            $user_id = null;
            $status = 0;
        } else {
            $unit_id = request()->unit;
            $user_id = Auth::user()->id;
            $status = 1;
        }
        $complain = new Complain([
            'complain_code' => $complain_code,
            'name' => request()->name,
            'id_number' => request()->id,
            'email' => request()->email,
            'description' => request()->complain,
            'complain_type_id' => request()->complain_type,
            'unit_id' => $unit_id,
            'user_id' => $user_id,
            'status' => $status,
        ]);

        if (request()->attachmentsname != '') {
            $validator = Validator::make(request()->all(), [
                'files.*' => 'required|file|mimes:jpeg,jpg,doc,docx,pdf,png',
            ], [
                'files.*.mimes' => 'Ekstensi yang diperbolehkan hanya jpeg, jpg, png, doc, docx, pdf',
            ]);

            if ($validator->fails()) {
                return response([
                    'errors' => true,
                    'messages' => $validator->messages(),
                ]);
            }
            $data = request()->all();
            $attachmentsName = $data['attachmentsname'];
            $files = $data['files'];
            $complain->save();
            foreach (request()->file('files') as $file => $input) {
                $fileName = sha1($files[$file]->getClientOriginalName().time()).'.'.$files[$file]->getClientOriginalExtension();
                $files[$file]->storeAs('public/user-file/', $fileName);
                $attachment = new Attachment([
                    'title' => $attachmentsName[$file],
                    'name' => $fileName,
                    'complain_id' => $complain->id,
                ]);
                $attachment->save();
            }
        } else {
            $complain->save();
        }

        $email = $complain->email;

        Mail::send(['html' => 'mail.complain-queue'], [
            'complain_code' => $complain->complain_code,
            'user' => $complain->name,
        ], function ($message) use ($email) {
            $message->subject('Keluhan masuk antrian!');
            $message->from('unmulcomplaint@gmail.com', 'Biro Akademik Universitas Mulawarman');
            $message->to($email);
        });

        return response([
            'errors' => false,
            'messages' => 'Berhasil menambahkan keluhan!',
        ]);
    }

    public function destroy()
    {
        $attachments = Attachment::where('complain_id', '=', request()->id)->get();

        foreach ($attachments as $attachment) {
            if (Storage::exists('public/user-file/'.$attachment->name)) {
                Storage::delete('public/user-file/'.$attachment->name);
            }
            $attach = Attachment::find($attachment->id)->delete();
        }

        $complain = Complain::find(request()->id)->delete();

        return response([
            'error' => false,
            'messages' => ' ok',
        ]);
    }

    public function getComplain()
    {
        $complain = Complain::with('complain_type', 'user', 'unit', 'attachments')->find(request()->id);
        $units = Unit::all();
        $complain_types = ComplainType::all();

        return response([
            'result' => $complain,
            'units' => $units,
            'complain_types' => $complain_types,
        ]);
    }

    public function updateComplain()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string',
            'unit' => 'required|string',
            'id' => 'required|string',
            'email' => 'required|email',
            'complain' => 'required',
            'complain_type' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response([
                'errors' => true,
                'messages' => 'Periksa kembali input anda!',
            ]);
        }
        if (Auth::user()->level_user == 2) {
            $unit = Unit::where('name', '=', request()->unit)->first();
            $unit_id = $unit->id;
        } else {
            $unit_id = request()->unit;
        }
        $complain = Complain::find(request()->id);
        $complain->name = request()->name;
        $complain->id_number = request()->id_num;
        $complain->email = request()->email;
        $complain->description = request()->complain;
        $complain->complain_type_id = request()->complain_type;
        $complain->unit_id = $unit_id;
        $complain->status = request()->status;
        $complain->save();

        if (request()->attachmentsname != '') {
            $validator = Validator::make(request()->all(), [
                'files.*' => 'required|file|mimes:jpeg,jpg,doc,docx,pdf,png',
            ], [
                'files.*.mimes' => 'Ekstensi yang diperbolehkan hanya jpeg, jpg, png, doc, docx, pdf',
            ]);

            if ($validator->fails()) {
                return response([
                    'errors' => true,
                    'messages' => $validator->messages(),
                ]);
            }
            $data = request()->all();
            $attachmentsName = $data['attachmentsname'];
            $files = $data['files'];
            $complain->save();
            foreach (request()->file('files') as $file => $input) {
                $fileName = sha1($files[$file]->getClientOriginalName().time()).'.'.$files[$file]->getClientOriginalExtension();
                $files[$file]->storeAs('public/user-file/', $fileName);
                $attachment = new Attachment([
                    'title' => $attachmentsName[$file],
                    'name' => $fileName,
                    'complain_id' => $complain->id,
                ]);
                $attachment->save();
            }
        } else {
            $complain->save();
        }

        return response([
            'errors' => false,
            'result' => 'Ok',
        ]);
    }

    public function takeComplain()
    {
        $complain = Complain::find(request()->id);
        $complain->user_id = Auth::user()->id;
        $complain->status = 1;
        $complain->save();

        return response([
            'result' => 'ok',
        ]);
    }

    public function download($id)
    {
        File::cleanDirectory('zip');
        $attachments = Attachment::where('complain_id', '=', $id)->get();
        $complain = Complain::find($id);
        $zipper = new Zipper();
        $zipper->make('zip/'.$complain->complain_code.'.zip');

        foreach ($attachments as $attachment) {
            if (Storage::exists('public/user-file/'.$attachment->name)) {
                $zipper->folder($attachment->title)->add('storage/user-file/'.$attachment->name);
            }
        }

        $zipper->close();

        return Response::download('zip/'.$complain->complain_code.'.zip');
    }

    public function report($y)
    {
        $year = $y;
        $months = Complain::where('updated_at', 'LIKE', '%'.$year.'%')
        ->where('status', '=', 2)->get()->groupBy(function ($d) {
            return Carbon::parse($d->updated_at)->format('m');
        });

        // $complains = Complain::with('unit')
        // ->orderBy('unit_id', 'asc')
        // ->where('updated_at', 'LIKE', '%'.$year.'%')
        // ->where('status', '=', 2)->get()
        // ->groupBy('unit.id')->map(function ($d) {
        //     return $d->count();
        // });

        $complainsDone = Complain::with('unit')
            ->where('updated_at', 'LIKE', '%'.$year.'%')
            ->where('status', '=', 2)->get()
            ->groupBy('unit.id');

        if ($y != date('Y')) {
            $complainsQueue = Complain::with('unit')
            ->where('updated_at', 'LIKE', '%'.$year.'%')
            ->where('status', '=', 0)->get()
            ->groupBy('unit.id');

            $complainsInProgress = Complain::with('unit')
            ->where('updated_at', 'LIKE', '%'.$year.'%')
            ->where('status', '=', 1)->get()
            ->groupBy('unit.id');
        } else {
            $complainsQueue = Complain::with('unit')
            ->where('status', '=', 0)->get()
            ->groupBy('unit.id');

            $complainsInProgress = Complain::with('unit')
            ->where('status', '=', 1)->get()
            ->groupBy('unit.id');
        }

        $units = Unit::all();

        $years = Complain::orderBy('updated_at', 'asc')->get();

        return view('complain-report.index', compact('months', 'complainsDone', 'units', 'year', 'years', 'complainsQueue', 'complainsInProgress'));
    }
}

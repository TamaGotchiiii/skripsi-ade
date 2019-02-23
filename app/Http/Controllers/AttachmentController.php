<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attachment;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function destroy()
    {
        $attachment = Attachment::find(request()->id);
        if (Storage::exists('public/user-file/'.$attachment->name)) {
            Storage::delete('public/user-file/'.$attachment->name);
        }

        $attachment->delete();

        return response([
            'errors' => false,
            'result' => 'ok',
        ]);
    }
}

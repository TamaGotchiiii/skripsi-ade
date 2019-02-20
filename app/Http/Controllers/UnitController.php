<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    /**
     * this function is trigger if the unit is added via add user form
     * this function is for check if the unit already added or not
     * using the count function
     * if unitCount = 0 then add new unit
     * if unitCount = 1 then ignore.
     */
    public function userStore()
    {
        $validator = Validator::make(request()->all(), [
            'newFakultas' => 'required',
        ]);
        if ($validator->fails()) {
            return response([
                'result' => 'error',
            ]);
        }
        $unitCount = Unit::where('name', '=', request()->newFakultas)
            ->get()->count();

        if ($unitCount == 0) {
            $unit = new Unit([
                'name' => request()->newFakultas,
            ]);
            $unit->save();
        }

        return response([
            'result' => 'Berhasil menambahkan data unit!',
        ]);
    }
}

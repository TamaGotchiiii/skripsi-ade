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

    public function unitList()
    {
        $units = Unit::with('complains')
        ->orderBy('name', 'asc')->get();

        return view('unit-list.index', compact('units'));
    }

    public function checkUnit()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:units',
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

    public function addUnit()
    {
        $unit = new Unit([
            'name' => request()->name,
        ]);

        $unit->save();

        return response([
            'result' => 'Ok',
        ]);
    }

    public function getUnit()
    {
        $unit = Unit::find(request()->id);

        return response([
            'result' => $unit,
        ]);
    }

    public function deleteUnit()
    {
        $unit = Unit::find(request()->id);
        $unit->delete();

        return response([
            'result' => 'Ok',
        ]);
    }

    public function checkEditUnit()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:units,name,'.request()->id.',id',
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

    public function updateUnit()
    {
        $unit = Unit::find(request()->id);
        $unit->name = request()->name;
        $unit->save();

        return response([
            'result' => 'Ok',
        ]);
    }
}

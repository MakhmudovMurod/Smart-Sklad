<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalUnit;
use Illuminate\Support\Facades\DB;
use Gate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GlobalUnitsController extends Controller
{
    public function create()
    {
        abort_if(Gate::denies('unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = GlobalUnit::all();

        return view('admin.global_units.create', compact('units'));
    }


    public function store(Request $request)
    {
        if($request->unit_name == null || $request->unit_ext == null)
        {
            return back();
        }
        else
        {
            $unit = new GlobalUnit();

            $unit->unit_name = $request->unit_name;
            $unit->unit_extension = $request->unit_ext;
            $unit->save();

            return back();
        }

    }

    public function destroy($id)
    {
        abort_if(Gate::denies('unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit = GlobalUnit::findOrFail($id);

        $unit->delete();

        return back();
    }
}

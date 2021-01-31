<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Models\Outcome;
use Symfony\Component\HttpFoundation\Response;


class OutcomesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('outcome_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outcomes = Outcome::all();

        return view('admin.outcomes.index', compact('outcomes'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('outcome_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outcome = Outcome::findOrFail($id);

        $outcome->delete();

        return back();
    }

    public function filter(Request $request)
    {
        $from = $request->from_date;
        $to = $request->to_date;

        $outcomes = Outcome::whereBetween('created_at', [$from, $to])->get();

        return view('admin.outcomes.index',compact('outcomes'));

    }
}

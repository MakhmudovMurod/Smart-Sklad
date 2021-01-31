<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Models\Income;
use Symfony\Component\HttpFoundation\Response;


class IncomesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('income_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incomes = Income::all();

        return view('admin.incomes.index',compact('incomes'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('income_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $income = Income::findOrFail($id);

        $income->delete();

        return back();
    }

    public function filter(Request $request)
    {
        $from = $request->from_date;
        $to = $request->to_date;

        $incomes = Income::whereBetween('created_at', [$from, $to])->get();

        return view('admin.incomes.index',compact('incomes'));

    }
}

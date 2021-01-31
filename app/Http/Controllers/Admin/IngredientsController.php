<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Ingredient;
use App\Models\GlobalUnit;
use App\Models\Income;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IngredientsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ingredient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ingredients = Ingredient::all();

        return view('admin.ingredients.index', compact('ingredients'));
    }

    public function replenishReserve(Request $request,$id)
    {
        if($request->increment_amount == null)
        {
            return redirect()->back();
        }
        else{

            $replenish_amount = $request->increment_amount;

            $ingredient = Ingredient::findOrFail($id);

            $ingredient->increment('available_amount',$replenish_amount);

            //Creating Supplement Story for Income
            $income = new Income();

            $income->ingredient_id = $id;

            $income->added_amount = $request->increment_amount;

            $income->added_price = $ingredient->price_per_unit * $request->increment_amount;

            $income->added_by = Auth::user()->id;

            $income->save();

            return redirect()->route('admin.ingredients.index');
        }

    }

    public function create()
    {
        abort_if(Gate::denies('ingredient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = GlobalUnit::all();

        return view('admin.ingredients.create', compact('units'));
    }


    public function store(Request $request)
    {
        $ingredient = new Ingredient;

        $ingredient->name = $request->name;
        $ingredient->price_per_unit = $request->price;
        $ingredient->unit = $request->unit;
        $ingredient->save();

        return redirect()->route('admin.ingredients.index');
    }

    public function edit($id)
    {
        abort_if(Gate::denies('ingredient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ingred = Ingredient::findOrFail($id);

        $units = GlobalUnit::all();

        return view('admin.ingredients.edit', compact('ingred','units'));
    }

    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);

        $ingredient->name = $request->name;
        $ingredient->price_per_unit = $request->price;
        $ingredient->unit = $request->unit;
        $ingredient->save();

        return redirect()->route('admin.ingredients.index');

    }

    public function show($id)
    {
        abort_if(Gate::denies('ingredient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ingredient = Ingredient::findOrFail($id);

        return view('admin.ingredients.show', compact('ingredient'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('ingredient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ingredient = Ingredient::findOrFail($id);

        $ingredient->delete();

        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formula;
use App\Models\Ingredient;
use App\Models\GlobalUnit;
use Illuminate\Support\Facades\DB;
use Gate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormulasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('formula_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formulas = Formula::all()->unique('created_at');

        return view('admin.formulas.index', compact('formulas'));
    }

    public function create()
    {
        abort_if(Gate::denies('formula_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = GlobalUnit::all();

        $ingred = Ingredient::all();

        return view('admin.formulas.create', compact('units','ingred'));
    }

    public function store(Request $request)
    {


        $counter = (count($request->all()) - 4) / 2;

        for($i=1; $i<=$counter; $i++)
        {
            $ingredient = Ingredient::findOrFail($request->input('ingredient_id_'.$i));

            $ingredient_price = $ingredient->price_per_unit * $request->input('ingredient_amount_'.$i);

            $data[] = array(
                'standard_amount' => $request->input('standard_amount'),
                'product_unit' => $request->input('product_unit'),
                'product_name' => $request->input('product_name'),
                'ingredient_id' => $request->input('ingredient_id_'.$i),
                'ingredient_amount' => $request->input('ingredient_amount_'.$i),
                'created_at' => Carbon::now(),
                'price_for_formula' => $ingredient_price,
            );
        }

        DB::table('formulas')->insert($data);

        return redirect()->route('admin.formulas.index');

    }



    public function show($id)
    {
        abort_if(Gate::denies('formula_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formula = Formula::findOrFail($id);

        $ingred = Formula::all()->where('created_at',$formula->created_at);

        $overall_price = $ingred->sum('price_for_formula');

        return view('admin.formulas.show', compact('formula','ingred','overall_price'));
    }


    public function destroy($id)
    {
        abort_if(Gate::denies('formula_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formula = Formula::findOrFail($id);

        $ingredients = Formula::all()->where('created_at', $formula->created_at);

        foreach($ingredients as $item)
        {
            $item->delete();
        }

        return back();
    }
}

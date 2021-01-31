<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\GlobalUnit;
use App\Models\Formula;
use App\Models\Outcome;
use Illuminate\Support\Facades\DB;
use Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = Product::all();

        return view('admin.products.index', compact('product'));
    }


    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = GlobalUnit::all();

        $formula = Formula::all()->unique('created_at');

        return view('admin.products.create', compact('formula','units'));
    }


    public function store(Request $request)
    {
        //Selected formula's id
        $formula_id = $request->product_id;

        $formula = Formula::findOrFail($formula_id);

        // All used ingredients for selected formula
        $ingred = Formula::all()->where('created_at',$formula->created_at);

        // Ovearll price of formula
        $overall_price = $ingred->sum('price_for_formula');

        //Crteating new Product
        $product = new Product();
        $product->formula_id = $request->product_id;
        $product->product_amount = $request->product_amount;

        //Calculating overall price of product with formula
        $times = $request->product_amount / $formula->standard_amount;
        $price = $times * $overall_price;

        //Overall price of product
        $product->price_per_unit = $price;

        $product->save();

        foreach($ingred as $i)
        {
            $outcome = new Outcome;

            $outcome->formula_id = $formula_id;
            $outcome->ingredient_id = $i->ingredient_id;
            $outcome->removed_amount = $i->ingredient_amount * $times;
            $outcome->removed_by = Auth::user()->id;
            $outcome->created_at = Carbon::now();
            $outcome->save();
        }

        foreach($ingred as $i)
        {
            $i->ingredient->decrement('available_amount', $i->ingredient_amount * $times );
        }

        return redirect()->route('admin.products.index');
    }


    public function show($id)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = Product::findOrFail($id);

        $f_id = $product->formula_id;

        $formula = Formula::findOrFail($f_id);

        $ingred = Formula::all()->where('created_at',$formula->created_at);

        $formula_price = $ingred->sum('price_for_formula');

        //How Much ingredients used
        $times = $product->product_amount / $formula->standard_amount;

        $product_price = $formula_price * $times;

        return view('admin.products.show', compact('product','ingred','formula','times','product_price'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return back();
    }
}

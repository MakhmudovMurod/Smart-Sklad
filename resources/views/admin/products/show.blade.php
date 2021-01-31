@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Product
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    Обратно к списку
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Количество продукта
                        </th>
                        <td>
                            {{ number_format($product->product_amount) ?? '' }}
                            <span class="font-weight-bold text-success">{{$product->formula->product_unit}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Название продукта
                        </th>
                        <td>
                            {{ $product->formula->product_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Используемые ингредиенты
                        </th>
                        <td>
                            <ul class="list-group">
                                @foreach ($ingred as $item)
                                    <li class="list-group-item">{{$item->ingredient->name}} - {{$item->ingredient_amount * $times}}
                                        <span class="font-weight-bold text-success">{{$item->ingredient->unit}}</span> -
                                        {{number_format($item->price_for_formula * $times)}} <span class="font-weight-bold">(UZS)</span></li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Цена продукта
                        </th>
                        <td>
                            {{number_format($product_price)}} <span class="font-weight-bold">(UZS)</span>
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    Обратно к списку
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

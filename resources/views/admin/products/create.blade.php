@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Создать продукт
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data">
            @csrf

            <label for="">Выберите формулу продукта</label>
            <div class="form-group">
                <select name="product_id" id="" class="form-control">
                    @foreach ($formula as $item)
                        <option value="{{$item->id}}">{{$item->product_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Количество

                </label>
                <input type="number" step="any" class="form-control" name="product_amount">
                <span class="text-danger">Продукт должен быть измерен в соответствии со стандартными измерениями.(@foreach($units as $u)
                    {{$u->unit_extension}}/
                   @endforeach)</span>
            </div>


            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

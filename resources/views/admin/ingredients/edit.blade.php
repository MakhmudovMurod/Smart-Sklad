@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Изменить ингредиент
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ingredients.update", [$ingred->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label class="required" for="name">Hазвания</label>
                <input class="form-control" type="text" name="name"  value="{{ old('name', $ingred->name) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Цена за единицу <span class="text-success">( X за один Kилограмм/Литр/Штук )</span></label>
                <input class="form-control" type="number" step="any" name="price"  value="{{ old('price', $ingred->price_per_unit) }}" required>            </div>
            <div class="form-group">
                <label class="required" for="name">Единица измерения</label>
                <select class="form-control" name="unit">
                    @foreach ($units as $unit)
                    <option value="{{$unit->unit_extension}}">{{$unit->unit_name}}</option>
                    @endforeach
                </select>
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

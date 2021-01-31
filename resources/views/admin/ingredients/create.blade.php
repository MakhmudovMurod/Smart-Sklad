@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Создать ингредиент
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ingredients.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">Hазвания</label>
                <input class="form-control" type="text" name="name"  value="{{ old('name', '') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Цена за единицу <span class="text-success">( X за один Kилограмм/Литр/Штук )</span></label>
                <input class="form-control" type="number" name="price" step="any"  value="{{ old('price', '') }}" required>            </div>
            <div class="form-group">
                <label class="required" for="name">Единица измерения</label>
                <select class="form-control" name="unit">
                    @foreach($units as $key=>$unit)
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

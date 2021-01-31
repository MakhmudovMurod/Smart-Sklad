@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Создать формулу
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.formulas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label class="required" for="">Стандартное количество</label>
                        <input class="form-control" type="number" step="any" name="standard_amount" required>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-group">

                        <div class="form-group">
                            <label class="required" for="">Hазвание продукта</label>
                            <input class="form-control" type="text" name="product_name" required>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <label class="required" for="">Единица измерения</label>
                        <select name="product_unit" id="" class="form-control">
                            @foreach($units as $key=>$unit)
                            <option value="{{$unit->unit_extension}}">{{$unit->unit_name}}</option>
                            @endforeach
                        </select>
                </div>
            </div>

            <div class="row">
                <div class="col-4 mt-5">
                    <button type="button" class="btn btn-success btn-block" id="addButton"><i class="fa fa-plus"></i> Добавить ингредиент</button>
                </div>
                <div class="col-4 mt-5">
                    <button  type="button" class="btn btn-danger btn-block" id="removeButton"><i class="fa fa-minus"></i> Удалить ингредиент</button>
                </div>
            </div>

            <div class="form-group" id="inputGroup">
                <div id="inputFields">

                </div>
            </div>


            <div class="form-group">
                <button class="btn btn-info" type="submit">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
@parent
<script type="text/javascript">

    $(document).ready(function()
    {
        var counter = 1;

        // Adding New Input Fields
        $("#addButton").click(function ()
        {

            var newTextBoxDiv = $(document.createElement('div'))
                .attr("id", 'inputFields');

            newTextBoxDiv.after().html(`
            <div class="row mt-3">
                <div class="col-6">
                    <label class="required" for="">Выберите ингредиенты</label>
                    <select name="ingredient_id_${counter}" id="" class="form-control">
                        @foreach($ingred as $i)
                        <option value="{{$i->id}}">{{$i->name}} ({{$i->unit}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label class="required" for="">Количество ингредиента</label>
                    <input type="number" step="any" class="form-control" name="ingredient_amount_${counter}">
                </div>

            </div>

            `);

            newTextBoxDiv.appendTo("#inputGroup");


            counter++;
        });

        //Removing Input Fields
        $("#removeButton").click(function ()
        {
            $("#inputFields").remove();

        });


    });

</script>
@endsection

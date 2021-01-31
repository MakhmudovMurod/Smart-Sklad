@extends('layouts.admin')
@section('content')

<div class="row">
    @can('ingredient_create')
    <div style="margin-bottom: 10px;">
        <div class="col-lg-6">
            <a class="btn btn-success" href="{{ route('admin.ingredients.create') }}">
                Добавить новый ингредиент
            </a>
        </div>
    </div>
@endcan






<div class="card">
    <div class="card-header">
        Список ингредиентов
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Project">
                <thead>
                    <tr>


                        <th>
                            ID
                        </th>
                        <th>
                            Название
                        </th>
                        <th>
                            Цена <span class="font-weight-bold">(UZS)</span>
                        </th>
                        <th>
                            Доступное количество
                        </th>
                        @can('ingredient_replenish')
                        <th>
                            Добавить ингредиент
                        </th>
                        @endcan

                        <th>
                            Создано
                        </th>
                        <th>
                            Обновлено
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingredients as $key => $i)
                        <tr>

                            <td>
                                {{$i->id}}
                            </td>
                            <td>
                                {{ $i->name ?? '' }}
                            </td>
                            <td>
                                {{ number_format($i->price_per_unit) ?? '' }}

                            </td>
                            <td>
                                {{ $i->available_amount ?? '' }} <span class="font-weight-bold ">{{$i->unit}}</span>
                            </td>
                            @can('ingredient_replenish')
                            <td>
                                <form action="{{ route('admin.ingredients.replenish.reserve', $i->id) }}" method="POST" style="display: inline-block;" class="form-inline">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="action" value="add">
                                    <input type="number" step="any" name="increment_amount" class="form-control form-control-sm col-8" min="1">
                                    <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></button>
                                </form>
                            </td>
                            @endcan

                            <td>
                                {{ $i->created_at ?? '' }}
                            </td>
                            <td>
                                {{ $i->updated_at ?? '' }}
                            </td>
                            <td>
                                @can('ingredient_edit')
                                    <a class="btn btn-xs btn-info mb-2" href="{{ route('admin.ingredients.edit', $i->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                @endcan

                                @can('ingredient_delete')
                                    <form action="{{ route('admin.ingredients.destroy', $i->id) }}" method="POST" onsubmit="return confirm('Вы уверены?');" >
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
$(function ()
    {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        $.extend(true, $.fn.dataTable.defaults,{
        orderCellsTop: true,
        order: [[ 1, 'desc' ]],
        pageLength: 100,});

        let table = $('.datatable-Project:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();});
    })

</script>
@endsection

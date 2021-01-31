@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Дополнение история
        <form action="{{route('admin.income.filter')}}" method="POST" class="float-right" enctype="multipart/form-data">
            @csrf
            <label for="">Из : </label>
            <input class="date" type="text" name="from_date">
            <label for="" class="ml-2">До : </label>
            <input class="date" type="text" name="to_date">
            <button type="submit" class="btn btn-xs btn-info" style="margin-bottom: 5px;"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-hover datatable datatable-Project">
                <thead>
                    <tr>

                        <th>
                            ID ингредиента
                        </th>
                        <th>
                            Название ингредиента
                        </th>

                        <th>
                            Добавленное количество
                        </th>

                        <th>
                            Цена (UZS)
                        </th>

                        <th>
                            Добавил
                        </th>

                        <th>
                            Добавлено в
                        </th>

                        @can('income_delete')
                            <th>
                                &nbsp;
                            </th>
                        @endcan

                    </tr>
                </thead>
                <tbody>
                    @foreach($incomes as $key => $income)

                        <tr>

                            <td>
                                {{$income->ingredient->id}}
                            </td>

                            <td>
                                {{$income->ingredient->name}}
                            </td>

                            <td>
                                <span class="font-weight-bold text-success"> + </span> {{number_format($income->added_amount)}}<span class="font-weight-bold text-success"> {{$income->ingredient->unit}}</span>
                            </td>

                            <td>
                                <span class="font-weight-bold text-danger"> - </span> {{number_format($income->added_price)}}
                            </td>

                            <td>
                                {{$income->user->name}}
                            </td>

                            <td>
                                {{$income->created_at}}
                            </td>


                                @can('income_delete')
                                <td>
                                    <form action="{{ route('admin.income.delete', $income->id) }}" method="POST" onsubmit="return confirm('Вы уверены?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>

                                @endcan



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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('project_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.projects.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Project:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>

<script type="text/javascript">
    $('.date').datepicker({
       format: 'mm-dd-yyyy'
     });
</script>
@endsection

@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Создать единица
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.unit") }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-6">
                    <label for="" class="require">Название единица</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="unit_name">
                    </div>
                </div>
                <div class="col-6">
                    <label for="" class="require">Расширение единица</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="unit_ext">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-info" type="submit">
                    Сохранить
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class=" table table-bordered table-hover datatable datatable-Project">
                <thead>
                    <tr>

                        <th>
                            Название единица
                        </th>
                        <th>
                            Расширение единица
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $key => $unit)


                            <tr>

                                <td>{{$unit->unit_name}}</td>
                                <td>
                                    {{ $unit->unit_extension ?? '' }}
                                </td>

                                <td>
                                    @can('unit_delete')
                                        <form action="{{ route('admin.unit.delete', $unit->id) }}" method="POST" onsubmit="return confirm('Вы уверены?');" style="display: inline-block;">
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



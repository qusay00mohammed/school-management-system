@extends('layouts.master')
@section('css')

@endsection

@section('title')
  {{ trans('trans_main.school grade') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
  <div class="row">
    <div class="col-sm-6">
      <h4 class="mb-0">{{ __('trans_main.school grade') }}</h4>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
        <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('trans_main.school grade') }}</li>
      </ol>
    </div>
  </div>
</div>
<!-- breadcrumb -->
@endsection





@section('content')
<!-- row -->
<div class="row">

  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @canany(['delete grade', 'add grade'])
            @can('add grade')
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('trans_grade.add grade') }}
                </button>
            @endcan
            @can('delete grade')
                <button type="button" class="button x-small" id="btn_delete_all">
                    {{ trans('trans_grade.delete all') }}
                </button>
            @endcan
            <br><br>
        @endcanany



        <form action="{{ route('filter_grade') }}" method="POST">
            {{ csrf_field() }}
            <select class="selectpicker" data-style="btn-info" name="stage_id" required onchange="this.form.submit()">
                <option value="" selected disabled>{{ trans('trans_grade.select value') }}</option>
                @foreach ($stage as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
            </select>
        </form>



        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr>
                <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                <th>#</th>
                <th>{{ trans('trans_grade.grade name') }}</th>
                <th>{{ trans('trans_grade.stage name') }}</th>
                @canany(['delete grade', 'edit grade'])
                <th>{{ trans('trans_grade.process') }}</th>
                @endcanany
              </tr>
            </thead>
            <tbody>

              @foreach ($grade as $key => $g)
                <tr>
                  <td><input type="checkbox" value="{{ $g->id }}" class="box1"></td>
                  <td>{{ ++$key }}</td>
                  <td>{{ $g->name }}</td>
                  <td>{{ $g->stage->name }}</td>


                  @canany(['delete grade', 'edit grade'])
                  <td>

                    @can('edit grade')
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#edit{{ $g->id }}" title="{{ trans('trans_grade.edit grade') }}"><i
                        class="fa fa-edit"></i></button>
                    @endcan

                    @can('delete grade')
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#delete{{ $g->id }}" title="{{ trans('trans_grade.delete grade') }}"><i
                        class="fa fa-trash"></i></button>
                    @endcan

                  </td>
                  @endcanany


                </tr>
                <!-- edit -->
                <div class="modal fade" id="edit{{ $g->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                          {{ trans('trans_grade.edit grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <form class="row mb-30" action="{{ route('grade.update', [$g->id]) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="card-body">
                            <div class="repeater">
                              <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                  <div class="row">

                                    <div class="col">
                                      <label for="name_ar" class="mr-sm-2">{{ trans('trans_grade.name ar') }}
                                        :</label>
                                      <input id="name_ar" class="form-control" type="text" name="name_ar" required
                                        value="{{ $g->getTranslation('name', 'ar') }}" />
                                    </div>

                                    <div class="col">
                                      <label for="name_en" class="mr-sm-2">{{ trans('trans_grade.name en') }}
                                        :</label>
                                      <input class="form-control" id="name_en" type="text" name="name_en" required
                                        value="{{ $g->getTranslation('name', 'en') }}" />
                                    </div>

                                    <div class="col">
                                      <label for="stage_name" class="mr-sm-2">{{ trans('trans_grade.stage name') }}
                                        :</label>
                                      <div class="box">
                                        <select id="stage_name" class="fancyselect" name="stage_id" required>
                                          @foreach ($stage as $s)
                                            <option {{ $g->stage_id == $s->id ? 'selected' : '' }}
                                              value="{{ $s->id }}">{{ $s->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <br />
                              <br />
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                  data-dismiss="modal">{{ trans('trans_grade.close') }}</button>
                                <button type="submit" class="btn btn-success">{{ trans('trans_grade.edit') }}</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end edit --}}

                <!-- delete -->
                <div class="modal fade" id="delete{{ $g->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                          {{ trans('trans_grade.delete grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <form class="row mb-30" action="{{ route('grade.destroy', [$g->id]) }}" method="POST">
                          @csrf
                          @method('delete')
                          <div class="card-body">
                            <div class="repeater">
                              <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                  <div class="row">

                                    <div class="col">
                                      <label for="name_ar" class="mr-sm-2">{{ trans('trans_grade.name ar') }}
                                        :</label>
                                      <input id="name_ar" class="form-control" type="text" disabled name="name_ar"
                                        required value="{{ $g->getTranslation('name', 'ar') }}" />
                                    </div>

                                    <div class="col">
                                      <label for="name_en" class="mr-sm-2">{{ trans('trans_grade.name en') }}
                                        :</label>
                                      <input class="form-control" id="name_en" type="text" disabled name="name_en"
                                        required value="{{ $g->getTranslation('name', 'en') }}" />
                                    </div>

                                    <div class="col">
                                      <label for="stage_name" class="mr-sm-2">{{ trans('trans_grade.stage name') }}
                                        :</label>
                                      <div class="box">
                                        <select id="stage_name" disabled class="fancyselect" name="stage_id" required>
                                          @foreach ($stage as $s)
                                            <option {{ $g->stage_id == $s->id ? 'selected' : '' }}
                                              value="{{ $s->id }}">{{ $s->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <br />
                              <br />
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                  data-dismiss="modal">{{ trans('trans_grade.close') }}</button>
                                <button type="submit"
                                  class="btn btn-success">{{ trans('trans_grade.delete') }}</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end delete --}}
              @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- add -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
            {{ trans('trans_grade.add grade') }}
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form class="row mb-30" action="{{ route('grade.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="repeater">
                <div data-repeater-list="List_Classes">
                  <div data-repeater-item>
                    <div class="row">

                      <div class="col">
                        <label for="name_ar" class="mr-sm-2">{{ trans('trans_grade.name ar') }} :</label>
                        <input id="name_ar" class="form-control" type="text" name="name_ar" required />
                      </div>

                      <div class="col">
                        <label for="name_en" class="mr-sm-2">{{ trans('trans_grade.name en') }} :</label>
                        <input class="form-control" id="name_en" type="text" name="name_en" required />
                      </div>

                      <div class="col">
                        <label for="stage_name" class="mr-sm-2">{{ trans('trans_grade.stage name') }} :</label>
                        <div class="box">
                          <select id="stage_name" class="fancyselect" name="stage_id" required>
                            <option value="" disabled selected>{{ __('trans_grade.select value') }}</option>
                            @foreach ($stage as $s)
                              <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col">
                        <label for="delete_row" class="mr-sm-2">{{ trans('trans_grade.process') }} :</label>
                        <input id="delete_row" class="btn btn-danger btn-block" data-repeater-delete type="button"
                          value="{{ trans('trans_grade.delete row') }}" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mt-20">
                  <div class="col-12">
                    <input class="button" data-repeater-create type="button"
                      value="{{ trans('trans_grade.add row') }}" />
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('trans_grade.close') }}</button>
                  <button type="submit" class="btn btn-success">{{ trans('trans_grade.save') }}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- end add --}}

</div>

<!-- Delete selected items -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
            {{ trans('trans_grade.delete all') }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('delete_all_item') }}" method="POST">
        {{ csrf_field() }}

        <div class="modal-body">
            {{ trans('trans_grade.delete sure') }}
          <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
            data-dismiss="modal">{{ trans('trans_grade.close') }}</button>
          <button type="submit" class="btn btn-danger">{{ trans('trans_grade.delete') }}</button>
        </div>
      </form>
    </div>
  </div>
</div>



</div>

</div>

<!-- row closed -->
@endsection
@section('js')

<script type="text/javascript">
  $(function() {
    $("#btn_delete_all").click(function() {
      var selected = new Array();
      $("#datatable input[type=checkbox]:checked").each(function() {
        selected.push(this.value);
      });

      if (selected.length > 0) {
        $('#delete_all').modal('show')
        $('input[id="delete_all_id"]').val(selected);
      }
    });
  });
</script>
<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;
        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>




@endsection

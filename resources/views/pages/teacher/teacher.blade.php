@extends('layouts.master')
@section('css')

@endsection
@section('title')
  {{ trans('trans_main.school teachers') }}
@stop

@section('page-header')
  <!-- breadcrumb -->
{{-- @section('PageTitle')
  {{ trans('trans_main.school teachers') }}
@stop --}}
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        @can('add teacher')
        <a href="{{ route('teachers.create') }}" class="btn btn-success btn-sm" role="button" aria-pressed="true">{{ trans('trans_teacher.add teacher') }}</a>
        <br><br>
        @endcan
        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('trans_teacher.teacher name') }}</th>
                <th>{{ trans('trans_teacher.gender') }}</th>
                <th>{{ trans('trans_teacher.joining date') }}</th>
                <th>{{ trans('trans_teacher.specialization') }}</th>
                <th>{{ trans('trans_teacher.processes') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($teacher as $key => $t)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $t->name }}</td>
                  <td>{{ $t->gender->name }}</td>
                  <td>{{ $t->joining_date }}</td>
                  <td>{{ $t->specialization->name }}</td>
                  <td>
                    @can('edit teacher')
                    <a href="{{ route('teachers.edit', [$t->id]) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                        <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('delete teacher')
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_teahcer{{ $t->id }}" title="">
                        <i class="fa fa-trash"></i>
                    </button>
                    @endcan
                  </td>
                </tr>

                {{-- Model Delete Teacher --}}
                <div class="modal fade" id="delete_teahcer{{ $t->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form action="{{ route('teachers.destroy', [$t->id]) }}" method="post">
                      {{ method_field('delete') }}
                      {{ csrf_field() }}
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('trans_teacher.delete teacher') }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p> {{ trans('trans_teacher.delete sure') }}</p>
                        </div>
                        <div class="modal-footer">
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                              data-dismiss="modal">{{ trans('trans_teacher.close') }}</button>
                            <button type="submit"
                              class="btn btn-danger">{{ trans('trans_teacher.save') }}</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection

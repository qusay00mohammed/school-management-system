@extends('layouts.master')
@section('css')
@section('title')
  {{ __('trans_main.subject') }}
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
  <div class="row">
    <div class="col-sm-6">
      <h4 class="mb-0">{{ __('trans_main.subject') }}</h4>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
        <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('trans_main.subject') }}</li>
      </ol>
    </div>
  </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        @can('add subject')
        <a href="{{ route('subject.create') }}" class="btn btn-success btn-sm" role="button" aria-pressed="true">
            {{ __('trans_student.add subject') }}
        </a><br><br>
        @endcan
        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('trans_student.subject name') }}</th>
                <th>{{ __('trans_student.stage') }}</th>
                <th>{{ __('trans_student.grade') }}</th>
                <th>{{ __('trans_student.teacher name') }}</th>
                <th>{{ __('trans_student.processes') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($subjects as $subject)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $subject->name }}</td>
                  <td>{{ $subject->grade->stage->name }}</td>
                  <td>{{ $subject->grade->name }}</td>
                  <td>{{ $subject->teacher->name }}</td>
                  <td>
                    @can('edit subject')
                    <a href="{{ route('subject.edit', $subject->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true">
                        <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('delete subject')
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_subject{{ $subject->id }}" title="حذف">
                    <i class="fa fa-trash"></i>
                    </button>
                    @endcan
                  </td>
                </tr>

                <div class="modal fade" id="delete_subject{{ $subject->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form action="{{ route('subject.destroy', $subject->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('trans_student.delete') }} {{ $subject->name }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>{{ trans('trans_student.delete sure') }}</p>
                        </div>
                        <div class="modal-footer">
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('trans_student.close') }}</button>
                            <button type="submit" class="btn btn-danger">{{ trans('trans_student.delete') }}</button>
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

@extends('layouts.master')
@section('css')

@section('title')
  {{ __('trans_main.list online classes') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
  {{ __('trans_main.list online classes') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <a href="{{ route('teacher.online_classes.direct') }}" class="btn btn-success" role="button" aria-pressed="true">{{ __('trans_student.create meeting from school account') }}</a>
        <a class="btn btn-warning" href="{{ route('teacher.online_classes.indirect') }}">{{ __('trans_student.create meeting from teacher account') }}</a>
        <br><br>
        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr class="alert-success">
                <th>#</th>
                <th>{{ __('trans_student.stage') }}</th>
                <th>{{ __('trans_student.grade') }}</th>
                <th>{{ __('trans_student.section') }}</th>
                <th>{{ __('trans_student.owner of the meeting') }}</th>
                <th>{{ __('trans_student.class address') }}</th>
                <th>{{ __('trans_student.class date') }}</th>
                <th>{{ __('trans_student.class time') }}</th>
                <th>{{ __('trans_student.class link') }}</th>
                <th>{{ __('trans_student.processes') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($online_classes as $online_class)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $online_class->section->grade->stage->name }}</td>
                  <td>{{ $online_class->section->grade->name }}</td>
                  <td>{{ $online_class->section->name }}</td>
                  <td>{{ $online_class->created_by }}</td>
                  <td>{{ $online_class->topic }}</td>
                  <td>{{ $online_class->start_at }}</td>
                  <td>{{ $online_class->duration }}</td>
                  <td class="text-danger"><a href="{{ $online_class->join_url }}" target="_blank">{{ __('trans_student.join now') }}</a></td>
                  <td>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_meet{{ $online_class->meeting_id }}">
                        <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
                @include('pages.teacher.dashboard.online_classes.delete')
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

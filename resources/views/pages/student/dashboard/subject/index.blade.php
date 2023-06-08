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
        <div class="table-responsive">
          <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('trans_student.subject name') }}</th>
                <th>{{ __('trans_student.stage') }}</th>
                <th>{{ __('trans_student.grade') }}</th>
                <th>{{ __('trans_student.teacher name') }}</th>
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
                </tr>
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

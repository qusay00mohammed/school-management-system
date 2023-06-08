@extends('layouts.master')
@section('css')
@section('title')
{{__('trans_dashboard.list of test results')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('trans_dashboard.list of test results')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('trans_student.student name') }}</th>
                <th>{{ __('trans_student.quizz name') }}</th>
                <th>{{ __('trans_student.score') }}</th>
                <th>{{ __('trans_dashboard.the date of the test') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($degrees as $degree)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $degree->student->name }}</td>
                  <td>{{ $degree->quizze->name }}</td>
                  <td>{{ $degree->score }}</td>
                  <td>{{ $degree->date }}</td>
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

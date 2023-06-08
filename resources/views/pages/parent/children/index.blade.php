@extends('layouts.master')
@section('css')

@stop

@section('title')
  {{ trans('trans_dashboard.list sons') }}
@stop

@section('page-header')
  <!-- breadcrumb -->
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0">{{ __('trans_dashboard.list sons') }}</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('trans_dashboard.list sons') }}</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- breadcrumb -->
@stop

@section('PageTitle')
  {{ trans('trans_dashboard.list sons') }}
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <!-- row -->
  <div class="row">
    <div class="col-md-12 mb-30">
      <div class="card card-statistics h-100">
        <div class="card-body">
          <a href="{{ route('students.create') }}" class="btn btn-success btn-sm" role="button"
            aria-pressed="true">{{ trans('trans_student.add student') }}</a><br><br>
          <div class="table-responsive">
            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
              style="text-align: center">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{ trans('trans_student.name') }}</th>
                  <th>{{ trans('trans_student.email') }}</th>
                  <th>{{ trans('trans_student.gender') }}</th>
                  <th>{{ trans('trans_student.stage') }}</th>
                  <th>{{ trans('trans_student.grade') }}</th>
                  <th>{{ trans('trans_student.section') }}</th>
                  <th>{{ trans('trans_student.processes') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($students as $student)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender->name }}</td>
                    <td>{{ $student->section->grade->stage->name }}</td>
                    <td>{{ $student->section->grade->name }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>
                      <div class="dropdown show">
                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button"
                          id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{ trans('trans_student.processes') }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('sons.results', $student->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp; {{ __('trans_dashboard.view test results') }}</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @include('pages.student.delete')
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

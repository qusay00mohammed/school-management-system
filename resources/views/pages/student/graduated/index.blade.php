@extends('layouts.master')
@section('css')

@endsection

@section('PageTitle')
  {{ __('trans_main.list graduated') }}
@stop

@section('page-header')
  <!-- breadcrumb -->
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0">{{ __('trans_main.list graduated') }}</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('trans_main.list graduated') }}</li>
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
          @can('add graduated')
          <button type="button" class="btn btn-success">
            <a href=" {{ route('graduated.create') }}">{{ __('trans_student.add graduated') }}</a>
          </button>
          <br><br>
          @endcan
          <div class="table-responsive">
            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
              style="text-align: center">
              <thead>
                <tr class="alert-success">
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
                      @can('return graduated')
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#return_student{{ $student->id }}" title="{{ trans('trans_student.return student') }}">
                        {{ trans('trans_student.return student') }}
                      </button>
                      @endcan
                      @can('delete graduated')
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_student{{ $student->id }}" title="{{ trans('trans_student.delete student') }}">
                        {{ __('trans_student.delete student') }}
                      </button>
                      @endcan
                    </td>
                  </tr>
                    @include('pages.student.graduated.return')
                    @include('pages.student.graduated.delete')
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

@extends('layouts.master')
@section('css')

@endsection

@section('title')
  {{ __('trans_main.list online classes') }}
@stop


@section('PageTitle')
  {{ __('trans_main.list online classes') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('trans_main.list online classes') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('trans_main.online classes') }}</li>
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
          {{-- <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" --}}
          <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
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

@extends('layouts.master')
@section('css')

@endsection

@section('title')
  {{ __('trans_fee.study fees') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
  <div class="row">
    <div class="col-sm-6">
      <h4 class="mb-0"> {{ __('trans_fee.study fees') }}</h4>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
        <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('trans_fee.study fees') }}</li>
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
        <a href="{{ route('fees.create') }}" class="btn btn-success btn-sm" role="button"
          aria-pressed="true">{{ __('trans_fee.add study fees') }}</a><br><br>
        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr class="alert-success">
                <th>#</th>
                <th>{{ __('trans_fee.name') }}</th>
                <th>{{ __('trans_fee.amount') }}</th>
                <th>{{ __('trans_fee.stage') }}</th>
                <th>{{ __('trans_fee.grade') }}</th>
                <th>{{ __('trans_fee.academic year') }}</th>
                <th>{{ __('trans_fee.note') }}</th>
                <th>{{ __('trans_fee.processes') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($fees as $a)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $a->name }}</td>
                  <td>{{ number_format($a->amount, 2) }}</td>
                  <td>{{ $a->grade->stage->name }}</td>
                  <td>{{ $a->grade->name }}</td>
                  <td>{{ $a->academic_year }}</td>
                  <td>{{ $a->note ?? "No data" }}</td>
                  <td>
                    <a href="{{ route('fees.edit', $a->id) }}" class="btn btn-info btn-sm" role="button"
                      aria-pressed="true"><i class="fa fa-edit"></i></a>

                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                      data-target="#delete_account{{ $a->id }}"><i
                        class="fa fa-trash"></i></button>
                    <a href="#" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i
                        class="fa fa-eye"></i></a>
                  </td>
                </tr>
                @include('pages.fee.delete')
              @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- row closed -->
@endsection
@section('js')

@endsection

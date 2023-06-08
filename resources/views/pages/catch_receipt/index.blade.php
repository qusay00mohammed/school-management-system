@extends('layouts.master')
@section('css')

@section('title')
{{ __('trans_main.receivables') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
  <div class="row">
    <div class="col-sm-6">
      <h4 class="mb-0">{{ __('trans_main.receivables') }}</h4>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
        <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('trans_main.receivables') }}</li>
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
        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr class="alert-success">
                <th>#</th>
                <th>{{ __('trans_fee.name') }}</th>
                <th>{{ __('trans_fee.amount') }}</th>
                <th>{{ __('trans_fee.note') }}</th>
                <th>{{ __('trans_fee.processes') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($catch_receipt as $rs)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $rs->student->name }}</td>
                  <td>{{ number_format($rs->debit, 2) }}</td>
                  <td>{{ $rs->note }}</td>
                  <td>
                    <a href="{{ route('catchReceipts.edit', $rs->id) }}" class="btn btn-info btn-sm"
                      role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                      data-target="#delete_receipt{{ $rs->id }}"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                @include('pages.catch_receipt.delete')
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

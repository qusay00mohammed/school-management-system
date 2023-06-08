@extends('layouts.master')
@section('css')

@endsection
@section('title')
  {{ __('trans_fee.study bills') }}
@stop
@section('page-header')
  <!-- breadcrumb -->
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0"> {{ __('trans_fee.study bills') }}</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('trans_fee.study bills') }}</li>
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

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('fee_invoices.update', $fee_invoice->id) }}" method="post" autocomplete="off">
            @method('PUT')
            @csrf
            <div class="form-row">
              <div class="form-group col">
                <label for="inputEmail4">{{ __('trans_fee.name') }}</label>
                <input type="text" value="{{ $fee_invoice->student->name }}" readonly name="name" class="form-control">
              </div>


              <div class="form-group col">
                <label for="inputEmail4">{{ __('trans_fee.amount') }}</label>
                <input type="number" value="{{ $fee_invoice->amount }}" name="amount" class="form-control">
              </div>
            </div>


            <div class="form-row">

              <div class="form-group col">
                <label for="inputZip">{{ __('trans_fee.fees type') }}</label>
                <select class="custom-select mr-sm-2" name="fee_id">
                    @foreach ($fees as $fee)
                    <option value="{{ $fee->id }}" {{ $fee->id == $fee_invoice->fee_id ? 'selected' : '' }}> {{ $fee->name }}</option>
                    @endforeach
                </select>
              </div>

            </div>

            <div class="form-group">
              <label for="inputAddress">{{ __('trans_fee.note') }}</label>
              <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="4">{{ $fee_invoice->description }}</textarea>
            </div>
            <br>

            <button type="submit" class="btn btn-primary">{{ __('trans_fee.submit') }}</button>

          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- row closed -->
@endsection
@section('js')

@endsection

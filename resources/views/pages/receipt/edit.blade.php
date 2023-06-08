@extends('layouts.master')
@section('css')

@section('title')
{{ __('trans_fee.amendment bill exchange') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
  <div class="row">
    <div class="col-sm-6">
      <h6 class="mb-0">{{ __('trans_fee.amendment bill exchange') }} <span style="color: red">{{ $receipt->student->name }}</span></h6>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
        <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('trans_fee.amendment bill exchange') }}</li>
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

        <form action="{{ route('receipts.update', $receipt->id) }}" method="post" autocomplete="off">
          @method('PUT')
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>{{ __('trans_fee.amount') }} : <span class="text-danger">*</span></label>
                <input class="form-control" name="receipt" value="{{ $receipt->amount }}" type="number">
                <input type="hidden" name="student_id" value="{{ $receipt->student->id }}"
                  class="form-control">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>{{ __('trans_fee.note') }} : <span class="text-danger">*</span></label>
                <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3">{{ $receipt->note }}</textarea>
              </div>
            </div>
          </div>
          <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
            type="submit">{{ trans('trans_student.submit') }}</button>
        </form>

      </div>
    </div>
  </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection

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

          <form class=" row mb-30" action="{{ route('fee_invoices.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="repeater">
                <div data-repeater-list="List_Fees">
                  <div data-repeater-item>
                    <div class="row">

                      <div class="col">
                        <label for="student_id" class="mr-sm-2">{{ __('trans_fee.name') }}</label>
                        <select class="fancyselect" name="student_id" required id="student_id">
                          <option value="{{ $student->id }}">{{ $student->name }}</option>
                        </select>
                      </div>

                      <div class="col">
                        <label for="Name_en" class="mr-sm-2">{{ __('trans_fee.fees type') }}</label>
                        <div class="box">
                          <select class="fancyselect" name="fee_id" required>
                            <option value="">{{ __('trans_fee.chose') }}</option>
                            @foreach ($fees as $fee)
                              <option value="{{ $fee->id }}">{{ $fee->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col">
                        <label for="Name_en" class="mr-sm-2">{{ __('trans_fee.amount') }}</label>
                        <div class="box">
                          <select class="fancyselect" name="amount" required>
                            <option value="">{{ __('trans_fee.chose') }}</option>
                            @foreach ($fees as $fee)
                              <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col">
                        <label for="description" class="mr-sm-2">{{ __('trans_fee.note') }}</label>
                        <div class="box">
                          <input type="text" class="form-control" name="note">
                        </div>
                      </div>

                      <div class="col">
                        <label for="Name_en" class="mr-sm-2">{{ __('trans_fee.processes') }}:</label>
                        <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('trans_fee.delete') }}" style="height: 46px" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-20">
                  <div class="col-12">
                    <input class="button" data-repeater-create type="button" value="{{ __('trans_fee.add row') }}" />
                  </div>
                </div><br>

                <input type="hidden" name="grade_id" value="{{ $student->section->grade->id }}">
                <button type="submit" class="btn btn-primary">{{ __('trans_fee.submit') }}</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- row closed -->
@endsection
@section('js')

@endsection

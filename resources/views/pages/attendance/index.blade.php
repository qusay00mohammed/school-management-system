@extends('layouts.master')
@section('css')
@section('title')
{{ __("trans_student.record attendance absence") }}
@stop
@endsection

{{-- @section('page-header')
<!-- breadcrumb -->
<div class="page-title">
  <div class="row">
    <div class="col-sm-6">
      <h4 class="mb-0">{{ __("trans_student.record attendance absence") }}</h4>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
        <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __("trans_student.record attendance absence") }}</li>
      </ol>
    </div>
  </div>
</div>
<!-- breadcrumb -->
@endsection --}}



@section('content')
<!-- row -->

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if (session('status'))
  <div class="alert alert-danger">
    <ul>
      <li>{{ session('status') }}</li>
    </ul>
  </div>
@endif



<h5 style="font-family: 'Cairo', sans-serif;color: red">{{ __("trans_student.today date") }} : {{ date('Y-m-d') }}</h5>
<form method="post" action="{{ route('attendance.store') }}">

  @csrf
  <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
    style="text-align: center">
    <thead>
      <tr>
        <th class="alert-success">#</th>
        <th class="alert-success">{{ trans('trans_student.name') }}</th>
        <th class="alert-success">{{ trans('trans_student.email') }}</th>
        <th class="alert-success">{{ trans('trans_student.gender') }}</th>
        <th class="alert-success">{{ trans('trans_student.stage') }}</th>
        <th class="alert-success">{{ trans('trans_student.grade') }}</th>
        <th class="alert-success">{{ trans('trans_student.section') }}</th>
        <th class="alert-success">{{ trans('trans_student.processes') }}</th>
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

            @if (isset($student->attendances->where('date', date('Y-m-d'))->first()->student_id))

              <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                <input name="attendences[{{ $student->id }}]" disabled
                  {{ $student->attendances->first()->status == 1 ? 'checked' : '' }} class="leading-tight"
                  type="radio" value="presence">
                <span class="text-success">{{ trans('trans_student.presence') }}</span>
              </label>

              <label class="ml-4 block text-gray-500 font-semibold">
                <input name="attendences[{{ $student->id }}]" disabled
                  {{ $student->attendances->first()->status == 0 ? 'checked' : '' }} class="leading-tight"
                  type="radio" value="absent">
                <span class="text-danger">{{ trans('trans_student.absence') }}</span>
              </label>

            @else
              <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio" value="presence">
                <span class="text-success">{{ trans('trans_student.presence') }}</span>
              </label>

              <label class="ml-4 block text-gray-500 font-semibold">
                <input name="attendences[{{ $student->id }}]" class="leading-tight" type="radio" value="absent">
                <span class="text-danger">{{ trans('trans_student.absence') }}</span>
              </label>
            @endif

            <input type="hidden" name="student_id[]" value="{{ $student->id }}">
            {{-- <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}"> --}}
            {{-- <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}"> --}}
            <input type="hidden" name="section_id" value="{{ $student->section_id }}">

          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <P>
    <button class="btn btn-success" type="submit">{{ trans('trans_student.submit') }}</button>
  </P>
</form><br>
<!-- row closed -->
@endsection
@section('js')

@endsection

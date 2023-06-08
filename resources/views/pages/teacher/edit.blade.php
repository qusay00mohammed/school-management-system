@extends('layouts.master')
@section('css')

@endsection

@section('title')
  {{ trans('trans_teacher.edit teacher') }}
@stop

@section('page-header')
  <!-- breadcrumb -->
{{-- @section('PageTitle')
  {{ trans('trans_teacher.edit teacher') }}
@stop --}}
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        @if (session()->has('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <div class="col-xs-12">
          <div class="col-md-12">
            <br>
            <form action="{{ route('teachers.update', [$teacher->id]) }}" method="POST">
              @csrf
              @method("put")
              <div class="form-row">
                <div class="col">
                  <label for="title">{{ trans('trans_teacher.email') }}</label>
                  <input type="email" name="email" class="form-control" value="{{ $teacher->email }}">
                  @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col">
                  <label for="title">{{ trans('trans_teacher.password') }}</label>
                  <input type="password" name="password" class="form-control">
                  @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <br>


              <div class="form-row">
                <div class="col">
                  <label for="title">{{ trans('trans_teacher.name_ar') }}</label>
                  <input type="text" name="name_ar" class="form-control"  value="{{ $teacher->getTranslation('name', 'ar') }}">
                  @error('name_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col">
                  <label for="title">{{ trans('trans_teacher.name_en') }}</label>
                  <input type="text" name="name_en" class="form-control" value="{{ $teacher->getTranslation('name', 'ar') }}">
                  @error('name_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <br>
              <div class="form-row">
                <div class="form-group col">
                  <label for="inputCity">{{ trans('trans_teacher.specialization') }}</label>
                  <select class="custom-select my-1 mr-sm-2" name="specialization_id">
                    <option selected disabled>{{ trans('trans_parent.choose') }}...</option>
                    @foreach ($specializations as $specialization)
                      <option {{ $teacher->specialization_id == $specialization->id ? 'selected' : '' }} value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                    @endforeach
                  </select>
                  @error('specialization_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group col">
                  <label for="inputState">{{ trans('trans_teacher.gender') }}</label>
                  <select class="custom-select my-1 mr-sm-2" name="gender_id">
                    <option selected disabled>{{ trans('trans_parent.choose') }}...</option>
                    @foreach ($gender as $ge)
                      <option  {{ $teacher->gender_id == $ge->id ? 'selected' : '' }} value="{{ $ge->id }}">{{ $ge->name }}</option>
                    @endforeach
                  </select>
                  @error('gender_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <br>

              <div class="form-row">
                <div class="col">
                  <label for="title">{{ trans('trans_teacher.joining date') }}</label>
                  <div class='input-group date'>
                    <input class="form-control" type="text" id="datepicker-action" name="joining_date"
                      data-date-format="yyyy-mm-dd" required value="{{ $teacher->joining_date }}">
                  </div>
                  @error('joining_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <br>

              <div class="form-group">
                <label for="exampleFormControlTextarea1">{{ trans('trans_teacher.address') }}</label>
                <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="4">{{ $teacher->address }}</textarea>
                @error('address')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                type="submit">{{ trans('trans_teacher.save') }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection

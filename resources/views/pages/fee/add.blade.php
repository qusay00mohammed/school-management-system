@extends('layouts.master')
@section('css')

@endsection

@section('title')
  {{ __('trans_fee.add study fees') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
  <div class="row">
    <div class="col-sm-6">
      <h4 class="mb-0"> {{ __('trans_fee.add study fees') }}</h4>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
        <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('trans_fee.add study fees') }}</li>
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

        <form method="post" action="{{ route('fees.store') }}" autocomplete="off">
          @csrf
          <div class="form-row">
            <div class="form-group col">
              <label for="inputEmail4">{{ __('trans_fee.name_ar') }}</label>
              <input type="text" value="{{ old('name_ar') }}" name="name_ar" class="form-control" required>
            </div>

            <div class="form-group col">
              <label for="inputEmail4">{{ __('trans_fee.name_en') }}</label>
              <input type="text" value="{{ old('name_en') }}" name="name_en" class="form-control" required>
            </div>


            <div class="form-group col">
              <label for="inputEmail4">{{ __('trans_fee.amount') }}</label>
              <input type="number" value="{{ old('amount') }}" name="amount" class="form-control" required>
            </div>

          </div>


          <div class="form-row">

            <div class="form-group col">
              <label for="inputState">{{ __('trans_fee.stage') }}</label>
              <select class="custom-select mr-sm-2" name="stage_id" required>
                <option selected disabled>{{ trans('trans_fee.choose') }}...</option>
                @foreach ($stage as $s)
                  <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col">
              <label for="inputZip">{{ __('trans_fee.grade') }}</label>
              <select class="custom-select mr-sm-2" name="grade_id" required>

              </select>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="academic_year">{{ trans('trans_student.academic year') }} : <span
                    class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="academic_year" required>
                  <option selected disabled>{{ trans('trans_student.choose') }}...</option>
                  <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                  <option value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
                </select>
              </div>
            </div>

            <div class="form-group col">
              <label for="inputZip">{{ trans('trans_fee.fees type') }}</label>
              <select class="custom-select mr-sm-2" name="fee_type" required>
                <option value="1">{{ trans('trans_student.stady fees') }}</option>
                <option value="2">{{ trans('trans_student.bus fees') }}</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputAddress">{{ trans('trans_fee.note') }}</label>
            <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="4"></textarea>
          </div>
          <br>

          <button type="submit" class="btn btn-primary">{{ trans('trans_fee.submit') }}</button>

        </form>

      </div>
    </div>
  </div>
</div>
<!-- row closed -->




@endsection
@section('js')
{{-- Get Grade By Stage--}}
<script>
    $(document).ready(function() {
        $('select[name="stage_id"]').on('change', function() {
            var stage_id = $(this).val();
            if (stage_id) {
                $.ajax({
                    url: "{{ URL::to('filter_grade_by_stage') }}/" + stage_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="grade_id"]').empty();
                        $('select[name="grade_id"]').append('<option selected disabled >{{trans('trans_student.choose')}}...</option>');
                        $.each(data.grade, function(key, value) {
                            $('select[name="grade_id"]').append('<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

{{-- Get Sections By Grade--}}
<script>
    $(document).ready(function() {
        $('select[name="grade_id"]').on('change', function() {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "{{ URL::to('filter_section_by_grade') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $('select[name="section_id"]').append('<option selected disabled >{{trans('trans_student.choose')}}...</option>');
                        $.each(data.sections, function(key, value) {
                            $('select[name="section_id"]').append('<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endsection

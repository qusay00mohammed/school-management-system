@extends('layouts.master')
@section('css')

@endsection

@section('PageTitle')
  {{ __('trans_student.add graduated') }}
@stop

@section('page-header')
  <!-- breadcrumb -->
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0">{{ __('trans_student.add graduated') }}</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('trans_student.add graduated') }}</li>
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

          @if (Session::has('error_graduated'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>{{ Session::get('error_graduated') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <form action="{{ route('graduated.store') }}" method="post">
            @csrf
            <div class="form-row">

              <div class="form-group col">
                <label for="stage_id">{{ trans('trans_student.stage') }}</label>
                <select class="custom-select mr-sm-2" name="stage_id" required>
                  <option selected disabled>{{ trans('trans_student.choose') }}...</option>
                  @foreach ($stage as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col">
                <label for="grade_id">{{ trans('trans_student.grade') }} : <span class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="grade_id" required>

                </select>
              </div>

              <div class="form-group col">
                <label for="section_id">{{ trans('trans_student.section') }} : </label>
                <select class="custom-select mr-sm-2" name="section_id" required>

                </select>
              </div>

            </div>

            <button type="submit" class="btn btn-primary">{{ trans('trans_student.submit') }}</button>
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

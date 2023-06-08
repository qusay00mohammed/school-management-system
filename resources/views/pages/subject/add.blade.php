@extends('layouts.master')
@section('css')
@section('title')
{{ __('trans_student.add subject') }}
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
  <div class="row">
    <div class="col-sm-6">
      <h4 class="mb-0">{{ __('trans_student.add subject') }}</h4>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
        <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('trans_student.add subject') }}</li>
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

                    @if(session()->has('error'))
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
                            <form action="{{route('subject.store')}}" method="post" autocomplete="off">
                                @csrf

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ __('trans_student.subject name arabic') }}</label>
                                        <input type="text" name="name_ar" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="title">{{ __('trans_student.subject name english') }}</label>
                                        <input type="text" name="name_en" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputState">{{ __('trans_student.stage') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="stage_id">
                                            <option selected disabled>{{ __('trans_student.choose') }}...</option>
                                            @foreach($stage as $st)
                                                <option value="{{$st->id}}">{{$st->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputState">{{ __('trans_student.grade') }}</label>
                                        <select name="grade_id" class="custom-select"></select>
                                    </div>


                                    <div class="form-group col">
                                        <label for="inputState">{{ __('trans_student.teacher name') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                            <option selected disabled>{{trans('trans_student.choose')}}...</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ __('trans_student.submit') }}</button>
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
@endsection

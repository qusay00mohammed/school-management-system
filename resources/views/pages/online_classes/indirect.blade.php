@extends('layouts.master')
@section('css')

@section('title')
{{ __('trans_student.add new class') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('trans_student.add new class') }}
@stop
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

                <form action="{{ route('online_classes.storeIndirect') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Grade_id">{{ __('trans_student.stage') }}: <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="stage_id" required>
                                    <option selected disabled>{{ __('trans_student.choose') }}...</option>
                                    @foreach ($stage as $st)
                                        <option value="{{ $st->id }}">{{ $st->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="grade_id">{{ __('trans_student.grade') }} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="grade_id" required>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="section_id">{{ trans('trans_student.section') }} : </label>
                                <select class="custom-select mr-sm-2" name="section_id" required>

                                </select>
                            </div>
                        </div>
                    </div><br>

                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{{ __('trans_student.meeting number') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="meeting_id" type="number">
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{{ __('trans_student.class address') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="topic" type="text">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('trans_student.class date and time') }}: <span class="text-danger">*</span></label>
                                <input class="form-control" type="datetime-local" name="start_time">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{{ __('trans_student.class duration in minutes') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="duration" type="number">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>{{ __('trans_student.meeting password') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="password" type="text">
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('trans_student.link started meeting') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="start_url" type="text">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>{{ __('trans_student.student entry link for meeting') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="join_url" type="text">
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

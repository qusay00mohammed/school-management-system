@extends('layouts.master')
@section('css')

@section('title')
{{ __('trans_setting.edit new book') }} {{$book->title}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ __('trans_setting.edit new book') }} {{$book->title}}
@stop
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
                            <form action="{{route('library.update', $book->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{ __('trans_setting.book name') }}</label>
                                        <input type="text" name="title" value="{{$book->title}}" class="form-control">
                                    </div>

                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="stage_id">{{trans('trans_student.stage')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="stage_id">
                                                <option selected disabled>{{trans('trans_student.choose')}}...</option>
                                                @foreach($stage as $st)
                                                    <option  value="{{ $st->id }}" {{ $book->section->grade->stage->id == $st->id ? 'selected' : '' }}>{{ $st->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="grade_id">{{trans('trans_student.grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="grade_id">
                                              <option value="{{ $book->section->grade->id }}">{{ $book->section->grade->name }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('trans_student.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
                                                <option value="{{$book->section_id}}">{{$book->section->name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><br>

                                <div class="form-row">
                                    <div class="col">

                                        {{-- <embed src="{{ URL::asset('attachments/library/'.$book->file_name) }}" type="application/pdf"   height="150px" width="100px"><br><br> --}}

                                        <div class="form-group">
                                            <label for="academic_year">{{trans('trans_student.attachments')}} : </label>
                                            <input type="file" accept="application/pdf"  name="file">
                                        </div>

                                    </div>
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ __('trans_student.edit') }}</button>
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

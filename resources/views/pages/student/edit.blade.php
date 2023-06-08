@extends('layouts.master')
@section('css')

@endsection

@section('title')
  {{ trans('trans_student.edit student') }}
@stop

@section('PageTitle')
    {{ trans('trans_student.edit student') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('trans_student.edit student') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('trans_student.edit student') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <form method="POST" action="{{ route('students.update', [$student->id]) }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('PUT')

          <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ trans('trans_student.personal information') }}
          </h6><br>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{{ trans('trans_student.name_ar') }} : <span class="text-danger">*</span></label>
                <input type="text" name="name_ar" class="form-control" value="{{ $student->getTranslation('name', 'ar') }}">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>{{ trans('trans_student.name_en') }} : <span class="text-danger">*</span></label>
                <input class="form-control" name="name_en" type="text"  value="{{ $student->getTranslation('name', 'en') }}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{{ trans('trans_student.email') }} : </label>
                <input type="email" name="email" class="form-control"  value="{{ $student->email }}">
              </div>
            </div>


            <div class="col-md-6">
              <div class="form-group">
                <label>{{ trans('trans_student.password') }} :</label>
                <input type="password" name="password" class="form-control">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="gender">{{ trans('trans_student.gender') }} : <span class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="gender_id">
                  @foreach ($gender as $g)
                    <option {{ $student->gender_id == $g->id ? 'selected' : '' }} value="{{ $g->id }}">{{ $g->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="nal_id">{{ trans('trans_student.nationality') }} : <span
                    class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="nationality_id">
                  @foreach ($nationalities as $n)
                    <option {{ $student->nationality_id == $n->id ? 'selected' : '' }} value="{{ $n->id }}">{{ $n->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="bg_id">{{ trans('trans_student.blood type') }} : </label>
                <select class="custom-select mr-sm-2" name="bloodType_id">
                  @foreach ($bloodType as $bt)
                    <option {{ $student->bloodType_id == $bt->id ? 'selected' : '' }} value="{{ $bt->id }}">{{ $bt->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>{{ trans('trans_student.date birthday') }} :</label>
                <input class="form-control" type="text" id="datepicker-action" name="date_birthday"
                  data-date-format="yyyy-mm-dd" value="{{ $student->date_birthday }}">
              </div>
            </div>

          </div>

          <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ trans('trans_student.student information') }}
          </h6><br>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="stage_id">{{ trans('trans_student.stage') }} : <span class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="stage_id">
                    <option value="{{ $student->section->grade->stage->id }}" selected>{{ $student->section->grade->stage->name }}</option>
                  @foreach ($stage as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="grade_id">{{ trans('trans_student.grade') }} : <span
                    class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="grade_id">
                    <option value="{{ $student->section->grade->id }}" selected>{{ $student->section->grade->name }}</option>
                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="section_id">{{ trans('trans_student.section') }} : </label>
                <select class="custom-select mr-sm-2" name="section_id">
                    <option value="{{ $student->section->id }}" selected>{{ $student->section->name }}</option>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="parent_id">{{ trans('trans_student.father name') }} : <span
                    class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="parent_id">
                  @foreach ($parent as $p)
                    <option {{ $student->parent_id == $p->id ? 'selected' : '' }} value="{{ $p->id }}">{{ $p->father_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="academic_year">{{ trans('trans_student.academic year') }} : <span class="text-danger">*</span></label>
                <select class="custom-select mr-sm-2" name="academic_year">
                    <option {{ $student->academic_year == date('Y') ? 'selected' : '' }} value="{{ date('Y') }}">{{ date('Y') }}</option>
                    <option {{ $student->academic_year == date('Y') + 1 ? 'selected' : '' }} value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
                </select>
              </div>
            </div>
          </div><br>

          <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">
            {{ trans('trans_student.edit') }}
          </button>
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

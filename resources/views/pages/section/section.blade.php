@extends('layouts.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection




@section('title')
  {{ trans('trans_section.title') }}
@stop

@section('page-header')
  <!-- breadcrumb -->
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0">{{ __('trans_section.title') }}</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('trans_section.title') }}</li>
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
            @can('add section')
                <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">{{ trans('trans_section.add section') }}</a>
                <br><br>
            @endcan

            <div class="accordion gray plus-icon round">

              @foreach ($stage as $s)
                <div class="acd-group">
                  <a href="#" class="acd-heading">{{ $s->name }}</a>
                  <div class="acd-des">

                    <div class="row">
                      <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                          <div class="card-body">
                            <div class="d-block d-md-flex justify-content-between">
                              <div class="d-block"></div>
                            </div>
                            <div class="table-responsive mt-15">
                              <table class="table center-aligned-table mb-0">
                                <thead>
                                  <tr class="text-dark">
                                    <th>#</th>
                                    <th>{{ trans('trans_section.name') }}</th>
                                    <th>{{ trans('trans_section.grade name') }}</th>
                                    <th>{{ trans('trans_section.status') }}</th>
                                    @canany(['delete section', 'edit section'])
                                    <th>{{ trans('trans_section.processes') }}</th>
                                    @endcanany
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($s->sections as $key => $ss)
                                    <tr>
                                      <td>{{ ++$key }}</td>
                                      <td>{{ $ss->name }}</td>
                                      <td>{{ $ss->grade->name }}</td>
                                      <td>
                                        @if ($ss->status === 0)
                                          <label
                                            class="badge badge-success">{{ trans('trans_section.status active') }}</label>
                                        @else
                                          <label
                                            class="badge badge-danger">{{ trans('trans_section.status unactive') }}</label>
                                        @endif

                                      </td>
                                      @canany(['delete section', 'edit section'])
                                      <td>

                                        @can('edit section')
                                        <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                          data-target="#edit{{ $ss->id }}">{{ trans('trans_section.edit') }}</a>
                                        @endcan

                                        @can('delete section')
                                        <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                          data-target="#delete{{ $ss->id }}">{{ trans('trans_section.delete') }}</a>
                                        @endcan
                                      </td>
                                      @endcanany
                                    </tr>


                                    <!--تعديل قسم جديد -->
                                    <div class="modal fade" id="edit{{ $ss->id }}" tabindex="-1" role="dialog"
                                      aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                              id="exampleModalLabel">
                                              {{ trans('trans_section.edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">

                                            <form action="{{ route('section.update', [$ss->id]) }}" method="POST">
                                              @csrf
                                              {{ method_field('patch') }}
                                              <div class="row">
                                                <div class="col">
                                                  <input type="text" name="name_ar" class="form-control"
                                                    value="{{ $ss->getTranslation('name', 'ar') }}">
                                                </div>

                                                <div class="col">
                                                  <input type="text" name="name_en" class="form-control"
                                                    value="{{ $ss->getTranslation('name', 'en') }}">
                                                </div>
                                              </div>
                                              <br>
                                              <div class="col">
                                                <label for="inputName"
                                                  class="control-label">{{ trans('trans_section.stage name') }}</label>
                                                <select name="stage_id" class="custom-select">
                                                  @foreach ($stage as $st)
                                                    <option {{ $s->id == $st->id ? 'selected' : '' }}
                                                      value="{{ $st->id }}">
                                                      {{ $st->name }}
                                                    </option>
                                                  @endforeach
                                                </select>
                                              </div>
                                              <br>
                                              <div class="col">
                                                <label for="inputName"
                                                  class="control-label">{{ trans('trans_section.grade name') }}</label>
                                                <select name="grade_id" class="custom-select">
                                                  @foreach ($s->grades as $gr)
                                                    <option {{ $ss->grade->id == $gr->id ? 'selected' : '' }}
                                                      value="{{ $gr->id }}">{{ $gr->name }}</option>
                                                  @endforeach
                                                </select>
                                              </div>


                                              <div class="col">
                                                <label class="control-label">{{ trans('trans_student.teacher name') }}</label>
                                                <select multiple required name="teacher_id[]" class="form-control select2"
                                                style="display: block; width: 100%;"
                                                >
                                                        @foreach($teachers as $teacher)
                                                            <option
                                                            <?php
                                                                foreach ($ss->teachers as $value) {
                                                                    if ($value->id == $teacher->id) {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                            ?>
                                                            value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>


                                              <br>
                                              <div class="col">
                                                <input {{ $ss->status == 0 ? 'checked' : '' }} type="radio"
                                                  id="active" name="status" value="0">
                                                <label for="active">{{ trans('trans_section.status active') }}</label>
                                                <span></span>
                                                <input {{ $ss->status == 1 ? 'checked' : '' }} type="radio"
                                                  id="unactive" name="status" value="1">
                                                <label
                                                  for="unactive">{{ trans('trans_section.status unactive') }}</label>
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                              data-dismiss="modal">{{ trans('trans_section.close') }}</button>
                                            <button type="submit"
                                              class="btn btn-danger">{{ trans('trans_section.submit') }}</button>
                                          </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>


                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $ss->id }}" tabindex="-1"
                                      role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                              id="exampleModalLabel">
                                              {{ trans('trans_section.delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                              aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="{{ route('section.destroy', [$ss->id]) }}" method="post">
                                              {{ method_field('delete') }}
                                              @csrf
                                              {{ trans('trans_section.delete') }}
                                              <br><br>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                  data-dismiss="modal">{{ trans('trans_section.close') }}</button>
                                                <button type="submit"
                                                  class="btn btn-danger">{{ trans('trans_section.submit') }}</button>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              @endforeach
            </div>
          </div>
        {{-- </div> --}}

        <!-- add section -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                  {{ trans('trans_section.add section') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form action="{{ route('section.store') }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col">
                      <input type="text" name="name_ar" class="form-control"
                        placeholder="{{ trans('trans_section.name ar') }}" required>
                    </div>

                    <div class="col">
                      <input type="text" name="name_en" class="form-control"
                        placeholder="{{ trans('trans_section.name en') }}" required>
                    </div>
                  </div>
                  <br>


                  <div class="col">
                    <label for="inputName" class="control-label">{{ trans('trans_section.stage name') }}</label>
                    <select name="stage_id" class="custom-select" onchange="console.log($(this).val())">
                      <!--placeholder-->
                      <option value="" selected disabled>{{ trans('trans_section.select value') }}
                      </option>
                      @foreach ($stage as $s)
                        <option value="{{ $s->id }}"> {{ $s->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <br>

                  <div class="col">
                    <label for="inputName" class="control-label">{{ trans('trans_section.grade name') }}</label>
                    <select name="grade_id" class="custom-select"></select>
                  </div>

                <div class="col">
                    <label for="exampleFormControlSelect2" class="control-label">{{ trans('trans_student.teacher name') }}</label>
                    <select multiple required name="teacher_id[]" class="form-control select2" id="exampleFormControlSelect2"
                    style="display: block; width: 100%;"
                    >
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                        @endforeach
                    </select>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                  data-dismiss="modal">{{ trans('trans_section.close') }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('trans_section.submit') }}</button>
              </div>
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


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.select2').select2({})
})

</script>


@endsection





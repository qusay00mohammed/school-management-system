@extends('layouts.master')
@section('css')

@endsection

@section('title')
  {{ trans('trans_student.student information') }}
@stop

@section('PageTitle')
  {{ trans('trans_student.student information') }}
@stop


@section('page-header')
  <!-- breadcrumb -->
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0">{{ __('trans_student.student information') }}</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_student.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('trans_student.student information') }}</li>
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
          <div class="tab nav-border">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02" role="tab"
                  aria-controls="home-02" aria-selected="true">{{ trans('trans_student.student information') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02" role="tab"
                  aria-controls="profile-02" aria-selected="false">{{ trans('trans_student.attachments') }}</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade active show" id="home-02" role="tabpanel" aria-labelledby="home-02-tab">
                <table class="table table-striped table-hover" style="text-align:center">
                  <tbody>
                    <tr>
                      <th scope="row">{{ trans('trans_student.name') }}</th>
                      <td>{{ $student->name }}</td>
                      <th scope="row">{{ trans('trans_student.email') }}</th>
                      <td>{{ $student->email }}</td>
                      <th scope="row">{{ trans('trans_student.gender') }}</th>
                      <td>{{ $student->gender->name }}</td>
                      <th scope="row">{{ trans('trans_student.nationality') }}</th>
                      <td>{{ $student->nationality->name }}</td>
                    </tr>

                    <tr>
                      <th scope="row">{{ trans('trans_student.stage') }}</th>
                      <td>{{ $student->section->grade->stage->name }}</td>
                      <th scope="row">{{ trans('trans_student.grade') }}</th>
                      <td>{{ $student->section->grade->name }}</td>
                      <th scope="row">{{ trans('trans_student.section') }}</th>
                      <td>{{ $student->section->name }}</td>
                      <th scope="row">{{ trans('trans_student.date birthday') }}</th>
                      <td>{{ $student->date_birthday }}</td>
                    </tr>

                    <tr>
                      <th scope="row">{{ trans('trans_student.father name') }}</th>
                      <td>{{ $student->parent->father_name }}</td>
                      {{-- <td>asdasd</td> --}}
                      <th scope="row">{{ trans('trans_student.academic year') }}</th>
                      <td>{{ $student->academic_year }}</td>
                      <th scope="row"></th>
                      <td></td>
                      <th scope="row"></th>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">

                <form method="post" action="{{ route('uploadAttachment', $student->id) }}"
                  enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="academic_year">{{ trans('trans_student.attachments') }}
                        : <span class="text-danger">*</span></label>
                      <input type="file" accept="image/*" name="files[]" multiple required>
                    </div>
                  </div>
                  <br><br>
                  <button type="submit" class="button button-border x-small">
                    {{ trans('trans_student.submit') }}
                  </button>
                </form>

                <br>
                <table class="table center-aligned-table mb-0 table table-hover" style="text-align:center">
                  <thead>
                    <tr class="table-secondary">
                      <th scope="col">#</th>
                      <th scope="col">{{ trans('trans_student.file name') }}</th>
                      <th scope="col">{{ trans('trans_student.created_at') }}</th>
                      <th scope="col">{{ trans('trans_student.processes') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($student->fileAttachments as $attachment)
                      <tr style='text-align:center;vertical-align:middle'>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attachment->filename }}</td>
                        <td>{{ $attachment->created_at->diffForHumans() }}</td>
                        <td colspan="2">
                            <a class="btn btn-outline-info btn-sm"
                             href="{{ route('downloadAttachment', ['id_student'=>$student->id, 'id_attachment'=>$attachment->id]) }}"
                             role="button">
                            {{ trans('trans_student.download') }}
                            </a>

                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                data-target="#deleteImage{{ $attachment->id }}"
                                title="{{ trans('trans_student.delete') }}">{{ trans('trans_student.delete') }}
                            </button>
                        </td>
                      </tr>
                      <!-- begin delete image -->
                        <div class="modal fade" id="deleteImage{{$attachment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('trans_student.delete image')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('deleteAttachment', ['id_student'=>$student->id, 'id_attachment'=>$attachment->id]) }}" method="post">
                                            @csrf
                                            <h5 style="font-family: 'Cairo', sans-serif;">{{trans('trans_student.delete sure')}}</h5>
                                            <input type="text" name="filename" readonly value="{{$attachment->filename}}" class="form-control">

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('trans_student.close')}}</button>
                                                <button  class="btn btn-danger">{{trans('trans_student.delete')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    {{-- End delete image --}}
                    @endforeach
                  </tbody>
                </table>

              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- row closed -->
    @endsection


    @section('js')

    @endsection

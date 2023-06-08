@extends('layouts.master')
@section('css')

@section('title')
  {{ __('trans_main.list exams') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
  {{ __('trans_main.list exams') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <a href="{{ route('teacher.quizze.create') }}" class="btn btn-success btn-sm" role="button"
          aria-pressed="true">{{ __('trans_student.add new quizz') }}</a><br><br>
        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('trans_student.quizz name') }}</th>
                <th>{{ __('trans_student.teacher name') }}</th>
                <th>{{ __('trans_student.stage') }}</th>
                <th>{{ __('trans_student.grade') }}</th>
                <th>{{ __('trans_student.section') }}</th>
                <th>{{ __('trans_student.processes') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($quizzes as $quizze)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $quizze->name }}</td>
                  <td>{{ $quizze->teacher->name }}</td>
                  <td>{{ $quizze->section->grade->stage->name }}</td>
                  <td>{{ $quizze->section->grade->name }}</td>
                  <td>{{ $quizze->section->name }}</td>
                  <td>
                    <a href="{{ route('teacher.quizze.edit', $quizze->id) }}" class="btn btn-info btn-sm"
                      role="button" aria-pressed="true">
                      <i class="fa fa-edit"></i>
                    </a>

                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                      data-target="#delete_exam{{ $quizze->id }}" title="{{ __('trans_student.delete') }}"><i
                        class="fa fa-trash"></i>
                    </button>

                    <a href="{{ route('teacher.quizze.show', $quizze->id) }}" class="btn btn-warning btn-sm"
                      title="عرض الاسئلة" role="button" aria-pressed="true">
                      <i class="fa fa-binoculars"></i>
                    </a>
                  </td>
                </tr>

                <div class="modal fade" id="delete_exam{{ $quizze->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form action="{{ route('teacher.quizze.destroy', $quizze->id) }}" method="post">
                      @csrf
                      @method('post')
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ __('trans_student.delete') }} {{ $quizze->name }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>{{ __('trans_student.delete sure') }}</p>
                        </div>
                        <div class="modal-footer">
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                              data-dismiss="modal">{{ __('trans_student.close') }}</button>
                            <button type="submit" class="btn btn-danger">{{ __('trans_student.delete') }}</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              @endforeach
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

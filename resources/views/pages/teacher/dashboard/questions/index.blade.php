@extends('layouts.master')
@section('css')

@section('title')
  {{ __('trans_main.list question') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
  {{ __('trans_main.list question') }}: <span class="text-danger">{{ $quizz->name }}</span>
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <a href="{{ route('teacher.question.show', $quizz->id) }}" class="btn btn-success btn-sm" role="button"
          aria-pressed="true">{{ __('trans_student.add new question') }}</a><br><br>
        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
            style="text-align: center">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('trans_student.question') }}</th>
                <th scope="col">{{ __('trans_student.answer') }}</th>
                <th scope="col">{{ __('trans_student.right answer') }}</th>
                <th scope="col">{{ __('trans_student.score') }}</th>
                <th scope="col">{{ __('trans_student.quizz name') }}</th>
                <th scope="col">{{ __('trans_student.processes') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($questions as $question)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $question->title }}</td>
                  <td>{{ $question->answers }}</td>
                  <td>{{ $question->right_answer }}</td>
                  <td>{{ $question->score }}</td>
                  <td>{{ $question->quizze->name }}</td>
                  <td>
                    <a href="{{ route('teacher.question.edit', $question->id) }}" class="btn btn-info btn-sm"
                      role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                      data-target="#delete_question{{ $question->id }}" title="{{ __('trans_student.delete') }}"><i
                        class="fa fa-trash"></i></button>
                  </td>
                </tr>

                @include('pages.teacher.dashboard.questions.delete')
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

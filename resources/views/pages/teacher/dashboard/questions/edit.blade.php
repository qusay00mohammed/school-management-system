@extends('layouts.master')
@section('css')

@section('title')
{{ __('trans_student.edit question') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ __('trans_student.edit question') }} :<span class="text-danger">{{$question->title}}</span>
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
                            <form action="{{ route('teacher.question.update', $question->id) }}" method="post" autocomplete="off">
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{ __('trans_student.question') }}</label>
                                        <input type="text" name="title" id="input-name" class="form-control form-control-alternative" autofocus required value="{{ $question->title }}">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ __('trans_student.answer') }}</label>
                                        <textarea name="answers" class="form-control" id="exampleFormControlTextarea1" rows="4" required>{{ $question->answers }}</textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ __('trans_student.right answer') }}</label>
                                        <input type="text" name="right_answer" id="input-name" class="form-control form-control-alternative" autofocus  value="{{ $question->right_answer }}">
                                    </div>
                                </div>
                                <br>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Grade_id">{{ __('trans_student.score') }} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="score" required>
                                            <option selected disabled>{{ __('trans_student.choose') }} ...</option>
                                            <option value="1" {{ 1 == $question->score ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ 2 == $question->score ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ 3 == $question->score ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ 4 == $question->score ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ 5 == $question->score ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ 6 == $question->score ? 'selected' : '' }}>6</option>
                                            <option value="7" {{ 7 == $question->score ? 'selec ted' : '' }}>7</option>
                                            <option value="8" {{ 8 == $question->score ? 'selec ted' : '' }}>8</option>
                                            <option value="9" {{ 9 == $question->score ? 'selec ted' : '' }}>9</option>
                                            <option value="10" {{ 10 == $question->score ? 'selected' : '' }}>10</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
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

@endsection

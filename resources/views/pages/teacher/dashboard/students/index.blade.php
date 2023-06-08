@extends('layouts.master')
@section('css')

@endsection

@section('title')
  {{ __('trans_main.attendance') }}
@stop

@section('page-header')
  <!-- breadcrumb -->
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0">{{ __('trans_main.attendance') }}</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('trans_main.attendance') }}</li>
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

@if (session('status'))
<div class="alert alert-danger">
    <ul>
        <li>{{ session('status') }}</li>
    </ul>
</div>
@endif

  <!-- row -->
  <div class="row">
    <div class="col-md-12 mb-30">
      <div class="card card-statistics h-100">
        <div class="card-body">
          <div class="accordion gray plus-icon round">

            @foreach ($sections as $s)
              <div class="acd-group">
                <a href="#" class="acd-heading">{{ $s->grade->stage->name }} | {{ $s->grade->name }} |
                  {{ $s->name }}</a>
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
                                  <th class="alert-success">#</th>
                                  <th class="alert-success">{{ __('trans_student.name') }}</th>
                                  <th class="alert-success">{{ __('trans_student.email') }}</th>
                                  <th class="alert-success">{{ __('trans_student.gender') }}</th>
                                  <th class="alert-success">{{ __('trans_main.attendance') }}</th>
                                </tr>
                              </thead>
                              <tbody>

                                <form method="post" action="{{ route('teacher.attendences', $s->id) }}" autocomplete="off">
                                  @csrf
                                  @foreach ($s->students as $student)
                                    <tr>
                                      <td>{{ $loop->index + 1 }}</td>
                                      <td>{{ $student->name }}</td>
                                      <td>{{ $student->email }}</td>
                                      <td>{{ $student->gender->name }}</td>
                                      <td>
                                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                          <input name="attendences[{{ $student->id }}]"

                                            @foreach ($student->attendances()->where('date', date('Y-m-d'))->get() as $attendance)
                                                {{ $attendance->status == 1 ? 'checked' : '' }}
                                            @endforeach

                                            class="leading-tight" type="radio" value="presence">
                                          <span class="text-success">{{ __('trans_student.presence') }}</span>
                                        </label>

                                        <label class="ml-4 block text-gray-500 font-semibold">
                                          <input name="attendences[{{ $student->id }}]"
                                            @foreach ($student->attendances()->where('date', date('Y-m-d'))->get() as $attendance)
                                                {{ $attendance->status == 0 ? 'checked' : '' }}
                                            @endforeach
                                            class="leading-tight" type="radio" value="absent">
                                          <span class="text-danger">{{ __('trans_student.absence') }}</span>
                                        </label>
                                      </td>
                                    </tr>
                                  @endforeach
                                  <P>
                                    <button class="btn btn-success"
                                      type="submit">{{ trans('trans_student.submit') }}</button>
                                  </P>
                                </form>

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
      </div>



    </div>
  </div>
  </div>
  <!-- row closed -->
@endsection
@section('js')

@endsection

@extends('layouts.master')
@section('css')

@section('title')
{{ __('trans_main.attendance') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ __('trans_main.attendance') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

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

    <h5 style="font-family: 'Cairo', sans-serif;color: red"> {{ __('trans_student.today date') }} : {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('teacher.attendences') }}" autocomplete="off">
        @csrf
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
            <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">{{ __('trans_student.name') }}</th>
                <th class="alert-success">{{ __('trans_student.email') }}</th>
                <th class="alert-success">{{ __('trans_student.gender') }}</th>
                <th class="alert-success">{{ __('trans_student.stage') }}</th>
                <th class="alert-success">{{ __('trans_student.grade') }}</th>
                <th class="alert-success">{{ __('trans_student.section') }}</th>
                <th class="alert-success">{{ __('trans_main.attendance') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sections as $section)
                @foreach ($section->students as $student)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender->name }}</td>
                    <td>{{ $student->section->grade->stage->name }}</td>
                    <td>{{ $student->section->grade->name }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>
                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input name="attendences[{{ $student->id }}]"
                                   {{-- @foreach($student->attendance()->where('attendence_date',date('Y-m-d'))->get() as $attendance)
                                   {{ $attendance->attendence_status == 1 ? 'checked' : '' }}
                                   @endforeach --}}
                                   class="leading-tight" type="radio"
                                   value="presence">
                            <span class="text-success">{{ __('trans_student.presence') }}</span>
                        </label>

                        <label class="ml-4 block text-gray-500 font-semibold">
                            <input name="attendences[{{ $student->id }}]"
                                   {{-- @foreach($student->attendance()->where('attendence_date',date('Y-m-d'))->get() as $attendance)
                                   {{ $attendance->attendence_status == 0 ? 'checked' : '' }}
                                   @endforeach --}}
                                   class="leading-tight" type="radio"
                                   value="absent">
                            <span class="text-danger">{{ __('trans_student.absence') }}</span>
                        </label>
                    </td>
                </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
        <P>
            <button class="btn btn-success" type="submit">{{ trans('trans_student.submit') }}</button>
        </P>
    </form><br>
    <!-- row closed -->
@endsection
@section('js')

@endsection




{{-- <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
<input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}"> --}}
{{-- <input type="hidden" name="section_id" value="{{ $student->section_id }}"> --}}

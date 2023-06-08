@extends('layouts.master')
@section('css')

@section('title')
{{ __('trans_dashboard.attendance report') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ __('trans_dashboard.attendance report') }}
@stop
<!-- breadcrumb -->

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

                <form method="post"  action="{{ route('teacher.attendance.search') }}" autocomplete="off">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ __('trans_dashboard.search information') }}</h6><br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="student">{{ __('trans_dashboard.students') }}</label>
                                <select class="custom-select mr-sm-2" name="student_id">
                                    <option value="0">{{ __('trans_dashboard.all') }}</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-body datepicker-form">
                            <div class="input-group" data-date-format="yyyy-mm-dd">
                                <input type="text"  class="form-control range-from date-picker-default" placeholder="{{ __('trans_dashboard.start date') }}" required name="from">
                                <span class="input-group-addon">{{ __('trans_dashboard.to date') }}</span>
                                <input class="form-control range-to date-picker-default" placeholder="{{ __('trans_dashboard.end date') }}" type="text" required name="to">
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('trans_dashboard.search')}}</button>
                </form>
                @isset($results)
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                        <tr>
                            <th class="alert-success">#</th>
                            <th class="alert-success">{{trans('trans_student.name')}}</th>
                            <th class="alert-success">{{trans('trans_student.stage')}}</th>
                            <th class="alert-success">{{trans('trans_student.section')}}</th>
                            <th class="alert-success">{{trans('trans_dashboard.date')}}</th>
                            <th class="alert-warning">{{trans('trans_dashboard.status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $res)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{$res->student->name}}</td>
                                <td>{{$res->student->section->grade->stage->name}}</td>
                                <td>{{$res->student->section->name}}</td>
                                <td>{{$res->date}}</td>
                                <td>

                                    @if($res->status == 0)
                                        <span class="btn-danger">{{ __('trans_student.absence') }}</span>
                                    @else
                                        <span class="btn-success">{{ __('trans_student.presence') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @endisset

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection

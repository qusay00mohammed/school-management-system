@extends('layouts.master')
@section('css')
@section('title')
{{ __('trans_user.edit permission') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('trans_user.users') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('trans_user.edit permission') }}</span>
        </div>
        <br>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (count($errors) > 0)
<div class="alert alert-danger">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>خطا</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


{{-- {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.permissions.update', $role->id]]) !!} --}}

<form action="{{ route('roles.permissions.update', $role->id) }}" method="POST">
@csrf
<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    <div class="form-group">
                        <p style="font-size: 22px">{{ __('trans_user.role name') }} : <span style="color: rgb(187, 112, 112)">{{ $role->name }}</span></p>
                    </div>
                </div>
                <div class="row">
                    <!-- col -->
                    <div class="col-lg-4">
                        <p style="margin-bottom: 10px;font-size: 20px">{{ __('trans_user.permissions') }}</p>
                        {{-- <ul id="treeview1"> --}}
                            {{-- <li><a href="#"></a> --}}
                                <ul style="margin-left: 15px">
                                    @foreach($permission as $value)
                                    <li>
                                        <input id="{{ $value->id }}" type="checkbox" name="permission[]" value="{{ $value->id }}"
                                            @foreach ($rolePermissions as $v)
                                                @if ($value->id == $v)
                                                    @checked(true)
                                                @endif
                                            @endforeach
                                        >
                                        <label for="{{ $value->id }}" style="font-size: 15px">{{ $value->name }}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            {{-- </li> --}}
                        {{-- </ul> --}}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-main-primary">{{ __('trans_student.submit') }}</button>
                    </div>
                    <!-- /col -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
{{-- {!! Form::close() !!} --}}
</form>
@endsection
@section('js')

@endsection

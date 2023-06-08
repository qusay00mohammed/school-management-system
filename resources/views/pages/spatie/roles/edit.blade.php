@extends('layouts.master')
@section('css')
@section('title')
{{ __('trans_user.edit role') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('trans_user.users') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('trans_user.edit role') }}</span>
        </div>
        <br>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')


{{-- {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!} --}}
<form action="{{ route('roles.update', [$role->id]) }}" method="POST">
  @csrf
  @method('PUT')
  <!-- row -->
<div class="row">
  <div class="col-md-12">
    <div class="card mg-b-20">
        <div class="card-body">
          <div class="main-content-label mg-b-5">
            <div class="col-xs-7 col-sm-7 col-md-7">
                {{-- <div class="form-group">
                    <label>Guard Name</label>
                    <select name="guard_name" required class="form-control">
                      <option {{ $role->guard_name == 'super_admin' ? 'selected' : '' }} value="super_admin">Super Admin</option>
                      <option {{ $role->guard_name == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                      <option {{ $role->guard_name == 'user' ? 'selected' : '' }} value="user">user</option>
                    </select>
                </div> --}}


                <div class="form-group">
                  <label for="">{{ __('trans_user.edit role') }}</label>
                  <input type="text" value="{{ $role->name }}" class="form-control" name="name" placeholder="{{ __('trans_user.role name') }}" required>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-main-primary">{{ __('trans_student.edit') }}</button>
                </div>

            </div>
          </div>

          </div>
        </div>
    </div>
  </div>
</div>
</form>



</div>
</div>
@endsection
@section('js')
@endsection

@extends('layouts.master')
@section('css')
@section('title')
{{ __('trans_user.roles') }}
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('trans_user.users') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / {{ __('trans_user.roles') }}</span>
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
<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a style="display: inline-block; margin-bottom: 10px" class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">{{ __('trans_user.add role') }}</a>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('trans_user.role name') }}</th>
                                {{-- <th>Guard Name</th> --}}
                                <th>{{ __('trans_user.permission number') }}</th>
                                <th>{{ __('trans_user.process') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $role->name }}</td>
                                {{-- <td>{{ $role->guard_name }}</td> --}}
                                <td><a href="{{ route('roles.permissions.index', [$role->id]) }}" class="btn btn-info btn-sm">( {{ $role->permissions_count }} ) {{ __('trans_user.permission') }}</a></td>
                                <td>
                                    {{-- <a class="btn btn-success btn-sm" href="{{ route('roles.show', $role->id) }}">عرض</a> --}}

                                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', [$role->id]) }}">{{ __('trans_user.edit role') }}</a>

                                    <a class="btn btn-danger btn-sm" href="{{ route('roles.delete', [$role->id]) }}">{{ __('trans_user.delete role') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
@endsection

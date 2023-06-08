@extends('layouts.master')
@section('css')

@endsection
@section('title')
{{ __('trans_main.user permissions') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
  <div class="my-auto">
    <div class="d-flex">
      <h4 class="content-title mb-0 my-auto">{{ __('trans_user.permissions') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / {{ __('trans_main.user permissions') }}</span>
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
            {{-- <div class="pull-right">
              <a style="margin-bottom: 10px; display: inline-block" class="btn btn-primary btn-sm" href="{{ route('permissions.create') }}">{{ __('trans_user.add permission') }}</a>

            </div> --}}
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table mg-b-0 text-md-nowrap table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('trans_user.permission name') }}</th>
                <th>{{ __('trans_user.guard name') }}</th>
                {{-- <th>{{ __('trans_user.process') }}</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($permissions as $key => $permission)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                {{-- <td> --}}
                  {{-- <a class="btn btn-success btn-sm" href="{{ route('permissions.show', $permission->id) }}">عرض</a> --}}

                  {{-- <a class="btn btn-primary btn-sm" href="{{ route('permissions.edit', [$permission->id]) }}">{{ __('trans_user.edit permission') }}</a>

                  <a class="btn btn-danger btn-sm" href="{{ route('permissions.delete', [$permission->id]) }}">{{ __('trans_user.delete permission') }}</a>
                </td> --}}
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

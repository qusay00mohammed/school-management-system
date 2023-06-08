@extends('layouts.master')
@section('css')

@section('title')
{{ __('trans_main.list library') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('trans_main.list library') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


<!-- row -->
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        @can('add book')
        <a href="{{ route('library.create') }}" class="btn btn-success btn-sm" role="button" aria-pressed="true">{{ __('trans_setting.add new book') }}</a>
        <br><br>
        @endcan
        <div class="table-responsive">
          <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('trans_setting.book name') }}</th>
                <th>{{ __('trans_student.teacher name') }}</th>
                <th>{{ __('trans_student.stage') }}</th>
                <th>{{ __('trans_student.grade') }}</th>
                <th>{{ __('trans_student.section') }}</th>
                <th>{{ __('trans_student.processes') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($books as $book)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $book->title }}</td>
                  <td>{{ $book->teacher->name }}</td>
                  <td>{{ $book->section->grade->stage->name }}</td>
                  <td>{{ $book->section->grade->name }}</td>
                  <td>{{ $book->section->name }}</td>
                  <td>
                    @can('edit book')
                    <a href="{{ route('library.edit', $book->id) }}" class="btn btn-info btn-sm" role="button"
                        aria-pressed="true"><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('delete book')
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                    data-target="#delete_book{{ $book->id }}" title="{{ __('trans_student.delete') }}"><i class="fa fa-trash"></i></button>
                    @endcan
                    @can('download book')
                    <a href="{{ route('library.show', $book->file_name) }}" title="Downlaod Book"
                        class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i
                          class="fa fa-download"></i></a>
                    @endcan
                  </td>
                </tr>

                @include('pages.library.delete')
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

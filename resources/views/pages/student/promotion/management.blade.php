@extends('layouts.master')
@section('css')

@endsection

@section('PageTitle')
  {{ __('trans_student.management promotion') }}
@stop

@section('page-header')
  <!-- breadcrumb -->
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0">{{ __('trans_student.management promotion') }}</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('trans_student.management promotion') }}</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection

@section('content')
  <!-- row -->
  <div class="row">
    <div class="col-md-12 mb-30">
      <div class="card card-statistics h-100">
        <div class="card-body">
          @can('add promotion')
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#back_all">
                {{ __('trans_student.back all') }}
            </button>
            <button type="button" class="btn btn-success">
                <a href=" {{ route('promotion.index') }}">{{ __('trans_student.add promotion') }}</a>
            </button>
            <br><br>
          @endcan

          <div class="table-responsive">
            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
              style="text-align: center">
              <thead>
                <tr>
                  <th class="alert-info">#</th>
                  <th class="alert-info">{{ __('trans_student.student name') }}</th>
                  <th class="alert-danger">{{ __('trans_student.previous stage') }}</th>
                  <th class="alert-danger">{{ __('trans_student.previous academic year') }}</th>
                  <th class="alert-danger">{{ __('trans_student.previous grade') }}</th>
                  <th class="alert-danger">{{ __('trans_student.previous section') }}</th>

                  <th class="alert-success">{{ __('trans_student.next stage') }}</th>
                  <th class="alert-success">{{ __('trans_student.next academic year') }}</th>
                  <th class="alert-success">{{ __('trans_student.next grade') }}</th>
                  <th class="alert-success">{{ __('trans_student.next section') }}</th>
                  @can('add promotion')
                  <th>{{ __('trans_student.processes') }}</th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                @foreach ($promotions as $promotion)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $promotion->student->name }}</td>
                    <td>{{ $promotion->student->section->grade->stage->name }}</td>
                    <td>{{ $promotion->academic_year }}</td>
                    <td>{{ $promotion->student->section->grade->name }}</td>
                    <td>{{ $promotion->student->section->name }}</td>
                    <td>{{ $promotion->section->grade->stage->name }}</td>
                    <td>{{ $promotion->academic_year_new }}</td>
                    <td>{{ $promotion->section->grade->name }}</td>
                    <td>{{ $promotion->section->name }}</td>
                    @can('add promotion')
                    <td>
                      <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                        data-target="#delete_one{{ $promotion->id }}">{{ __('trans_student.previous student') }}</button>

                      <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">{{ __('trans_student.student graduation') }}</button>
                    </td>
                    @endcan
                  </tr>

                  {{-- back a student --}}
                  <div class="modal fade" id="delete_one{{ $promotion->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ __('trans_student.previous student') }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('promotion.destroy', $promotion->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <h5 style="font-family: 'Cairo', sans-serif;">
                              {{ __('trans_student.are you sure previous student') }}
                              {{ $promotion->student->name }}</h5>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('trans_student.close') }}</button>
                              <button class="btn btn-danger">{{ trans('trans_student.submit') }}</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- row closed -->

  {{-- back all --}}
  <div class="modal fade" id="back_all" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
            {{ __('trans_student.back all') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('promotion.destroy', 'back') }}" method="post">
            @csrf
            @method('DELETE')
            <h5 style="font-family: 'Cairo', sans-serif;">{{ trans('trans_student.previous all') }}</h5>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary"
                data-dismiss="modal">{{ trans('trans_student.close') }}</button>
              <button class="btn btn-danger">{{ trans('trans_student.submit') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')

@endsection

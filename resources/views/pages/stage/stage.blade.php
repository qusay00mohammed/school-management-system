@extends('layouts.master')
@section('css')
@endsection

@section('title')
  {{ __('trans_main.school stage') }}
@endsection

@section('page-header')
  <!-- breadcrumb -->
  <div class="page-title">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="mb-0">{{ __('trans_main.school stage') }}</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
          <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('trans_main.school stage') }}</li>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          {{-- Open modal from add stage --}}
          @can('add stage')
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('trans_stage.add stage') }}
            </button>
            <br><br>
          @endcan
          {{-- end --}}
          <div class="table-responsive">
            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
              style="text-align: center">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{ trans('trans_stage.name') }}</th>
                  <th>{{ trans('trans_stage.notes') }}</th>
                  @canany(['edit stage', 'delete stage'])
                    <th>{{ trans('trans_stage.processes') }}</th>
                  @endcanany
                </tr>
              </thead>
              <tbody>
                @foreach ($stage as $key => $s)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $s->name }}</td>
                    <td>
                        @if ($s->notes == "")
                            {{ __('trans_stage.empty note') }}
                        @else
                            {{ $s->notes }}
                        @endif
                    </td>
                    @canany(['edit stage', 'delete stage'])
                        <td>
                            @can('edit stage')
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#edit{{ $s->id }}" title="{{ trans('trans_stage.edit stage') }}">
                                <i class="fa fa-edit"></i>
                                </button>
                            @endcan
                            @can('delete stage')
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#delete{{ $s->id }}" title="{{ trans('trans_stage.delete stage') }}">
                                <i class="fa fa-trash"></i>
                                </button>
                            @endcan
                        </td>
                    @endcanany


                  </tr>

                  {{-- Start modal edit stage --}}
                  <div class="modal fade" id="edit{{ $s->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <form action="{{ route('stage.update', [$s->id]) }}" method="POST">
                          @csrf
                          @method('put')
                          <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                              {{ trans('trans_stage.edit stage') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col">
                                <label for="name_ar" class="mr-sm-2">{{ trans('trans_stage.name ar') }} :</label>
                                <input id="name_ar" type="text" name="name_ar" class="form-control" required
                                  value="{{ $s->getTranslation('name', 'ar') }}">
                              </div>
                              <div class="col">
                                <label for="name_en" class="mr-sm-2">{{ trans('trans_stage.name en') }} :</label>
                                <input type="text" id="name_en" class="form-control" name="name_en" required
                                  value="{{ $s->getTranslation('name', 'en') }}">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">{{ trans('trans_stage.notes') }} :</label>
                              <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $s->notes }}</textarea>
                            </div>
                            <br><br>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                              data-dismiss="modal">{{ trans('trans_stage.close') }}</button>
                            <button type="submit" class="btn btn-success">{{ trans('trans_stage.submit') }}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- End modal edit stage --}}

                  {{-- Start modal delete stage --}}
                  <div class="modal fade" id="delete{{ $s->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <form action="{{ route('stage.destroy', [$s->id]) }}" method="POST">
                          @csrf
                          @method('delete')
                          <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                              {{ trans('trans_stage.delete stage') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col">
                                <label for="name_ar" class="mr-sm-2">{{ trans('trans_stage.name ar') }} :</label>
                                <input id="name_ar" type="text" name="name_ar" class="form-control" required
                                  value="{{ $s->getTranslation('name', 'ar') }}" disabled>
                              </div>
                              <div class="col">
                                <label for="name_en" class="mr-sm-2">{{ trans('trans_stage.name en') }} :</label>
                                <input type="text" id="name_en" class="form-control" name="name_en" required
                                  value="{{ $s->getTranslation('name', 'en') }}" disabled>
                              </div>
                            </div>

                            <br><br>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                              data-dismiss="modal">{{ trans('trans_stage.close') }}</button>
                            <button type="submit" class="btn btn-danger">{{ trans('trans_stage.delete submit') }}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- End modal delete stage --}}
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  {{-- Start modal add stage --}}
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('stage.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
              {{ trans('trans_stage.add stage') }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <label for="name_ar" class="mr-sm-2">{{ trans('trans_stage.name ar') }} :</label>
                <input id="name_ar" type="text" name="name_ar" class="form-control" required>
              </div>
              <div class="col">
                <label for="name_en" class="mr-sm-2">{{ trans('trans_stage.name en') }} :</label>
                <input type="text" id="name_en" class="form-control" name="name_en" required>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">{{ trans('trans_stage.notes') }} :</label>
              <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <br><br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
              data-dismiss="modal">{{ trans('trans_stage.close') }}</button>
            <button type="submit" class="btn btn-success">{{ trans('trans_stage.submit') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- End modal add stage --}}

  <!-- row closed -->
@endsection

@section('js')
@endsection

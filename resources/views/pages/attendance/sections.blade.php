@extends('layouts.master')
@section('css')

@section('title')
{{ __('trans_main.attendance') }}
@stop
@endsection


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
<!-- row -->
<div class="row">
  <div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
      {{-- <div class="card-body">
        <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
          {{ trans('Sections_trans.add_section') }}</a>
      </div> --}}

      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div class="accordion gray plus-icon round">

        @foreach ($stage as $st)
          <div class="acd-group">
            <a href="#" class="acd-heading">{{ $st->name }}</a>
            <div class="acd-des">

              <div class="row">
                <div class="col-xl-12 mb-30">
                  <div class="card card-statistics h-100">
                    <div class="card-body">
                      <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                        </div>
                      </div>
                      <div class="table-responsive mt-15">
                        <table class="table center-aligned-table mb-0">
                          <thead>
                            <tr class="text-dark">
                              <th>#</th>
                              <th>{{ trans('trans_main.school section') }}</th>
                              <th>{{ trans('trans_main.school grade') }}</th>
                              <th>{{ trans('trans_section.status') }}</th>
                              @can('list students attendace')
                              <th>{{ trans('trans_section.processes') }}</th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($st->sections as $sc)
                              <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $sc->name }}</td>
                                <td>{{ $sc->grade->name }}</td>
                                <td>
                                  <label class="badge badge-{{ $sc->status == 0 ? 'success' : 'danger' }}">{{ $sc->status == 0 ? trans("trans_section.status active") :  trans("trans_section.status unactive") }}</label>
                                </td>
                                @can('list students attendace')
                                <td>
                                    <a href="{{ route('attendance.show', $sc->id) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">{{ trans('trans_main.list students') }}</a>
                                </td>
                                @endcan
                              </tr>
                            @endforeach
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
<!-- row closed -->
@endsection
@section('js')
{{-- <script>
  $(document).ready(function() {
    $('select[name="Grade_id"]').on('change', function() {
      var Grade_id = $(this).val();
      if (Grade_id) {
        $.ajax({
          url: "{{ URL::to('classes') }}/" + Grade_id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            $('select[name="Class_id"]').empty();
            $.each(data, function(key, value) {
              $('select[name="Class_id"]').append('<option value="' + key + '">' + value +
                '</option>');
            });
          },
        });
      } else {
        console.log('AJAX load did not work');
      }
    });
  });
</script> --}}

@endsection

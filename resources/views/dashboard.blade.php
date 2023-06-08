<!DOCTYPE html>
<html lang="en">
@section('title')
  {{ trans('trans_main.dashboard') }}
@stop

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="HTML5 Template" />
  <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
  <meta name="author" content="potenzaglobalsolutions.com" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
  @include('layouts.head')
  @livewireStyles
</head>

<body style="font-family: 'Cairo', sans-serif">

  <div class="wrapper" style="font-family: 'Cairo', sans-serif">

    <!--================================= preloader -->

    <div id="pre-loader">
      <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
    </div>

    <!--================================= preloader -->

    @include('layouts.main-header')

    @include('layouts.main-sidebar')

    <!--================================= Main content -->
    <!-- main-content -->
    <div class="content-wrapper">
      <div class="page-title">
        <div class="row">
          <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif"> {{ trans('trans_dashboard.admin dashboard') }}
            </h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
            </ol>
          </div>
        </div>
      </div>
      <!-- widgets -->
      <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <div class="clearfix">
                <div class="float-left">
                  <span class="text-success">
                    <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="float-right text-right">
                  <p class="card-text text-dark">{{ trans('trans_dashboard.count students') }}</p>
                  <h4>{{ \App\Models\Student::count() }}</h4>
                </div>
              </div>
              <p class="text-muted pt-3 mb-0 mt-2 border-top">
                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('students.index') }}"
                  target="_blank"><span class="text-danger">{{ trans('trans_dashboard.display data') }}</span></a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <div class="clearfix">
                <div class="float-left">
                  <span class="text-warning">
                    <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="float-right text-right">
                  <p class="card-text text-dark">{{ trans('trans_dashboard.count teachers') }}</p>
                  <h4>{{ \App\Models\Teacher::count() }}</h4>
                </div>
              </div>
              <p class="text-muted pt-3 mb-0 mt-2 border-top">
                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('teachers.index') }}"
                  target="_blank"><span class="text-danger">{{ trans('trans_dashboard.display data') }}</span></a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <div class="clearfix">
                <div class="float-left">
                  <span class="text-success">
                    <i class="fas fa-user-tie highlight-icon" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="float-right text-right">
                  <p class="card-text text-dark">{{ trans('trans_dashboard.count parents') }}</p>
                  <h4>{{ \App\Models\TheParent::count() }}</h4>
                </div>
              </div>
              <p class="text-muted pt-3 mb-0 mt-2 border-top">
                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('livewire.parent') }}"
                  target="_blank"><span class="text-danger">{{ trans('trans_dashboard.display data') }}</span></a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <div class="clearfix">
                <div class="float-left">
                  <span class="text-primary">
                    <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="float-right text-right">
                  <p class="card-text text-dark">{{ trans('trans_dashboard.count sections') }}</p>
                  <h4>{{ \App\Models\Section::count() }}</h4>
                </div>
              </div>
              <p class="text-muted pt-3 mb-0 mt-2 border-top">
                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('section.index') }}"
                  target="_blank"><span class="text-danger">{{ trans('trans_dashboard.display data') }}</span></a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Orders Status widgets-->


      <div class="row">

        <div style="height: 400px;" class="col-xl-12 mb-30">
          <div class="card card-statistics h-100">
            <div class="card-body">
              <div class="tab nav-border" style="position: relative;">
                <div class="d-block d-md-flex justify-content-between">
                  <div class="d-block w-100">
                    <h5 style="font-family: 'Cairo', sans-serif" class="card-title">
                      {{ __('trans_dashboard.last operations system') }}</h5>
                  </div>
                  <div class="d-block d-md-flex nav-tabs-custom">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                      <li class="nav-item">
                        <a class="nav-link active show" id="admin-students-tab" data-toggle="tab"
                          href="#admin-students" role="tab" aria-controls="admin-students"
                          aria-selected="true">{{ __('trans_dashboard.students') }}</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" id="admin-teachers-tab" data-toggle="tab" href="#admin-teachers"
                          role="tab" aria-controls="admin-teachers" aria-selected="false">
                          {{ __('trans_dashboard.teachers') }}
                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" id="admin-parents-tab" data-toggle="tab" href="#admin-parents"
                          role="tab" aria-controls="admin-parents" aria-selected="false">
                          {{ __('trans_dashboard.parents') }}
                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" id="admin-fee_invoices-tab" data-toggle="tab" href="#admin-fee_invoices"
                          role="tab" aria-controls="admin-fee_invoices" aria-selected="false">
                          {{ __('trans_dashboard.invoices') }}
                        </a>
                      </li>

                    </ul>
                  </div>
                </div>
                <div class="tab-content" id="myTabContent">

                  {{-- students Table --}}
                  <div class="tab-pane fade active show" id="admin-students" role="tabpanel"
                    aria-labelledby="admin-students-tab">
                    <div class="table-responsive mt-15">
                      <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                        <thead>
                          <tr class="table-info text-danger">
                            <th>#</th>
                            <th>{{ __('trans_student.student name') }}</th>
                            <th>{{ __('trans_student.email') }}</th>
                            <th>{{ __('trans_student.gender') }}</th>
                            <th>{{ __('trans_student.stage') }}</th>
                            <th>{{ __('trans_student.grade') }}</th>
                            <th>{{ __('trans_student.section') }}</th>
                            <th>{{ __('trans_dashboard.created at') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $student->name }}</td>
                              <td>{{ $student->email }}</td>
                              <td>{{ $student->gender->name }}</td>
                              <td>{{ $student->section->grade->stage->name }}</td>
                              <td>{{ $student->section->grade->name }}</td>
                              <td>{{ $student->section->name }}</td>
                              <td class="text-success">{{ $student->created_at }}</td>
                            @empty
                              <td class="alert-danger" colspan="8">{{ __('trans_student.no data') }}</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>

                  {{-- teachers Table --}}
                  <div class="tab-pane fade" id="admin-teachers" role="tabpanel"
                    aria-labelledby="admin-teachers-tab">
                    <div class="table-responsive mt-15">
                      <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                        <thead>
                          <tr class="table-info text-danger">
                            <th>#</th>
                            <th>{{ __('trans_student.teacher name') }}</th>
                            <th>{{ __('trans_student.gender') }}</th>
                            <th>{{ __('trans_teacher.joining date') }}</th>
                            <th>{{ __('trans_teacher.specialization') }}</th>
                            <th>{{ __('trans_dashboard.created at') }}</th>
                          </tr>
                        </thead>

                        @forelse(\App\Models\Teacher::latest()->take(5)->get() as $teacher)
                          <tbody>
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $teacher->name }}</td>
                              <td>{{ $teacher->gender->name }}</td>
                              <td>{{ $teacher->date }}</td>
                              <td>{{ $teacher->specialization->name }}</td>
                              <td class="text-success">{{ $teacher->created_at }}</td>
                            @empty
                              <td class="alert-danger" colspan="8">{{ __('trans_student.no data') }}</td>
                            </tr>
                          </tbody>
                        @endforelse
                      </table>
                    </div>
                  </div>

                  {{-- parents Table --}}
                  <div class="tab-pane fade" id="admin-parents" role="tabpanel" aria-labelledby="admin-parents-tab">
                    <div class="table-responsive mt-15">
                      <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                        <thead>
                          <tr class="table-info text-danger">
                            <th>#</th>
                            <th>{{ __('trans_parent.father name') }}</th>
                            <th>{{ __('trans_parent.email') }}</th>
                            <th>{{ __('trans_parent.father national id') }}</th>
                            <th>{{ __('trans_parent.father phone') }}</th>
                            <th>{{ __('trans_dashboard.created at') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse(\App\Models\TheParent::latest()->take(5)->get() as $parent)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $parent->father_name }}</td>
                              <td>{{ $parent->email }}</td>
                              <td>{{ $parent->National_ID_Father }}</td>
                              <td>{{ $parent->father_phone }}</td>
                              <td class="text-success">{{ $parent->created_at }}</td>
                            @empty
                              <td class="alert-danger" colspan="8">{{ __('trans_student.no data') }}</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>

                  {{-- sections Table --}}
                  <div class="tab-pane fade" id="admin-fee_invoices" role="tabpanel"
                    aria-labelledby="admin-fee_invoices-tab">
                    <div class="table-responsive mt-15">
                      <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                        <thead>
                          <tr class="table-info text-danger">
                            <th>#</th>
                            <th>{{ __('trans_dashboard.invoice date') }}</th>
                            <th>{{ __('trans_student.student name') }}</th>
                            <th>{{ __('trans_student.stage') }}</th>
                            <th>{{ __('trans_student.grade') }}</th>
                            <th>{{ __('trans_student.section') }}</th>
                            <th>{{ __('trans_fee.fees type') }}</th>
                            <th>{{ __('trans_fee.amount') }}</th>
                            <th>{{ __('trans_dashboard.created at') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse(\App\Models\FeeInvoice::latest()->take(10)->get() as $fee)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $fee->invoice_date }}</td>
                              <td>{{ $fee->student->name }}</td>
                              <td>{{ $fee->grade->stage->name }}</td>
                              <td>{{ $fee->grade->name }}</td>
                              <td>{{ $fee->student->section->name }}</td>
                              <td>{{ $fee->fee->name }}</td>
                              <td>{{ $fee->amount }}</td>
                              <td class="text-success">{{ $fee->created_at }}</td>
                            </tr>
                          @empty
                            <tr>
                              <td class="alert-danger" colspan="9">{{ __('trans_student.no data') }}</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      @livewire('event.calendar')

      <!--=================================  wrapper -->

      <!--================================= footer -->

      @include('layouts.footer')
    </div><!-- main content wrapper end-->
  </div>
  </div>
  </div>

  <!--================================= footer -->

  @include('layouts.footer-scripts')
  @livewireScripts
  @stack('scripts')

</body>

</html>

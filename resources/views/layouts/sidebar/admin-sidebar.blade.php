<ul class="nav navbar-nav side-menu" id="sidebarnav">
  <!-- menu item Dashboard-->
  <li>
    <a href="{{ route('admin.dashboard') }}">
      <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('trans_main.dashboard') }}</span>
      </div>
      <div class="clearfix"></div>
    </a>
  </li>


  <!-- menu title -->
  <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('trans_main.program name') }}</li>
  <!-- menu item stage-->
  @can('stage')
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#stage">
      <div class="pull-left"><i class="fas fa-school"></i><span
          class="right-nav-text">{{ __('trans_main.school stage') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="stage" class="collapse" data-parent="#sidebarnav">
      <li><a href="{{ route('stage.index') }}">{{ __('trans_main.list school stage') }}</a></li>
    </ul>
  </li>
  @endcan
  <!-- menu item grade-->
  @can('grade')
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#grade">
      <div class="pull-left"><i class="fa fa-building"></i><span
          class="right-nav-text">{{ __('trans_main.school grade') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="grade" class="collapse" data-parent="#sidebarnav">
      <li> <a href="{{ route('grade.index') }}">{{ __('trans_main.list school grade') }}</a> </li>
    </ul>
  </li>
  @endcan
  <!-- menu item section-->
  @can('section')
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#section">
      <div class="pull-left"><i class="fas fa-chalkboard"></i><span
          class="right-nav-text">{{ __('trans_main.school section') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="section" class="collapse" data-parent="#sidebarnav">
      <li> <a href="{{ route('section.index') }}">{{ __('trans_main.list school section') }}</a> </li>
    </ul>
  </li>
  @endcan


  <!-- menu item students-->
  @canany(['list graduated', 'list promotion', 'list student'])
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#students">
      <div class="pull-left"><i class="fas fa-user-graduate"></i><span
          class="right-nav-text">{{ __('trans_main.school students') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="students" class="collapse" data-parent="#sidebarnav">
      @can('list student')
      <li> <a href="{{ route('students.index') }}">{{ __('trans_main.list students') }}</a> </li>
      @endcan
      @can('list promotion')
      <li> <a href="{{ route('promotion.create') }}">{{ __('trans_main.list promotion') }}</a> </li>
      @endcan
      @can('list graduated')
      <li> <a href="{{ route('graduated.index') }}">{{ __('trans_main.list graduated') }}</a> </li>
      @endcan
    </ul>
  </li>
  @endcanany

  <!-- menu item teachers-->
  @can('teacher')
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#teachers">
      <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
          class="right-nav-text">{{ __('trans_main.school teachers') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="teachers" class="collapse" data-parent="#sidebarnav">
      <li> <a href="{{ route('teachers.index') }}">{{ __('trans_main.school teachers') }}</a> </li>
    </ul>
  </li>
  @endcan


  <!-- menu item parents-->
  @can('parent')
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#parents">
      <div class="pull-left"><i class="fas fa-user-tie"></i><span
          class="right-nav-text">{{ __('trans_main.parents') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="parents" class="collapse" data-parent="#sidebarnav">
      <li> <a href="{{ route('livewire.parent') }}">{{ __('trans_main.parents') }}</a> </li>
    </ul>
  </li>
  @endcan

  <!-- menu item fees-->
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#fees">
      <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span class="right-nav-text">{{ __('trans_main.fees') }}</span>
      </div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="fees" class="collapse" data-parent="#sidebarnav">
      <li> <a href="{{ route('fees.index') }}">{{ __('trans_main.study fees') }}</a> </li>
      <li> <a href="{{ route('fee_invoices.index') }}">{{ __('trans_main.invoices') }}</a> </li>

      <li> <a href="{{ route('catchReceipts.index') }}">{{ __('trans_main.receivables') }}</a> </li>
      <li> <a href="{{ route('processingFees.index') }}">{{ __('trans_main.exchange bonds') }}</a> </li>
      <li> <a href="{{ route('receipts.index') }}">{{ __('trans_main.excluded fees') }}</a> </li>
    </ul>
  </li>

  <!-- menu item attendance-->
  @can('attendace')
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendance">
      <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
          class="right-nav-text">{{ __('trans_main.attendance') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="attendance" class="collapse" data-parent="#sidebarnav">
      <li> <a href="{{ route('attendance.index') }}">{{ __('trans_main.attendance') }}</a> </li>
    </ul>
  </li>
  @endcan


  <!-- Subjects-->
  @can('subject')
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects">
      <div class="pull-left"><i class="fas fa-book-open"></i><span
          class="right-nav-text">{{ __('trans_main.subject') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="Subjects" class="collapse" data-parent="#sidebarnav">
      <li> <a href="{{ route('subject.index') }}">{{ __('trans_main.subject') }}</a> </li>
    </ul>
  </li>
  @endcan


  <!-- menu item exams-->
  @canany(['list exams', 'list questions'])
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#exams">
      <div class="pull-left"><i class="fas fa-diagnoses"></i><span
          class="right-nav-text">{{ __('trans_main.exams') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="exams" class="collapse" data-parent="#sidebarnav">
      @can('list exams')
      <li> <a href="{{ route('quizz.index') }}">{{ __('trans_main.list exams') }}</a> </li>
      @endcan
      @can('list questions')
      <li> <a href="{{ route('question.index') }}">{{ __('trans_main.list question') }}</a> </li>
      @endcan
    </ul>
  </li>
  @endcanany

  <!-- menu item library-->
  @can('library')
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
      <div class="pull-left"><i class="fas fa-book"></i><span
          class="right-nav-text">{{ __('trans_main.library') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="library" class="collapse" data-parent="#sidebarnav">
      <li> <a href="{{ route('library.index') }}">{{ __('trans_main.list library') }}</a> </li>
    </ul>
  </li>
  @endcan

  <!-- menu item online classes-->
  @can('online classes')
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#online_classes">
      <div class="pull-left"><i class="fas fa-video"></i><span
          class="right-nav-text">{{ __('trans_main.online classes') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="online_classes" class="collapse" data-parent="#sidebarnav">
      <li><a href="{{ route('online_classes.index') }}">{{ __('trans_main.list online classes') }}</a></li>
    </ul>
  </li>
  @endcan

  <!-- menu item settings-->
  @can('settings')
  <li>
    <a href="{{ route('setting.index') }}"><i class="fas fa-cogs"></i><span
        class="right-nav-text">{{ trans('trans_main.settings') }} </span></a>
  </li>
  @endcan

  {{-- <li>
      <a href="javascript:void(0);" data-toggle="collapse" data-target="#settings">
        <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">{{ __('trans_main.settings') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
      </a>
      <ul id="settings" class="collapse" data-parent="#sidebarnav">
        <li> <a href="{{ route('setting.index') }}">{{ __('trans_main.settings') }}</a> </li>
      </ul>
    </li> --}}

  <!-- menu item users-->
  @can('admins')
  <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#users">
      <div class="pull-left"><i class="fas fa-users"></i><span
          class="right-nav-text">{{ __('trans_main.users') }}</span></div>
      <div class="pull-right"><i class="ti-plus"></i></div>
      <div class="clearfix"></div>
    </a>
    <ul id="users" class="collapse" data-parent="#sidebarnav">
        <li><a href="{{ route('permissions.index') }}">{{ __('trans_main.user permissions') }}</a></li>
        <li><a href="{{ route('roles.index') }}">{{ __('trans_main.user roles') }}</a></li>
        <li><a href="{{ route('users.index') }}">{{ __('trans_main.list users') }}</a></li>
    </ul>
  </li>
  @endcan

</ul>

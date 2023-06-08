<ul class="nav navbar-nav side-menu" id="sidebarnav">
    <!-- menu item Dashboard-->
    <li>
      <a href="{{ route('parent.dashboard') }}">
        <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('trans_dashboard.dashboard') }}</span>
        </div>
        <div class="clearfix"></div>
      </a>
    </li>
    <!-- menu title -->
    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('trans_main.program name') }}</li>


    <!-- الابناء-->
    <li>
      <a href="{{ route('sons.index') }}"><i class="fad fa-person-booth"></i><span class="right-nav-text">{{ trans('trans_dashboard.sons') }}</span></a>
    </li>

    <!-- تقرير الحضور والغياب-->
    <li>
      <a href="{{ route('sons.attendances') }}"><i class="fad fa-clipboard-user"></i><span class="right-nav-text">{{ __('trans_main.attendance and absence reports') }}</span></a>
    </li>

    <!-- تقرير المالية-->
    <li>
      <a href="{{ route('sons.fees') }}"><i class="fas fa-coins"></i><span class="right-nav-text">{{ trans('trans_dashboard.financial reports') }}</span></a>
    </li>


    <!-- Settings-->
    <li>
      <a href="{{ route('profile.show.parent') }}"><i class="fas fa-id-card-alt"></i><span class="right-nav-text">{{ __('trans_dashboard.profile personly') }}</span></a>
    </li>

  </ul>

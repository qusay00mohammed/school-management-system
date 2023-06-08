    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('teacher.dashboard') }}">
              <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ __('trans_main.dashboard') }}</span>
              </div>
              <div class="clearfix"></div>
            </a>
          </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('trans_main.program name') }}</li>

        <!-- الاقسام-->
        <li>
            <a href="{{ route('teacher.sections') }}"><i class="fas fa-chalkboard"></i><span class="right-nav-text">{{ __('trans_main.school section') }}</span></a>
        </li>

        <!-- الطلاب-->
        <li>
            <a href="{{ route('teacher.students') }}"><i class="fas fa-user-graduate"></i><span class="right-nav-text">{{ __('trans_main.school students') }}</span></a>
        </li>

        <!-- الاختبارات-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span class="right-nav-text">{{ __('trans_main.exams') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('teacher.quizze.index') }}">{{ __('trans_main.list exams') }}</a></li>
                <li><a href="#">{{ __('trans_main.list question') }}</a></li>
            </ul>

        </li>


        <!-- Online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{ __('trans_main.online classes') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('teacher.online_classes.index') }}">{{ __('trans_main.list online classes') }}</a> </li>
            </ul>
        </li>



        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu1">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span class="right-nav-text">{{ __('trans_main.reports') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu1" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('teacher.attendance.report') }}">{{ __('trans_main.attendance and absence reports') }}</a></li>
                <li><a href="#">{{ __('trans_main.test reports') }}</a></li>
            </ul>

        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{ route('teacher.profile.show') }}"><i class="fas fa-id-card-alt"></i><span class="right-nav-text">{{ __('trans_main.profile personly') }}</span></a>
        </li>

    </ul>

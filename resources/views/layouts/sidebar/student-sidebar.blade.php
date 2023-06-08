    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('student.dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('trans_main.dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('trans_main.program name') }}</li>


        <!-- profile-->
        <li>
            <a href="{{route('student.profile.index')}}">
                <i class="fas fa-id-card-alt"></i> <span class="right-nav-text">{{ __('trans_dashboard.profile personly') }}</span>
            </a>
        </li>

        {{-- Online Classes --}}
        <li>
            <a href="{{route('student.online_classes.index')}}">
                <i class="fas fa-video"></i> <span class="right-nav-text">{{ __('trans_main.online classes') }}</span>
            </a>
        </li>

        {{-- Subject --}}
        <li>
            <a href="{{route('student.subject.index')}}">
                <i class="fas fa-book-open"></i> <span class="right-nav-text">{{ __('trans_main.subject') }}</span>
            </a>
        </li>

         <!-- Exams-->
         <li>
            <a href="{{route('student.exam.index')}}">
                <i class="fas fa-book-open"></i><span class="right-nav-text">{{ __('trans_main.exams') }}</span>
            </a>
        </li>

         <!-- Questions-->
         <li>
            <a href="{{route('student.questions.index')}}">
                <i class="fab fa-acquisitions-incorporated"></i> <span class="right-nav-text">{{ __('trans_dashboard.my questions') }}</span>
            </a>
        </li>

    </ul>


<div class="container-fluid">
  <div class="row">
    <!-- Left Sidebar start-->
    <div class="side-menu-fixed">
      <div class="scrollbar side-menu-bg">

        @if (auth('admin')->check())
            @include('layouts.sidebar.admin-sidebar');
        @elseif (auth('student')->check())
            @include('layouts.sidebar.student-sidebar');
        @elseif (auth('teacher')->check())
            @include('layouts.sidebar.teacher-sidebar');
        @elseif (auth('parent')->check())
            @include('layouts.sidebar.parent-sidebar');
        @endif

      </div>
    </div>
{{-- </div> --}}
{{-- </div> --}}


<!-- Left Sidebar End-->

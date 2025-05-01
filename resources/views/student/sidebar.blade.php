<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Student</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('student.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a> 

        </li>

        <li>
            <a href="{{route('student.chatbox')}}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Chatbox</div>
            </a> 

        </li>

        

        {{-- Removed approval check to always show Schedule link --}}
        <li class="{{ setSidebar(['student.course*', 'student.course-section*']) }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Courses</div>
            </a>
            <ul>
                <li class="{{ setSidebar(['student.courses']) }}">
                    <a href="{{route('student.courses')}}"><i class='bx bx-radio-circle'></i>All Course</a>
                </li>
                <li>
                    <a href="{{ route('student.courses') }}"><i class='bx bx-radio-circle'></i>My Courses</a>
                </li>
                <li>
                    <a href="{{ route('student.schedule') }}"><i class='bx bx-radio-circle'></i>Schedule</a>
                </li>
            </ul>
        </li>


    </ul>
    <!--end navigation-->
</div>

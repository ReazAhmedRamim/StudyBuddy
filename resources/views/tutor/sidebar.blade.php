<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Instructor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('tutor.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a> 

        </li>

        <li>
            <a href="{{route('tutor.chatbox')}}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Chatbox</div>
            </a> 

        </li>

        <li>
            <a href="{{route('tutor.chatbox')}}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Quiz Question</div>
            </a> 

        </li>

        {{-- Removed approval check to always show Schedule link --}}
        <li class="{{ setSidebar(['tutor.course*', 'tutor.course-section*']) }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Courses</div>
            </a>
            <ul>
                <li class="{{ setSidebar(['tutor.courses']) }}">
                    <a href="{{route('tutor.courses')}}"><i class='bx bx-radio-circle'></i>All Course</a>
                </li>
                <li>
                    <a href="{{ route('tutor.courses') }}"><i class='bx bx-radio-circle'></i>My Courses</a>
                </li>
                <li>
                    <a href="{{ route('tutor.schedule') }}"><i class='bx bx-radio-circle'></i>Schedule</a>
                </li>
            </ul>
        </li>


    </ul>
    <!--end navigation-->
</div>

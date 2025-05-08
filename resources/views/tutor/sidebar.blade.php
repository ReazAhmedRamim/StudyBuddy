<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Tutor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    

    <ul class="metismenu" id="menu">
        <!-- Dashboard -->
        <li>
            <a href="{{ route('tutor.dashboard') }}" 
               class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ setSidebarActive(['tutor.dashboard']) }}">
                <div class="parent-icon"><i class='bx bx-category'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <!-- Chatbox -->
        <li>
            <a href="{{ route('tutor.chatbox') }}"
               class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ setSidebarActive(['tutor.chatbox']) }}">
                <div class="parent-icon"><i class='bx bx-message-square-dots'></i></div>
                <div class="menu-title">Chatbox</div>
            </a>
        </li>

        @if(isApprovedUser())
        <!-- Manage Courses Dropdown -->
        <li class="{{ setSidebarActive(['tutor.course.*']) ? 'bg-blue-50' : '' }}">
            <a href="javascript:;" 
               class="has-arrow flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ setSidebarActive(['tutor.course.*']) ? 'text-blue-600' : '' }}">
                <div class="parent-icon"><i class='bx bx-book'></i></div>
                <div class="menu-title">Manage Courses</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('tutor.course.index') }}"
                       class="flex items-center px-4 py-2 pl-12 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ setSidebarActive(['tutor.course.index']) }}">
                        <i class='bx bx-radio-circle mr-2'></i>All Courses
                    </a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</div>
 
   
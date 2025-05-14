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
    </ul>
</div>

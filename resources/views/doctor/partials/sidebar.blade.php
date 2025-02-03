<aside class="sidebar">
    <ul class="menu">
        <div>
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ url('/home') }}">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('doctor.appointments') ? 'active' : '' }}">
                <a href="{{ route('doctor.appointments') }}">
                    <i class="bi bi-calendar3"></i>
                    <span>Appointments</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('doctor.home') ? 'active' : '' }}">
                <a href="{{ route('doctor.home') }}">
                    <i class="bi bi-file-earmark-arrow-up-fill"></i>
                    <span>Work Certificate</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('doctor.vacation.form') ? 'active' : '' }}">
                <a href="{{ route('doctor.vacation.form') }}">
                    <i class="bi bi-calendar-check"></i>
                    <span>Vacation Request</span>
                </a>
            </li>
        </div>
        <div>
            <li class="{{ request()->routeIs('doctor.profile') ? 'active' : '' }}">
                <a href="{{ route('doctor.profile') }}">
                    <i class="bi bi-gear"></i>
                    <span>Profile</span>
                </a>
            </li>
            <form id="logout-form" method="POST" action="{{ route('doctor.profile.logout') }}" class="d-none">
                @csrf
            </form>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>LogOut</span>
                </a>
            </li>
        </div>
    </ul>
</aside>

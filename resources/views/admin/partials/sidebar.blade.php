<aside class="sidebar">
    <ul class="menu">
        <div>
            <li class="{{ request()->is('home') ? 'active' : '' }}"><a href="{{ url('/home') }}"><i class="bi bi-house-door-fill"></i><span>Dashboard</span> </a></li>
            <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="bi bi-people-fill"></i><span>Users</span></a></li>
            <li class="{{ request()->routeIs('doctors.index') ? 'active' : '' }}"><a href="{{ route('doctors.index') }}"><i class="bi bi-clipboard2-pulse-fill"></i><span>Doctors</span> </a></li>
            <li class="{{ request()->routeIs('appointments.index') ? 'active' : '' }}"><a href="{{ route('appointments.index') }}"><i class="bi bi-calendar3"></i><span>Appointments</span></a></li>
            <li class="{{ request()->routeIs('vacation.index') ? 'active' : '' }}"><a href="{{ route('vacation.index') }}"><i class="bi bi-calendar2-check"></i><span>Vacations</span></a></li>
        </div>
        <div>
            <li class="{{ request()->routeIs('profile.show') ? 'active' : '' }}"><a href="{{ route('profile.show') }}"><i class="bi bi-gear"></i><span>Profile</span> </a></li>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                @csrf
            </form>

            <li>
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>LogOut</span>
                </a>
            </li>
        </div>
    </ul>
</aside>

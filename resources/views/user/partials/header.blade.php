<header class="py-3">
    <nav class="container" id="navbar">
        <div class="logo">
            <a href="{{ url('/') }}" class="no-decoration">
                <h1><span>One</span><span>-Health</span></h1>
            </a>
        </div>

        <div class="menu-icon" id="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="nav-wrapper" id="nav-wrapper">
            <ul class="nav-links">
                <li>
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                </li>
                <li>
                    <a href="#about" class="{{ request()->is('about') ? 'active' : '' }}">About Us</a>
                </li>
                <li>
                    <a href="#doctors" class="{{ request()->is('doctors') ? 'active' : '' }}">Doctors</a>
                </li>
                <li>
                    <a href="#location" class="{{ request()->is('location') ? 'active' : '' }}">Location</a>
                </li>
            </ul>
            @auth
                <li class="padding-left">
                    <x-animated-btn color="#00d9a5" onclick="window.location='{{ route('appointments.home.index') }}'">
                        My Appointments
                    </x-animated-btn>
                </li>
                <div class="dropdown padding-left">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill-gear"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item text-muted text-sm">Manage Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Log Out</button>
                        </form>
                    </div>
                </div>
            @endauth
            @guest
                <div class="nav-buttons">
                    <a class="costum-btn" href="{{ route('login') }}">Login</a>
                    <a class="costum-btn" href="{{ route('register') }}">Register</a>
                </div>
            @endguest

        </div>
    </nav>
</header>

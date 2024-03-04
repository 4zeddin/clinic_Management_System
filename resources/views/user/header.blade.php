    <header>
        <div class="topbar">
            <div class="container">
                @if (Route::has('login'))
                    @auth
                    @else
                        <div class="row">
                            <div class="col-sm-8 text-sm">
                                <div class="site-info">
                                    <a href="#"><span class="mai-mail text-primary"></span>Test Accounts</a>
                                    <span class="divider">:</span>
                                    <a href="#"><span class="mai-mail text-primary"></span>admin@admin.com |
                                        admin1234</a>
                                    <span class="divider">|</span>
                                    <a href="#"><span class="mai-mail text-primary"></span>client@client.com |
                                        client1234</a>
                                </div>
                            </div>
                            <!-- <div class="col-sm-4 text-right text-sm">
                        <div class="social-mini-button">
                          <a href="#"><span class="mai-logo-facebook-f"></span></a>
                          <a href="#"><span class="mai-logo-twitter"></span></a>
                          <a href="#"><span class="mai-logo-dribbble"></span></a>
                          <a href="#"><span class="mai-logo-instagram"></span></a>
                        </div>
                      </div> -->
                        </div> <!-- .row -->
                    @endif
                @endauth
            </div> <!-- .container -->
        </div> <!-- .topbar -->

        <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#"><span class="text-primary">One</span>-Health</a>

                <form action="#">
                    <div class="input-group input-navbar">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username"
                            aria-describedby="icon-addon1">
                    </div>
                </form>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport"
                    aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupport">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('/home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doctors-section">Doctors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#blog">Location</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/home/appointments')}}">My Appointments</a>
                            </li>
                        @endif

                        @if (Route::has('login'))
                            @auth
                                <div class="btn-group">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-muted text-sm">Manage Account</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                        <form method="POST" action="{{ route('logout') }}"
                                            @click.prevent="$root.submit();">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Log Out</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <li class="nav-item">
                                    <a class="btn btn-primary ml-lg-3" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-primary ml-lg-3" href="{{ route('register') }}">Register</a>
                                </li>
                            @endauth
                        @endif
                    </ul>
                </div> <!-- .navbar-collapse -->
            </div> <!-- .container -->
        </nav>
    </header>

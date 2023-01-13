<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="index.html">Day</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto @if(request()->is('/packages*')) ? '' : 'active' @endif" href="{{ route('welcome') }}#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="{{ route('welcome') }}#about">About</a></li>
                <li><a class="nav-link scrollto" href="{{ route('welcome') }}#services">Services</a></li>
                <li><a class="nav-link scrollto" href="{{ route('welcome') }}#pricing">Packages</a></li>
                <li><a class="nav-link scrollto" href="{{ route('welcome') }}#team">Team</a></li>
                <li><a class="nav-link scrollto" href="{{ route('welcome') }}#contact">Contact</a></li>
                @auth
                    <li class="dropdown"><a href="#"><span>{{ Auth::user()->name }}</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('profile') }}">Profile</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a class="nav-link scrollto" href="{{ route('login') }}">Login</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

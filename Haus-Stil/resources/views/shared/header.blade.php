<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

<div class="container">
    <a class="navbar-brand" href="{{url('/')}}">HausStil<span>.</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
            <li class="@yield('home')">
                <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="@yield('shop')" ><a class="nav-link" href="{{url('shop')}}">Shop</a></li>
            <li class="@yield('aboutus')" ><a class="nav-link" href="{{url('about')}}">About us</a></li>
            <li class="@yield('serv')" ><a class="nav-link" href="{{url('services')}}">Services</a></li>
            <li class="@yield('blog')" ><a class="nav-link" href="{{url('blog')}}">Blog</a></li>
            <li class="@yield('contact')" ><a class="nav-link" href="{{url('contact')}}">Contact us</a></li>
        </ul>

        <ul class="custom-navbar-nav navbar-nav  mb-2 mb-md-0 ms-5">
            <li class="@yield('card')"><a class="nav-link" href="{{url('cart')}}">Card</a></li>
        </ul>


        <!-- Right Side Of Navbar -->
        <ul class="custom-navbar-nav navbar-nav mb-2 mb-md-0 ms-5">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <a class="dropdown-item" href="{{ route('profile') }}">
                    {{ __('profile') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>

        
    </div>
</div>
    
</nav>
<!-- End Header/Navigation -->